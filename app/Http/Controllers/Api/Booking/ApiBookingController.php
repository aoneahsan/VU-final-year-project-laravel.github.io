<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Modal\Booking;
use Illuminate\Http\Request;

class ApiBookingController extends Controller
{
    public function getBookings(Request $request)
    {
        $items = Booking::where('user_id', $request->user()->id)->get();
        return response()->json(['data' => BookingResource::collection($items)], 200);
    }

    public function createBooking(Request $request)
    {

        $newdata = Booking::create([
            'user_id' => $request->user()->id,
            'hall_id' => $request->has('hall_id') ? $request->hall_id : null,
            'event_type' => $request->has('event_type') ? $request->event_type : null,
            'no_of_persons' => $request->has('no_of_persons') ? $request->no_of_persons : null,
            'booking_time' => $request->has('booking_time') ? $request->booking_time : null,
            'book_time_from' => $request->has('book_time_from') ? $request->book_time_from : null,
            'book_time_to' => $request->has('book_time_to') ? $request->book_time_to : null,
            'menu' => $request->has('menu') ? $request->menu : null,
            'price' => $request->has('price') ? $request->price : null
        ]);
        return response()->json(['data' => new BookingResource($newdata)], 200);
    }

    public function getBookingData(Request $request, $id)
    {
        $item = Booking::where('user_id', $request->user()->id)->where('id', $id)->first();
        return response()->json(['data' => new BookingResource($item)], 200);
    }

    public function updateBookingData(Request $request, $id)
    {
        $data = Booking::where('user_id', $request->user()->id)->where('id', $id)->first();
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
            return response()->json(['data' => "No Booking Found to update."], 500);
        }
    }

    public function deleteBookingData(Request $request, $id)
    {
        $item = Booking::where('user_id', $request->user()->id)->where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "Booking Data Deleted."], 200);
        } else {
            return response()->json(['data' => "Error while, deleting Booking Data."], 500);
        }
    }
}
