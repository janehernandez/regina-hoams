<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberInfo extends Model
{
    use HasFactory;

    const GENDERS = [
        'female' => 0,
        'male' => 1
    ];

    const MARITAL_STATUSES = [
        'single' => 1,
        'married' => 2,
        'widowed' => 3,
        'separated' => 4
    ];

    const STATUS = [
        'disabled' => 0,
        'approved' => 1,
        'pending' => 2,
    ];

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
