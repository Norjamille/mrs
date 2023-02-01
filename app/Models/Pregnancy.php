<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnancy extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUSES = [
        'unborn' => 'Unborn',
        'delivered' => 'Delivered',
    ];

    public function getCurrentPregnancyMonthAttribute()
    {
        return Carbon::parse($this->first_check_up_at)->diffInMonths(now()) + $this->months;
    }
}
