<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $restaurants = Restaurant::take(5)->get();
        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show($slug){
        $restaurant = Restaurant::where('slug',$slug)->with('dishes')->first();
        if($restaurant){
            return response()->json([
                'success' => true,
                'results' => $restaurant
            ]);
        }else{
            return response()->json([
                'success' => false,
                'results' => 'Non hai trovato nessun prodotto'
            ]);
        }
        
    }

    public function types(){
        $types = Type::all();
        return response()->json([
            'success' => true,
            'types' => $types,
        ]);
    }
    public function categories(){
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
