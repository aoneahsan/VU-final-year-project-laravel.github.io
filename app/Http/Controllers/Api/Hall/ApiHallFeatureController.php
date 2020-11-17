<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\ApiHallFeatureResource;
use App\Modal\HallFeature;
use Illuminate\Http\Request;

class ApiHallFeatureController extends Controller
{
    public function index($hallID)
    {
        $items = HallFeature::where('hall_id', $hallID)->get();
        return response()->json(['data' => ApiHallFeatureResource::collection($items)], 200);
    }

    public function store(Request $request, $hallID)
    {
        $result = HallFeature::create([
            'hall_id' => $hallID,
            'title' => $request->has('title') ? $request->title : null,
            'description' => $request->has('description') ? $request->description : null,
            'price' => $request->has('price') ? $request->price : null,
            'is_available' => $request->has('is_available') ? $request->is_available : null
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallFeatureResource($result)], 200);
        } else {
            return response()->json(['message' => "Error Occured while creating item!"], 500);
        }
    }

    public function update(Request $request, $hallID, $foodID)
    {
        $item = HallFeature::where('id', $foodID)->where('hall_id', $hallID)->first();
        $result = $item->update([
            'title' => $request->has('title') ? $request->title : $item->title,
            'description' => $request->has('description') ? $request->description : $item->description,
            'price' => $request->has('price') ? $request->price : $item->price,
            'is_available' => $request->has('is_available') ? $request->is_available : $item->is_available
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallFeatureResource($result)], 200);
        } else {
            return response()->json(['message' => "Error Occured while updating item!"], 500);
        }
    }

    public function destroy($hallID, $featureID)
    {
        $item = HallFeature::where('id', $featureID)->first();
        $result = $item->delete();
        if ($result) {
            return response()->json(['data' => 'Deleted!'], 200);
        } else {
            return response()->json(['message' => 'Error Occured while deleting item!'], 500);
        }
    }
}
