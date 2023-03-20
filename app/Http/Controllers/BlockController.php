<?php

namespace App\Http\Controllers;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlockController extends Controller
{
    public function addBlock(Request $request)
    {
        $authenticatedUser = Auth::user();
        $blockUser = User::findOrFail($request->input('user_id'));
        $authenticatedUser->blocks()->attach($blockUser->id);

        return response()->json([
            'message' => 'User blocked successfully.',
            'blocks' => $authenticatedUser->blocks
        ]);
    }

    public function removeBlock(Request $request)
    {
        $authenticatedUser = Auth::user();
        $blockUser = User::findOrFail($request->input('user_id'));
        $authenticatedUser->blocks()->detach($blockUser->id);

        return response()->json([
            'message' => 'User unblocked successfully.',
            'blocks' => $authenticatedUser->blocks
        ]);
    }
}
