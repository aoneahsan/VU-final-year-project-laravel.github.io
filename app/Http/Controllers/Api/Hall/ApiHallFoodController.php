<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\ApiHallFoodResource;
use App\Modal\HallFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiHallFoodController extends Controller
{
    public function index($hallID)
    {
        $items = HallFood::where('hall_id', $hallID)->get();
        return response()->json(['data' => ApiHallFoodResource::collection($items)], 200);
    }

    public function store(Request $request, $hallID)
    {
        $result = HallFood::create([
            'hall_id' => $hallID,
            'title' => $request->has('title') ? $request->title : null,
            'price' => $request->has('price') ? $request->price : null,
            'is_available' => $request->has('is_available') ? $request->is_available : null
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallFoodResource($result)], 200);
        } else {
            return response()->json(['message' => "Error Occured while creating item!"], 500);
        }
    }

    public function update(Request $request, $hallID, $foodID)
    {
        $item = HallFood::where('id', $foodID)->where('hall_id', $hallID)->first();
        $result = $item->update([
            'title' => $request->has('title') ? $request->title : $item->title,
            'price' => $request->has('price') ? $request->price : $item->price,
            'is_available' => $request->has('is_available') ? $request->is_available : $item->is_available
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallFoodResource($result)], 200);
        } else {
            return response()->json(['message' => "Error Occured while updating item!"], 500);
        }
    }

    public function destroy($hallID, $foodID)
    {
        $item = HallFood::where('id', $foodID)->first();
        Storage::delete($item->file_path);
        $result = $item->delete();
        if ($result) {
            return response()->json(['data' => 'Deleted!'], 200);
        } else {
            return response()->json(['message' => 'Error Occured while deleting item!'], 500);
        }
    }
}
