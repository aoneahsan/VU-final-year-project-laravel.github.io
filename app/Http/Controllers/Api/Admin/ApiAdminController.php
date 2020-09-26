<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Hall\HallResource;
use App\Http\Resources\User\UserProfileResource;
use App\Modal\Booking;
use App\Modal\Hall;
use App\User;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{
    // Customer Functions
    public function getCustomers(Request $request)
    {
        $items = User::where('role', 'customer')->get();
        return response()->json(['data' => UserProfileResource::collection($items)], 200);
    }

    // HallManagers Functions
    public function getHallManagers(Request $request)
    {
        $items = User::where('role', 'hall_manager')->get();
        return response()->json(['data' => UserProfileResource::collection($items)], 200);
    }

    public function getUserData(Request $request, $id)
    {
        $item = User::where('id', $id)->first();
        return response()->json(['data' => new UserProfileResource($item)], 200);
    }

    public function updateUserData(Request $request, $id)
    {
        $user_data = User::where('id', $id)->first();
        if ($user_data) {
            $newdata = $user_data->update([
                'name' => $request->has('name') ? $request->name : $user_data->name,
                'location' => $request->has('location') ? $request->location : $user_data->location,
                'cnic' => $request->has('cnic') ? $request->cnic : $user_data->cnic,
                'phone_number' => $request->has('phone_number') ? $request->phone_number : $user_data->phone_number,
                'is_approved' => $request->has('is_approved') ? $request->is_approved : $user_data->is_approved
            ]);
            return response()->json(['data' => new UserProfileResource($newdata)], 200);
        } else {
            return response()->json(['message' => "No User Found to update."], 500);
        }
    }

    public function deleteUserData(Request $request, $id)
    {
        $item = User::where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "User Data Deleted."], 200);
        } else {
            return response()->json(['message' => "Error while, deleting User Data."], 500);
        }
    }

    // Halls Functions
    public function getAllHalls(Request $request)
    {
        $items = Hall::all();
        return response()->json(['data' => HallResource::collection($items)], 200);
    }

    public function getHallData(Request $request, $id)
    {
        $item = Hall::where('id', $id)->first();
        return response()->json(['data' => new HallResource($item)], 200);
    }

    public function updateHallData(Request $request, $id)
    {
        $itemdata = Hall::where('id', $id)->first();
        if ($itemdata) {
            $newdata = $itemdata->update([
                'name' => $request->has('name') ? $request->name : $itemdata->name,
                'description' => $request->has('description') ? $request->description : $itemdata->description,
                'hall_size' => $request->has('hall_size') ? $request->hall_size : $itemdata->hall_size,
                'event_type' => $request->has('event_type') ? $request->event_type : $itemdata->event_type,
                'hall_rent' => $request->has('hall_rent') ? $request->hall_rent : $itemdata->hall_rent,
                'location' => $request->has('location') ? $request->location : $itemdata->location,
                'min_no_of_persons' => $request->has('min_no_of_persons') ? $request->min_no_of_persons : $itemdata->min_no_of_persons,
                'open_time' => $request->has('open_time') ? $request->open_time : $itemdata->open_time,
                'closed_time' => $request->has('closed_time') ? $request->closed_time : $itemdata->closed_time,
                'is_available' => $request->has('is_available') ? $request->is_available : $itemdata->is_available
            ]);
            $itemdata = Hall::where('id', $id)->first();
            return response()->json(['data' => new HallResource($itemdata)], 200);
        } else {
            return response()->json(['message' => "No Hall Found to update."], 500);
        }
    }

    public function deleteHallData(Request $request, $id)
    {
        $item = Hall::where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "Hall Data Deleted."], 200);
        } else {
            return response()->json(['message' => "Error while, deleting Hall Data."], 500);
        }
    }

    // Bookings Functions
    public function getBookings(Request $request)
    {
        $items = Booking::with('user', 'hall')->get();
        return response()->json(['data' => BookingResource::collection($items)], 200);
    }

    public function getBookingData(Request $request, $id)
    {
        $item = Booking::where('id', $id)->first();
        return response()->json(['data' => new BookingResource($item)], 200);
    }

    public function updateBookingData(Request $request, $id)
    {
        $data = Booking::where('id', $id)->first();
        if ($data) {
            $newdata = $data->update([
                'user_id' => $request->has('user_id') ? $request->user_id : $data->user_id,
                'hall_id' => $request->has('hall_id') ? $request->hall_id : $data->hall_id,
                'event_type' => $request->has('event_type') ? $request->event_type : $data->event_type,
                'no_of_persons' => $request->has('no_of_persons') ? $request->no_of_persons : $data->no_of_persons,
                'booking_time' => $request->has('booking_time') ? $request->booking_time : $data->booking_time,
                'book_time_from' => $request->has('book_time_from') ? $request->book_time_from : $data->book_time_from,
                'book_time_to' => $request->has('book_time_to') ? $request->book_time_to : $data->book_time_to,
                'menu' => $request->has('menu') ? $request->menu : $data->menu,
                'price' => $request->has('price') ? $request->price : $data->price
            ]);
            return response()->json(['data' => new BookingResource($newdata)], 200);
        } else {
            return response()->json(['message' => "No Booking Found to update."], 500);
        }
    }

    public function deleteBookingData(Request $request, $id)
    {
        $item = Booking::where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "Booking Data Deleted."], 200);
        } else {
            return response()->json(['message' => "Error while, deleting Booking Data."], 500);
        }
    }
}
