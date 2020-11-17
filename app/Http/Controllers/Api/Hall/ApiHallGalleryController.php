<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\ApiHallGalleryResource;
use App\Modal\HallGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiHallGalleryController extends Controller
{
    public function index($hallID)
    {
        $items = HallGallery::where('hall_id', $hallID)->get();
        return response()->json(['data' => ApiHallGalleryResource::collection($items)], 200);
    }

    public function store(Request $request, $hallID)
    {
        $file_path = null;
        if (request('file')) {
            $file_path = $request->file('file')->store('public/uploaded-files');
        }

        $result = HallGallery::create([
            'hall_id' => $hallID,
            'file_name' => $request->has('file_name') ? $request->file_name : null,
            'file_path' => $file_path
        ]);

        if ($result) {
            return response()->json(['data' => new ApiHallGalleryResource($result)], 200);
        } else {
            return response()->json(['message' => "user profile image update error!"], 500);
        }
    }

    public function destroy($hallID, $imageID)
    {
        $item = HallGallery::where('id', $imageID)->first();
        Storage::delete($item->file_path);
        $result = $item->delete();
        if ($result) {
            return response()->json(['data' => 'Deleted!'], 200);
        } else {
            return response()->json(['message' => 'Error Occured while deleting item!'], 500);
        }
    }
}
