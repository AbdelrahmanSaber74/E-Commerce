<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingUpdateRequest;
use App\Http\Requests\SettingAdminUpdatetRequest;
use App\Models\Setting;
use App\Utils\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.settings.index' , compact('setting'));
    }


    public function update(SettingAdminUpdatetRequest $request, Setting $setting)
    {


        $setting->update([$request->validated()]);
        $setting = Setting::findOrFail($request->id);
        $setting->update($request->validated());

        if($request->has('logo')){
            $logo = $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('Image' , $logo  , 'dashboard') ;
            $setting->update(['logo' => $path]);
        }

        if($request->has('favicon')){
            $logo = $request->file('favicon')->getClientOriginalName();
            $path = $request->file('favicon')->storeAs('Image' , $logo  , 'dashboard') ;
            $setting->update(['favicon' => $path]);

        }

        return redirect()->back()->with('success', 'تم تحديث الاعدادات بنجاح');

   }
}
