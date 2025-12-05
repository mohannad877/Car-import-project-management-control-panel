<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('car')->latest()->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $carId = $request->car_id;
        $favorite = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('car_id', $carId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed', 'message' => 'تم الإزالة من المفضلة']);
        } else {
            \App\Models\Favorite::create([
                'user_id' => auth()->id(),
                'car_id' => $carId,
            ]);
            return response()->json(['status' => 'added', 'message' => 'تم الإضافة للمفضلة']);
        }
    }

    public function check($carId)
    {
        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('car_id', $carId)
            ->exists();
        return response()->json(['is_favorite' => $isFavorite]);
    }
}
