<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\SiteSettingResource;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::find(1);
        if (!$settings) {
            return response()->json([
                'success' => false,
                'message' => 'there is no settings, please contact the support'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'settings' => new SettingsResource($settings)
        ], 200);
    }

    public function siteSettings(Request $request)
    {
        $Sitesettings = SiteSetting::all();
        if (!$Sitesettings) {
            return response()->json([
                'success' => false,
                'message' => 'there is no settings, please contact the support'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'settings' =>  SiteSettingResource::collection($Sitesettings)
        ], 200);
    }
}
