<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::whereId($this->user_id)->first();
        $venue = ['court', 'hall'];
        $location = ['Basketball Court', 'Multipurpose Hall'];

        return [
            'id' => $this->id,
            'title' => "[{$this->booking_number}] $user->name",
            'with' => $user->name,
            'time' => [
                "start" => (new Carbon($this->start))->format('Y-m-d H:i'),
                "end" => (new Carbon($this->end))->format('Y-m-d H:i'),
            ],
            'colorScheme' => $venue[$this->venue],
            'isEditable' => false,
            'description' => $this->description,
            'location' => $location[$this->venue],
        ];
    }
}
