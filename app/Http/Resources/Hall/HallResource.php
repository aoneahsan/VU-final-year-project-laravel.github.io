<?php

namespace App\Http\Resources\Hall;

use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'hall_size' => $this->hall_size,
            'event_type' => $this->event_type,
            'hall_rent' => $this->hall_rent,
            'location' => $this->location,
            'min_no_of_persons' => $this->min_no_of_persons,
            'open_time' => $this->open_time,
            'closed_time' => $this->closed_time,
            'is_available' => !!$this->is_available,
            'created_at' => date('l F j, Y', strtotime($this->created_at)),
            'images' => !!$this->gallery ? ApiHallGalleryResource::collection($this->gallery) : null,
            'food_items' => !!$this->foods ? ApiHallFoodResource::collection($this->foods) : null,
            'features' => !!$this->features ? ApiHallFeatureResource::collection($this->features) : null,
            'timings' => !!$this->timings ? ApiHallTimeResource::collection($this->timings) : null,
            'feedbacks' => !!$this->feedbacks ? ApiHallFeedbackResource::collection($this->feedbacks) : null,
            'bookings' => !!$this->bookings ? ApiHallBookingResource::collection($this->bookings) : null
        ];
    }
}
