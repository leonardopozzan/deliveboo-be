<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        if (Auth::user()->is_admin) {
            $dishes = Restaurant::all();
            return view('admin.dashboard', compact('dishes'));
        }else{
            $restaurant = Restaurant::where('user_id',Auth::user()->id)->first();
            if ($restaurant) {
                return view('admin.dashboard', compact('restaurant'));
            }else{
                $types = Type::all();
                return view('admin.restaurants.create',compact('types'));
            }
        }
    }
}
