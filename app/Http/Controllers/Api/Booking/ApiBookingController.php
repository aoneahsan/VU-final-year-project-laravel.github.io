<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Hall\ApiHallFeatureResource;
use App\Http\Resources\Hall\ApiHallFoodResource;
use App\Http\Resources\Hall\HallResource;
use App\Modal\Booking;
use App\Modal\Hall;
use App\Modal\HallFeature;
use App\Modal\HallFeedback;
use App\Modal\HallFood;
use App\Modal\HallSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiBookingController extends Controller
{
    public function index(Request $request)
    {
        $items = Booking::where('user_id', $request->user()->id)->get();
        return response()->json(['data' => BookingResource::collection($items)], 200);
    }

    public function store(Request $request)
    {
        $date = new Carbon($request->bookingSlotData['date']);
        $bookingItem = Booking::create([
            'user_id' => $request->user()->id,
            'hall_id' => $request->bookingData['hall_id'],
            'event_type' => $request->bookingData['event_type'],
            'no_of_persons' => $request->bookingData['no_of_persons'],
            'booking_date' => $date,
            'book_time_from' => $request->bookingData['book_time_from'],
            'book_time_to' => $request->bookingData['book_time_to'],
            'status' => 'pending',
            'menu' => json_encode($request->bookingData['menu']),
            'extra_features' => json_encode($request->bookingData['extra_features']),
            'price' => $request->bookingData['price']
        ]);
        $bookingSlotItem = HallSlot::create([
            'user_id' => $request->user()->id,
            'hall_id' => $request->bookingSlotData['hall_id'],
            'booking_id' => $bookingItem->id,
            'hall_time_id' => $request->bookingSlotData['hall_time_id'],
            'date' => $date,
            'is_active' => true
        ]);
        return response()->json(['data' => new BookingResource($bookingItem)], 200);
    }

    public function show(Request $request, $bookingId)
    {
        $item = Booking::where('user_id', $request->user()->id)->where('id', $bookingId)->with('user', 'hall')->first();
        $food_items_ids = !!$item->menu ? json_decode($item->menu) : null;
        $extra_features_ids = !!$item->extra_features ? json_decode($item->extra_features) : null;
        $food_items = null;
        if ($food_items_ids) {
            $food_items = HallFood::whereIn('id', $food_items_ids)->get();
        }
        $food_items_resource = [];
        if ($food_items) {
            $food_items_resource = ApiHallFoodResource::collection($food_items);
        }
        $extra_features = null;
        if ($extra_features_ids) {
            $extra_features = HallFeature::whereIn('id', $extra_features_ids)->get();
        }
        $extra_features_resource = [];
        if ($extra_features) {
            $extra_features_resource = ApiHallFeatureResource::collection($extra_features);
        }
        $booking_Feedback = HallFeedback::where('booking_id', $bookingId)->first();
        return response()->json([
            'data' => new BookingResource($item),
            'food_items' => $food_items_resource,
            'extra_features' => $extra_features_resource,
            'booking_Feedback' => $booking_Feedback
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Booking::where('user_id', $request->user()->id)->where('id', $id)->first();
        if ($data) {
            $newdata = $data->update([
                'user_id' => $request->has('user_id') ? $request->user_id : $data->user_id,
                'hall_id' => $request->has('hall_id') ? $request->hall_id : $data->hall_id,
                'event_type' => $request->has('event_type') ? $request->event_type : $data->event_type,
                'no_of_persons' => $request->has('no_of_persons') ? $request->no_of_persons : $data->no_of_persons,
                'booking_date' => $request->has('booking_date') ? $request->booking_date : $data->booking_date,
                'book_time_from' => $request->has('book_time_from') ? $request->book_time_from : $data->book_time_from,
                'book_time_to' => $request->has('book_time_to') ? $request->book_time_to : $data->book_time_to,
                'status' => $request->has('status') ? $request->status : $data->status,
                'menu' => $request->has('menu') ? $request->menu : $data->menu,
                'extra_features' => $request->has('extra_features') ? $request->extra_features : $data->extra_features,
                'price' => $request->has('price') ? $request->price : $data->price
            ]);
            return response()->json(['data' => new BookingResource($newdata)], 200);
        } else {
            return response()->json(['data' => "No Booking Found to update."], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $item = Booking::where('user_id', $request->user()->id)->where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "Booking Data Deleted."], 200);
        } else {
            return response()->json(['data' => "Error while, deleting Booking Data."], 500);
        }
    }

    public function getHallData(Request $request, $hallId)
    {
        $item = Hall::where('id', $hallId)
            ->with('foods', 'features', 'timings')
            ->first();
        $date = new Carbon($request->date);
        $hallBookedSlots = HallSlot::where('hall_id', $hallId)->where('date', $date)->where('is_active', true)->get()->pluck('hall_time_id');

        return response()->json([
            'data' => new HallResource($item),
            'hallBookedSlots' => $hallBookedSlots
        ], 200);
    }

    public function placeFeedback(Request $request, $bookingId)
    {
        $booking = Booking::where('id', $bookingId)->first();
        $feedback = HallFeedback::create([
            'booking_Id' => $bookingId,
            'hall_id' => $booking->hall_id,
            'user_id' => $request->user()->id,
            'feedback' => $request->has('feedback') ? $request->feedback : null,
            'rating' => $request->has('rating') ? $request->rating : null
        ]);
        $booking->update([
            'feedback_provided_at' => $feedback->created_at
        ]);
        return response()->json([
            'data' => "Request Successfull"
        ], 200);
    }
}
