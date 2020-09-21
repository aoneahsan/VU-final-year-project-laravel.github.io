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
                'id' => $this->user ? $this->user->id : null,
                'name' => $this->user ? $this->user->name : null,
                'email' => $this->user ? $this->user->email : null,
                'profile_image' => $this->user ? $this->user->getProfileImg() : null
            ],
            'hall' => [
                'id' => $this->hall ? $this->hall->id : null,
                'name' => $this->hall ? $this->hall->name : null,
                'description' => $this->hall ? $this->hall->description : null
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
