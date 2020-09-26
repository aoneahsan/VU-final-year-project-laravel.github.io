<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
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
            'profile_image' => $this->getProfileImg(),
            'is_approved' => !!$this->is_approved,
            'role' => $this->role,
            'member_since' => "Member Since " . date('l F j, Y', strtotime($this->created_at)),
            'tokken' => $this->getTokken()
        ];
    }
}
