<?php

namespace App\Http\Requests;

use App\Rules\SameBooking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'venue' => ['required', 'numeric', Rule::in(0, 1), new SameBooking($this->input('start'))],
            'start' => ['required', 'date', 'date_format:Y-m-d H:i'],
            'end' => ['required', 'date', 'date_format:Y-m-d H:i', 'after:start_time'],
            'description' => ['required', 'string'],
        ];
    }
}
