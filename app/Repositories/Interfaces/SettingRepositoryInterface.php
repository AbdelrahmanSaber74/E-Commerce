<?php

namespace App\Repositories\Interfaces;

interface SettingRepositoryInterface extends RepositoryInterface
{
    public function getSettings(): ?\Illuminate\Database\Eloquent\Model;
}
