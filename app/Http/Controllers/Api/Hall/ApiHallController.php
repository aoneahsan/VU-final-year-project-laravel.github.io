<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Hall\HallResource;
use App\Modal\Booking;
use App\Modal\Hall;
use Illuminate\Http\Request;

class ApiHallController extends Controller
{
    public function searchHalls(Request $request)
    {
        // return response()->jsonmessagedata' => +$request->minprice], 500);
        $items = Hall::where('is_available', 1);
        if ($request->has('name')) {
            if (!!$request->name) {
                $items->where('name', 'Like', "%" . $request->name . "%");
            }
        }
        if ($request->has('minprice')) {
            if (!!$request->minprice) {
                $items->where('hall_rent', '>=', +$request->minprice);
            }
            else {
                $items->where('hall_rent', '>=', +1);
            }
        }
        if ($request->has('maxprice')) {
            if (!!$request->maxprice) {
                $items->where('hall_rent', '<=', +$request->maxprice);
            }
            else {
                $items->where('hall_rent', '<=', +1000000000000000);
            }
        }
        if ($request->has('location')) {
            if (!!$request->location) {
                $items->where('location', 'Like', "%" . $request->location . "%");
            }
        }
        if ($request->has('event_type')) {
            if (!!$request->event_type) {
                $items->where('event_type', 'Like', "%" . $request->event_type . "%");
            }
        }
        if ($request->has('min_no_of_persons')) {
            if (!!$request->min_no_of_persons) {
                $items->where('min_no_of_persons', '>=', +$request->min_no_of_persons);
            }
        }
        $halls = $items->get();
        return response()->json(['data' => HallResource::collection($halls)], 200);
    }

    public function getAllHalls(Request $request)
    {
        $items = Hall::where('user_id', $request->user()->id)->get();
        return response()->json(['data' => HallResource::collection($items)], 200);
    }

    public function createHall(Request $request)
    {
        $newdata = Hall::create([
            'user_id' => $request->user()->id,
            'name' => $request->has('name') ? $request->name : null,
            'description' => $request->has('description') ? $request->description : null,
            'hall_size' => $request->has('hall_size') ? $request->hall_size : null,
            'event_type' => $request->has('event_type') ? $request->event_type : null,
            'hall_rent' => $request->has('hall_rent') ? $request->hall_rent : null,
            'location' => $request->has('location') ? $request->location : null,
            'min_no_of_persons' => $request->has('min_no_of_persons') ? $request->min_no_of_persons : null,
            'is_available' => $request->has('is_available') ? $request->is_available : null
        ]);
        return response()->json(['data' => new HallResource($newdata)], 200);
    }

    public function getHallData(Request $request, $id)
    {
        $item = Hall::where('user_id', $request->user()->id)->where('id', $id)->first();
        return response()->json(['data' => new HallResource($item)], 200);
    }

    public function updateHallData(Request $request, $id)
    {
        $itemdata = Hall::where('user_id', $request->user()->id)->where('id', $id)->first();
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
            $itemdata = Hall::where('user_id', $request->user()->id)->where('id', $id)->first();
            return response()->json(['data' => new HallResource($itemdata)], 200);
        } else {
            return response()->json(['message' => "No Hall Found to update."], 500);
        }
    }

    public function deleteHallData(Request $request, $id)
    {
        $item = Hall::where('user_id', $request->user()->id)->where('id', $id)->delete();
        if ($item) {
            return response()->json(['data' => "Hall Data Deleted."], 200);
        } else {
            return response()->json(['message' => "Error while, deleting Hall Data."], 500);
        }
    }

    public function getHallBookingsData(Request $request, $id)
    {
        $item = Hall::where('user_id', $request->user()->id)->where('id', $id)->first();
        if ($item) {
            $items = Booking::where('hall_id', $item->id)->get();
            return response()->json(['data' => BookingResource::collection($items)], 200);
        } else {
            return response()->json(['message' => "Not Found."], 404);
        }
    }
}
