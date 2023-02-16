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
use App\Traits\UploadImageTrait;
class SettingController extends Controller
{

    use UploadImageTrait ;
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
            $path =  $this->UploadImageSetting($request ,'logo','Images');
            $setting->update(['logo' => $path]);
        }


        if($request->has('favicon')){
            $path =  $this->UploadImageSetting($request ,'favicon','Images');
            $setting->update(['favicon' => $path]);
        }

        return redirect()->back()->with('success', 'تم تحديث الاعدادات بنجاح');

   }



}
