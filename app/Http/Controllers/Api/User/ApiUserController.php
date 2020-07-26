<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\User\UserProfileResource;

use Illuminate\Support\Facades\Storage;

class ApiUserController extends Controller
{
    public function getUserProfileData(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        if ($user) {
            return response()->json(['data' => new UserProfileResource($user)], 200);
        } else {
            return response()->json(['message' => 'User Not Found!'], 500);
        }
    }

    public function updateUserProfile(Request $request)
    {
        $user_data = User::where('id', $request->user()->id)->first();

        $result = User::where('id', $request->user()->id)->update([
            'username' => $request->has('username') ? $request->username : $user_data->username,
            'email' => $request->has('email') ? $request->email : $user_data->email,
            'name' => $request->has('name') ? $request->name : $user_data->name,
            'location' => $request->has('location') ? $request->location : $user_data->location,
            'cnic' => $request->has('cnic') ? $request->cnic : $user_data->cnic,
            'phone_number' => $request->has('phone_number') ? $request->phone_number : $user_data->phone_number
        ]);

        if ($result) {
            $new_data = User::where('id', $request->user()->id)->first();
            return response()->json(['data' => new UserProfileResource($new_data)], 200);
        } else {
            return response()->json(['message' => "Error Occured!"], 500);
        }
    }

    public function updateUserProfileImage(Request $request)
    {
        $user_data = User::where('id', $request->user()->id)->first();

        $oldImageURL = $user_data->profile_img;

        $profile_image = null;
        if (request('profile_image')) {
            $profile_image = request('profile_image')->store('profileimage');
            Storage::delete($oldImageURL);
        }

        $result = User::where('id', $request->user()->id)->update([
            'profile_img' => $profile_image ? $profile_image : $user_data->profile_img,
        ]);

        if ($result) {
            $new_data = User::where('id', $request->user()->id)->first();
            return response()->json(['data' => new UserProfileResource($new_data)], 200);
        } else {
            return response()->json(['message' => "Error Occured!"], 500);
        }
    }

    public function deleteUserAccount(Request $request)
    {
        $result = $request->user()->delete();
        if ($result) {
            return response()->json(['data' => 'Account Deleted!'], 200);
        } else {
            return response()->json(['message' => 'Error Occured!'], 500);
        }
    }
}
