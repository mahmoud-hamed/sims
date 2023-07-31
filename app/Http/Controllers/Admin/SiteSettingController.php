<?php

namespace App\Http\Controllers\Admin;

use App\helpers\Attachment;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $sitesetting = SiteSetting::first();
        return view('admin.site-setting.index', compact('sitesetting'));
    }

    public function update(Request $request)
    {

      

        $sitesetting = SiteSetting::first();

        if($sitesetting){
            $data = $request->validate([
                'email' => 'nullable|string',
                'phone' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'app_store' => 'nullable|string',
                'google_play' => 'nullable|string',
                'address' => 'nullable|string',
                'facebook' => 'nullable|string',
                'twitter' => 'nullable|string',
                'instagram' => 'nullable|string',
                'snapchat' => 'nullable|string',
            ]);
            $sitesetting->update($data);

            if ($request->hasFile('logo')) {
                $oldFile = $sitesetting->attachmentRelation[0] ?? null;
                
                Attachment::updateAttachment($request->file('logo'), $oldFile, $sitesetting, 'settings/logo', ['save' => 'original', 'usage' => 'logoImage']);
            }
    
           
    
            return redirect()->back()->with('message', 'settings updated successfully');

        }

       else{
        $data = $request->validate([
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'app_store' => 'nullable|string',
            'google_play' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'snapchat' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {

            Attachment::addAttachment($request->file('logo'), $sitesetting, 'settings/logo', ['save' => 'original', 'usage' => 'logoImage']);
        }

        SiteSetting::create($data);

        return redirect()->back()->with('success', 'Contact created successfully!');

       }

    }
}

