<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bootstrap model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::updating(function ($appointment) {
            $currentDateTime = Carbon::now();
            $reservationEndTime = Carbon::parse($appointment->end);

            if ($currentDateTime->isAfter($reservationEndTime)) {
                $appointment->active = 0;
            }
        });
    }
}
