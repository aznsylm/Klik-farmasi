<?php

namespace App\Traits;

use Carbon\Carbon;

trait UseWIBTimezone
{
    protected function serializeDate($date)
    {
        return $date->setTimezone('Asia/Jakarta');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }
}
