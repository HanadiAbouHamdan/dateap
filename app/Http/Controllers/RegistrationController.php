<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use App\Models\User;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string|in:male,female',
            'age' => 'required|integer|min:18|max:120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        //adding the name email and password to the table users
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

      

        $registration = new Registration;
        $registration->name = $request->name;
        $registration->email = $request->email;
        $registration->password = bcrypt($request->password);
        $registration->gender = $request->gender;
        $registration->age = $request->age;
        $registration->save();

        return response()->json([
            'message' => 'Registration successful!',
            'user' => $registration
        ], 201);
    }
}
