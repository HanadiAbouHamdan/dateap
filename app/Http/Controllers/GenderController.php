<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;

class GenderController extends Controller
{
    public function oppositeGender(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Get the gender of the authenticated user from the registrations table
        $gender = Registration::where('user_id', $user->id)->value('gender');

        // Get the opposite gender
        $oppositeGender = $gender === 'male' ? 'female' : 'male';

        // Get users with the opposite gender
        $users = User::whereHas('registration', function ($query) use ($oppositeGender) {
            $query->where('gender', $oppositeGender);
        })->get();

        return response()->json([
            'status' => 'success',
            'users' => $users
        ]);
    }
}

