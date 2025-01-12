<?php

namespace App\Services\Dashboard;

use App\Models\Setting;
use App\Repositories\Dashboard\SettingRepository;
use App\Utils\ImageManger;
use Hamcrest\Core\Set;

class SettingService
{
    protected $settingRepository , $imageManger;
    public function __construct(SettingRepository $settingRepository , ImageManger $imageManger)
    {
        $this->settingRepository = $settingRepository;
        $this->imageManger = $imageManger;
    }

    public function getSetting($id){
        $setting = $this->settingRepository->getSetting($id);
        return $setting ?? abort(404);
    }

    public function updateSetting($data , $id){

        $setting = $this->getSetting($id);
        if(array_key_exists('logo' , $data) && $data['logo'] != null){
            // delete old logo 
            $this->imageManger->deleteImageFromLocal($setting->logo);
            $file_name = $this->imageManger->uploadSingleImage('/' , $data['logo'] , 'settings');
            $data['logo'] = $file_name;
        }
        if(array_key_exists('favicon' , $data) && $data['favicon'] != null){
            // delete old favicon 
            $this->imageManger->deleteImageFromLocal($setting->favicon);
            $file_name = $this->imageManger->uploadSingleImage('/' , $data['favicon'] , 'settings');
            $data['favicon'] = $file_name;
        }

        return $this->settingRepository->updateSetting($data , $setting);
    }


    
}
