<?php

namespace App\Rules;

use App\Models\Appointment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameBooking implements ValidationRule
{
    protected $startTime;

    public function __construct($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $bookingExists = Appointment::where('venue', $value)
            ->where('start', $this->startTime)
            ->exists();

        if ($bookingExists) {
            $fail('The :attribute must not have the same reservation time.');
        }
    }
}
