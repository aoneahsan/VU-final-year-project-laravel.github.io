<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\ApiHallBookingResource;
use App\Modal\Booking;
use App\Modal\HallSlot;
use Illuminate\Http\Request;

class ApiHallBookingController extends Controller
{
    public function update(Request $request, $hallID, $foodID)
    {
        $item = Booking::where('id', $foodID)->where('hall_id', $hallID)->first();
        $result = $item->update([
            'user_id' => $request->has('user_id') ? $request->user_id : $item->user_id,
            'hall_id' => $request->has('hall_id') ? $request->hall_id : $item->hall_id,
            'event_type' => $request->has('event_type') ? $request->event_type : $item->event_type,
            'no_of_persons' => $request->has('no_of_persons') ? $request->no_of_persons : $item->no_of_persons,
            'booking_date' => $request->has('booking_date') ? $request->booking_date : $item->booking_date,
            'book_time_from' => $request->has('book_time_from') ? $request->book_time_from : $item->book_time_from,
            'book_time_to' => $request->has('book_time_to') ? $request->book_time_to : $item->book_time_to,
            'status' => $request->has('status') ? $request->status : $item->status,
            'menu' => $request->has('menu') ? $request->menu : $item->menu,
            'price' => $request->has('price') ? $request->price : $item->price
        ]);
        if ($request->status == 'disapproved') {
            HallSlot::where('booking_id', $item->id)->update([
                'is_active' => false
            ]);
        }

        if ($result) {
            $item = Booking::where('id', $foodID)->where('hall_id', $hallID)->first();
            return response()->json(['data' => new ApiHallBookingResource($item)], 200);
        } else {
            return response()->json(['message' => "Error Occured while updating item!"], 500);
        }
    }
}
