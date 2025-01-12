<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{
    
    public function getSetting($id){
        return Setting::find($id);
    }

    public function updateSetting($data, $setting){
        $setting->update($data);
        return $setting;
    }
}
