<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getSettings(): ?\App\Models\Setting
    {
        return \Illuminate\Support\Facades\Cache::rememberForever('site_settings', function () {
            return $this->model->first();
        });
    }

    public function update(array $data, int|string $id): bool
    {
        $updated = parent::update($data, $id);
        if ($updated) {
            \Illuminate\Support\Facades\Cache::forget('site_settings');
        }
        return $updated;
    }
}
