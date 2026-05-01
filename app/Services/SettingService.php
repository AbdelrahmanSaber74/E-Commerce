<?php

namespace App\Services;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Traits\UploadImageTrait;

class SettingService
{
    use UploadImageTrait;

    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getSettings()
    {
        return $this->settingRepository->getSettings();
    }

    public function updateSettings($id, array $data)
    {
        $updateData = $data;
        unset($updateData['photo_request']); // Remove request object from data

        $setting = $this->settingRepository->update($updateData, $id);

        if (isset($data['logo'])) {
            $path = $this->UploadImageSetting($data['photo_request'], 'logo', 'Images');
            $this->settingRepository->update(['logo' => $path], $id);
        }

        if (isset($data['favicon'])) {
            $path = $this->UploadImageSetting($data['photo_request'], 'favicon', 'Images');
            $this->settingRepository->update(['favicon' => $path], $id);
        }

        return $setting;
    }
}
