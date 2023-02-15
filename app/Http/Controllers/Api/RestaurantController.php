<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Braintree_Transaction;


class RestaurantController extends Controller
{
    public function index(Request $request)
    {

        $type_filter = $request->query('typeFilter');

        $restaurants = Restaurant::when(!empty($type_filter), function ($q) use ($type_filter) {
            $q->whereHas(
                'types',
                function ($q) use ($type_filter) {
                    $q->whereIn('types.slug', $type_filter);
                }
            );
        })->with('types')->get();

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->with('types')->with('dishes.category')->with('dishes', function ($q) {
            $q->orderBy('category_id');
            $q->where('visible', 1);
        })->first();
        if ($restaurant) {
            return response()->json([
                'success' => true,
                'results' => $restaurant,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Non hai trovato nessun prodotto'
            ]);
        }
    }

    public function types()
    {
        $types = Type::all();
        return response()->json([
            'success' => true,
            'types' => $types,
        ]);
    }
    public function categories()
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
