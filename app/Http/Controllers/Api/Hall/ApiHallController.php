<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\HallResource;
use App\Modal\Hall;
use Illuminate\Http\Request;

class ApiHallController extends Controller
{
    public function searchHalls(Request $request)
    {
        // return response()->json(['data' => "%" . $request->name . "%"], 500);
        $items = Hall::where('is_available', 1);
        if ($request->has('name') && !!$request->name) {
            $items->where('name', 'like', "%" . $request->name . "%");
        }
        if ($request->has('minprice') && !!$request->minprice) {
            $items->where('price', '<=', $request->minprice);
        }
        if ($request->has('maxprice') && !!$request->maxprice) {
            $items->where('price', '>=', $request->maxprice);
        }
        if ($request->has('location') && !!$request->location) {
            $items->where('location', $request->location);
        }
        if ($request->has('event_type') && !!$request->event_type) {
            $items->where('event_type', $request->event_type);
        }
        if ($request->has('min_no_of_persons') && !!$request->min_no_of_persons) {
            $items->where('min_no_of_persons', '<=', $request->min_no_of_persons);
        }
        $halls = $items->get();
        return response()->json(['data' => HallResource::collection($halls)], 200);
    }
}
