<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\ApiHallTimeResource;
use App\Modal\HallTime;
use Illuminate\Http\Request;

class ApiHallTimeController extends Controller
{
    public function index($hallID)
    {
        $items = HallTime::where('hall_id', $hallID)->get();
        return response()->json(['data' => ApiHallTimeResource::collection($items)], 200);
    }

    public function store(Request $request, $hallID)
    {
        $result = HallTime::create([
            'hall_id' => $hallID,
            'start_time' => $request->has('start_time') ? $request->start_time : null,
            'end_time' => $request->has('end_time') ? $request->end_time : null
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallTimeResource($result)], 200);
        } else {
            return response()->json(['message' => "Error Occured while creating item!"], 500);
        }
    }

    public function update(Request $request, $hallID, $id)
    {
        $item = HallTime::where('id', $id)->where('hall_id', $hallID)->first();
        $result = $item->update([
            'start_time' => $request->has('start_time') ? $request->start_time : $item->start_time,
            'end_time' => $request->has('end_time') ? $request->end_time : $item->end_time
        ]);

        if ($result) {
            $item = HallTime::where('id', $id)->where('hall_id', $hallID)->first();
            return response()->json(['data' => new ApiHallTimeResource($item)], 200);
        } else {
            return response()->json(['message' => "Error Occured while updating item!"], 500);
        }
    }

    public function destroy($hallID, $id)
    {
        $result = HallTime::where('id', $id)->delete();
        if ($result) {
            return response()->json(['data' => 'Deleted!'], 200);
        } else {
            return response()->json(['message' => 'Error Occured while deleting item!'], 500);
        }
    }
}
