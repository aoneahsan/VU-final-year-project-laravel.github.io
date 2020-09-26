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

    public function updateUserProfile(Request $request, $userID)
    {
        $user_data = User::where('id', $userID)->first();

        User::where('id', $userID)->update([
            'name' => $request->has('name') ? $request->name : $user_data->name,
            'cnic' => $request->has('cnic') ? $request->cnic : $user_data->cnic,
            'location' => $request->has('location') ? $request->location : $user_data->location,
            'phone_number' => $request->has('phone_number') ? $request->phone_number : $user_data->phone_number,
            'is_approved' => $request->has('is_approved') ? $request->is_approved : $user_data->is_approved
        ]);

        $new_data = User::where('id', $userID)->first();
        return response()->json(['data' => new UserProfileResource($new_data)], 200);
    }

    public function updateUserProfileImage(Request $request, $userID)
    {
        $user_data = User::where('id', $userID)->first();

        $oldImageURL = $user_data->profile_image;

        $profile_image = null;
        if (request('profile_image')) {
            $profile_image = $request->file('profile_image')->store('public/uploaded-files');
            Storage::delete($oldImageURL);
        }

        $result = User::where('id', $userID)->update([
            'profile_image' => $profile_image ? $profile_image : $user_data->profile_image,
        ]);

        if ($result) {
            $new_data = User::where('id', $userID)->first();
            return response()->json(['data' => new UserProfileResource($new_data)], 200);
        } else {
            return response()->json(['message' => "user profile image update error!"], 500);
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
