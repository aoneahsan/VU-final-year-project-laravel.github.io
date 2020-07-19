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
    public function getCustomers()
    {
        $items = User::where('role', 'customer')->get();
        return response()->json(['data' => UserProfileResource::collection($items)], 200);
    }

    public function getHallManagers(Request $request)
    {
        $items = User::where('role', 'hall_manager')->get();
        return response()->json(['data' => UserProfileResource::collection($items)], 200);
    }

    public function getAllHalls(Request $request)
    {
        $items = Hall::all();
        return response()->json(['data' => HallResource::collection($items)], 200);
    }

    public function getBookings(Request $request)
    {
        $items = Booking::all();
        return response()->json(['data' => BookingResource::collection($items)], 200);
    }
}
