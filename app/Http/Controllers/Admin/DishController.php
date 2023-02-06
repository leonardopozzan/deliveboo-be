<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $dishes = Dish::paginate(10);
            return view('admin.dishes.index', compact('dishes'));
        }else{
            $restaurant = Restaurant::find(Auth::user()->id);
            $restaurant_id = $restaurant->id;

            $dishes = Dish::where('restaurant_id', $restaurant_id)->paginate(10);
            return view('admin.dishes.index', compact('dishes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.dishes.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        $data = $request->validated();

        $restaurant = Restaurant::find(Auth::user()->id);
        $restaurant_id = $restaurant->id;

        $slug = Dish::getSlug($request->name, $restaurant_id);
        $data['slug'] = $slug;

        $data['restaurant_id'] = $restaurant_id;


        if($request->hasFile('image')){
            $path = Storage::put('img', $request->image);
            $data['image'] = $path;
        }

        $new_dish = Dish::create($data);
        return redirect()->route('admin.dishes.show', $new_dish->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDishRequest  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            $path = Storage::put('img', $request->image);
            $data['image'] = $path;
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.index')->with('message', "$dish->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('message', "$dish->name deleted successfully");
    }
}
