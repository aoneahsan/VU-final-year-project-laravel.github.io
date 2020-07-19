<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'location' => $this->location,
            'profile_image' => $this->getProfileImg(),
            'role' => $this->role,
            'cnic' => $this->cnic,
            'member_since' => date('F j, Y', strtotime($this->created_at))
        ];
    }
}
