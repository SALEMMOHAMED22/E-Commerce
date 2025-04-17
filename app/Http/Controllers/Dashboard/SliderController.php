<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Services\Dashboard\SliderService;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    protected $SliderService;
    public function __construct(SliderService $SliderService){
        $this->SliderService = $SliderService;
    }


    public function index(){
        return view('dashboard.sliders.index');
    }

    public function getAll(){
        return $this->SliderService->getSlidersForDatatables();
    }

    public function store(SliderRequest $request){
            $data = $request->only(['note' , 'file_name']);
            $slider = $this->SliderService->createSlider($data);
            if(!$slider){
                Session::flash('error' , __('dashboard.error_msg'));
                return redirect()->back();
            }
            Session::flash('success' , __('dashboard.success_msg'));
            return redirect()->back();


    }

    public function destroy($id){
      if(!  $slider = $this->SliderService->deleteSlider($id)){

        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg')
        ], 500);
        

      }

      return response()->json([
        'status' => 'success',
        'message' => __('dashboard.success_msg')

      ], 200);
      
    }



    
}
