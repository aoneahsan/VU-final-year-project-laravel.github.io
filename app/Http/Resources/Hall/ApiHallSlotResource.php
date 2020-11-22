<?php

namespace App\Http\Resources\Hall;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiHallSlotResource extends JsonResource
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
            'hall_id' => $this->hall_id,
            'booking_id' => $this->booking_id,
            'user_id' => $this->user_id,
            'hall_time_id' => $this->hall_time_id,
            'date' => $this->date,
            'is_active' => !!$this->is_active,
            'created_at' => $this->created_at
        ];
    }
}
