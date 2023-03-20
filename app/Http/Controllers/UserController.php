<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class UserController extends Controller
{ //The UserController that filters the genders
    public function index(Request $request)
    {
        $gender=$request->input('gender');
        $registrations=Registration::where('gender',$gender)->get();
        return response()->json($registrations);
    }
}
