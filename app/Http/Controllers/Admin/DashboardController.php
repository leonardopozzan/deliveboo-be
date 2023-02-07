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
        //controllo che l'utente non sia un admin altrimenti gli restituisco tutti i piatti
        if (Auth::user()->is_admin) {
            $dishes = Restaurant::all();
            return view('admin.dashboard', compact('dishes'));
        }else{
            //non essendo admin cerco se esiste un ristorante associato all'utente
            $restaurant = Restaurant::where('user_id',Auth::user()->id)->first();
            if ($restaurant) {
                return view('admin.dashboard', compact('restaurant'));
            }else{
                //se non esiste il ristorante associato all'utente allora gli mostro la create
                $types = Type::all();
                return view('admin.restaurants.create',compact('types'));
            }
        }
    }
}
