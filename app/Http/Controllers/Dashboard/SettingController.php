<?php

namespace App\Http\Controllers\Dashboard;

use Hamcrest\Core\Set;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\SettingService;

class SettingController extends Controller
{
    protected $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }
    
    public function index(){
        return view('dashboard.settings.index');
    }

    public function update(SettingRequest $request , $id){
          $data = $request->except(['_token' , '_method']);
          $settings = $this->settingService->updateSetting($data , $id);
          if(!$settings){
              Session::flash('error' , __('dashboard.something_wrong'));
              return redirect()->back();
          }
            Session::flash('success' , __('dashboard.updated_successfully'));
            return redirect()->back();
    }
}
