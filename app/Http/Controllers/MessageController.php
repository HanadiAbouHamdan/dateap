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
    //creating a method called inbox to read the message recieved
    public function inbox()
{
    $user = Auth::user();
    $messages = Message::where('to_user_id', $user->id)->orderBy('created_at', 'desc')->get();
    return response()->json([
        'messages' => $messages
    ]);    
}
    //creating a method called reply in order to reply on the messages
    public function reply(Request $request, Message $message)
    {
        $reply = new Message();
        $reply->from_user_id = Auth::id();
        $reply->to_user_id = $message->from_user_id;
        $reply->content = $request->input('content');
        $reply->save();
        return response()->json([
            'message' => 'Reply sent successfully.',
            'data' => $reply
        ]);
    }
    


}
