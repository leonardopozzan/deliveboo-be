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
        //controllo che l'utente sia o no admin
        //se admin gli restituisco tutti i piatti di tutto il sito 
        //altrimenti restituisco i piatti del ristoratore che è loggata
        if (Auth::user()->is_admin) {
            $dishes = Dish::paginate(10);
            return view('admin.dishes.index', compact('dishes'));
        }else{
            if(Auth::user()->restaurant){
                $restaurant_id = Auth::user()->restaurant->id;;

                $dishes = Dish::where('restaurant_id', $restaurant_id)->paginate(10);
                return view('admin.dishes.index', compact('dishes'));
            }
            abort(404, '$Non hai ancora un Ristorante');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->restaurant){
            abort(404, '$Non hai ancora un Ristorante');
        }
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
        $restaurant_id = Auth::user()->restaurant->id;
        $data['restaurant_id'] = $restaurant_id;

        $slug = Dish::getSlug($request->name, $restaurant_id);
        $data['slug'] = $slug;

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
        if(!Auth::user()->restaurant){
            abort(404, '$Non hai ancora un ristorante');
        }
        //controllo che il ristoratore stia accedendo solo ai suoi piatti tramite l'id utente
        $restaurant_id = Auth::user()->restaurant->id;
        if ($restaurant_id !== $dish->restaurant_id) {
            abort(403, '$Non sei autorizzato ad accedere');
        }
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
        //controllo che il ristoratore abbia un ristorante
        if(!Auth::user()->restaurant){
            abort(404, '$Non hai ancora un Ristorante');
        }

        //controllo che il ristoratore stia accedendo solo ai suoi piatti tramite l'id utente
        $restaurant_id = Auth::user()->restaurant->id;
        if ($restaurant_id !== $dish->restaurant_id) {
            abort(403, '$Non sei autorizzato ad accedere');
        }

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

        return redirect()->route('admin.dishes.show', $dish->slug)->with('message', "$dish->name aggiornato con successo");
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
        return redirect()->route('admin.dishes.index')->with('message', "$dish->name eliminato con successo");
    }
}
