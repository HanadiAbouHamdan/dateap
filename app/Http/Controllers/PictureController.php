<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image file
        $path = $validatedData['picture']->store('public/profile-pictures');

        // Create a new picture record in the database
        $picture = new Picture();
        $picture->user_id = $request->user()->id;
        $picture->url = Storage::url($path);
        $picture->save();

        return response()->json(['url' => $picture->url], 201);
    }
}
