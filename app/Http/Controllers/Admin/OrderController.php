<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //controllo che l'utente abbia un ristorante
        if(!Auth::user()->restaurant){
            abort(404, '$Non hai ancora un Ristorante');
        }
        $restaurant_id = Auth::user()->restaurant->id;
        $orders = Order::whereHas( 'dishes', function ($query) use ($restaurant_id) {
                $query->withTrashed();
                $query->where('restaurant_id', $restaurant_id);
            }
        )->orderBy('id', 'DESC')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //controllo che l'utente abbia un ristorante
        if(!Auth::user()->restaurant){
            abort(404, '$Non hai ancora un Ristorante');
        }
        //controllo che il ristoratore stia accedendo solo ai suoi piatti tramite l'id utente
        $restaurant_id = Auth::user()->restaurant->id;
        $dish = $order->dishes()->first();
        if ($restaurant_id !== $dish->restaurant_id) {
            abort(403, '$Non sei autorizzato ad accedere');
        }
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
