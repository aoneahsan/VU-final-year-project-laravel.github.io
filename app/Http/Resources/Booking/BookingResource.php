<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'hall_id' => $this->hall_id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'profile_image' => $this->user->getProfileImg()
            ],
            'hall' => [
                'id' => $this->hall->id,
                'name' => $this->hall->name,
                'description' => $this->hall->description
            ],
            'event_type' => $this->event_type,
            'no_of_persons' => $this->no_of_persons,
            'booking_time' => $this->booking_time,
            'menu' => $this->menu,
            'price' => $this->price,
            'created_at' => date('l F j, Y', strtotime($this->created_at))
        ];
    }
}
