<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilepageController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Save the uploaded picture to the pictures table and get the URL
        $pictureUrl = '';
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/pictures', $filename);
            $pictureUrl = '/storage/pictures/' . $filename;
            $picture = Picture::create([
                'user_id' => $user->id,
                'url' => $pictureUrl
            ]);
        }
        
        // Save the rest of the profile information to the profiles table
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'location' => $request->input('location'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'bio' => $request->input('bio'),
                'interests' => $request->input('interests')
            ]
        );
    
        return response()->json([
            'message' => 'Profile updated successfully',
            'picture_url' => $pictureUrl
        ]);
    }
}    