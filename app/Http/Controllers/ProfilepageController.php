<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilepageController extends Controller
{
    public function update(Request $request)
    {
        // Authenticate the user and get their ID
        $user = Auth::user();
        $user_id = $user->id;

        // Retrieve the profile data from the request
        $location = $request->input('location');
        $age = $request->input('age');
        $gender = $request->input('gender');
        $bio = $request->input('bio');
        $interests = $request->input('interests');

        // Update the profile in the database
        $profiles=Profile::where('user_id',$user_id)->first();
        
            $profiles->update([
                'location' => $location,
                'age' => $age,
                'gender' => $gender,
                'bio' => $bio,
                'interests' => $interests,
            ]);

        // Store the profile picture in the database
        $picture = $request->file('picture')->store('pictures');
        DB::table('pictures')
            ->where('user_id', $user_id)
            ->update([
                'picture' => $picture,
            ]);

        return response()->json(['success' => true]);
    }
}
