<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ForgotPasswordController;


class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        $email = $request->email;
        $password = Hash::make($request->password);
        $token = $request->token;

        $user = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        DB::table('users')
            ->where('email', $email)
            ->update(['password' => $password]);

        DB::table('password_resets')
            ->where('email', $email)
            ->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }
}
