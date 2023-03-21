<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->from_user_id = Auth::id();
        $message->to_user_id = $request->input('to_user_id');
        $message->Content = $request->input('Content');
        if ($message->save()) {
    return response()->json([
        'message' => 'Message sent successfully.',
        'data' => $message
            ]);
        } else {
        return response()->json([
        'message' => 'Error sending message.'
        ], 500);
    }
    }
}
