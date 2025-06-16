<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CreateOrderNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'user_name' => $this->order->user_name,
            'total_price' => $this->order->total_price,
            'status' => $this->order->status,
            'message' => "New Order Has Been Paid Successfully",
            'created_at' => now()->toDateTimeString(),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'user_name' => $this->order->user_name,
            'total_price' => $this->order->total_price,
            'status' => $this->order->status,
            'message' => "New Order Has Been Paid Successfully",
            'created_at' => now()->toDateTimeString(),
        ]);
    }


    public function databaseType(Object $notifiable): string
    {
        return "CreateOrderNotification";
    }

    public function broadcastType(): string
    {
        return "CreateOrderNotification";
    }


   
}
