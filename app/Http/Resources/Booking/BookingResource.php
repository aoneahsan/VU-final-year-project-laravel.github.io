<?php

namespace App\Http\Resources\Booking;

use Carbon\Carbon;
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
                'description' => $this->hall ? $this->hall->description : null,
                'location' => $this->hall ? $this->hall->location : null
            ],
            'event_type' => $this->event_type,
            'no_of_persons' => $this->no_of_persons,
            'booking_date' => $this->booking_date,
            'book_time_from' => $this->book_time_from,
            'book_time_to' => $this->book_time_to,
            'menu' => $this->menu,
            'feedback_provided_at' => $this->feedback_provided_at,
            'status' => $this->status,
            'extra_features' => $this->extra_features,
            'price' => $this->price,
            'created_at' => date('l F j, Y', strtotime($this->created_at))
        ];
    }
}
