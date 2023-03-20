<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\User;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find($request->input('favorite_id'));
        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->favorite_id = $user->id;
        $favorite->save();

        return response()->json([
            'message' => 'User favorited successfully.',
            'favorite' => $favorite
        ]);
    }

    public function destroy($id)
    {
        $favorite = Favorite::find($id);
        if (!$favorite) {
            return response()->json([
                'error' => 'Favorite not found'
            ], 404);
        }

        if ($favorite->user_id != Auth::id()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'User removed from favorites successfully.'
        ]);
    }
}
