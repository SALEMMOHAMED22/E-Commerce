<?php

namespace App\Http\Controllers\Website;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Website\OrderService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OrderShippingRequest;
use App\Notifications\CreateOrderNotification;
use App\Services\Website\MyFatoorahService;

class CheckoutController extends Controller
{
    protected $orderService, $myFatoorahService;
    public function __construct(OrderService $orderService, MyFatoorahService $myFatoorahService)
    {
        $this->orderService = $orderService;
        $this->myFatoorahService = $myFatoorahService;
    }
    public function showCheckoutPage()
    {
        return view('website.checkout');
    }


    public function checkout(OrderShippingRequest $request)
    {
        // return $request;
        // ..... validation ..... 
        $shipping = $request->validated();
        // return  $shipping;

        //  get invoice value from cart 
        $invoicevalue = $this->orderService->getInvoiceValue($shipping);

        if ($invoicevalue < 1 || $invoicevalue == null) {

            return redirect()->back()->with('error', 'cart is empty!');
        }

        $data = [
            'CustomerName' => $shipping['first_name'] . ' ' . $shipping['last_name'],
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $invoicevalue,
            'DisplayCurrencyIso' => 'EGP',
            'CustomerEmail' => $shipping['user_email'],
            'CallBackUrl' => 'http://localhost:8000/checkout/callback',
            'ErrorUrl' => 'http://localhost:8000/checkout/error',
            'Language' => app()->getLocale() == 'ar' ? 'ar' : 'en',
        ];


        $data = $this->myFatoorahService->checkout($data);


        //  return data >>>>
        if ($url = $data["Data"]["InvoiceURL"]) {
            // Store Order 
            $createOrder = $this->orderService->createOrder($shipping);
            if (!$createOrder) {
                Session::flash('error', 'Order Not Found!');
                return redirect()->route('website.checkout.get');
            }

            //  Store Transaction 
            $createTransaction = $this->orderService->createTransaction($data, $createOrder->id);
            if (!$createTransaction) {
                Session::flash('error', 'Transaction Not Found!');
                return redirect()->route('website.checkout.get');
            }

            return redirect($url);
        } else {
            Session::flash('error', 'something is wrong');
            return redirect()->route('website.checkout.get');
        }
    }


    public function callback(Request $request)
    {

        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';


        $response = $this->myFatoorahService->getPaymentStatus($data);

        //  Change Order Status
        $user_id = Transaction::where('transaction_id', $response['Data']['InvoiceId'])->pluck('user_id');
        $order_id = Transaction::where('transaction_id', $response['Data']['InvoiceId'])->pluck('order_id');


        if ($response['Data']['InvoiceStatus'] == 'Paid') {
            Order::where('id', $order_id)->update([
                'status' => 'paid',
            ]);

            $this->orderService->clearUserCart(auth('web')->user()->cart);

            $order = Order::where('id', $order_id)->first();
            $admins = Admin::all();

            foreach ($admins as $admin) {
                $admin->notify(new CreateOrderNotification($order));

            }

            Session::flash('success', 'تم الدفع بنجاح راقب حالة الاوردر');
            return redirect()->route('website.checkout.get');
        }

        Session::flash('error', 'فشلت عملية الدفع حاول مره اخري !');
        return redirect()->route('website.checkout.get');
    }

    public function error()
    {
        Session::flash('error', 'الدفع فيه مشكله حاول مره اخري !');
        return redirect()->route('website.checkout.get');
    }
}
