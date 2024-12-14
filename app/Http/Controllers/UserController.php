<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function searchRestaurants()
    {
        $restaurants = Restaurant::all();
        return view('user.restaurants', compact('restaurants'));
    }

    public function checkAvailability(Request $request)
    {
        // Implement logic to check table availability
        return response()->json(['success' => true]);
    }
}
//  gajadi dipake
