<?php

namespace App\Http\Resources\Hall;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiHallFeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'booking_id' => $this->booking_id,
            'hall_id' => $this->hall_id,
            'user' => [
                'id' => $this->user ? $this->user->id : null,
                'name' => $this->user ? $this->user->name : null,
                'email' => $this->user ? $this->user->email : null,
                'profile_image' => $this->user ? $this->user->getProfileImg() : null
            ],
            'feedback' => $this->feedback,
            'rating' => $this->rating,
            'created_at' => date('l F j, Y', strtotime($this->created_at))
        ];
    }
}
