<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingAdminUpdatetRequest;
use App\Services\SettingService;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSettings();
        return view('dashboard.settings.index', compact('setting'));
    }

    public function update(SettingAdminUpdatetRequest $request)
    {
        try {
            $data = $request->validated();
            $data['photo_request'] = $request;
            
            $this->settingService->updateSettings($request->id, $data);
            return redirect()->back()->with('success', 'تم تحديث الاعدادات بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
