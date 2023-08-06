<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        $now = Carbon::now();

        static::saving(function ($announcement) use ($now) {
            $announcement->active = ($now >= $announcement->start_date) && ($now <= $announcement->end_date);
        });
    }
}
