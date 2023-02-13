<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Faker\Generator as Faker;

class CartController extends Controller
{
    public function purchase(Request $request, Faker $faker){

        $new_order = new Order();
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
        $code = $today . $rand;
        $new_order->code = $code;
        $new_order->name = $request->name;
        $new_order->address = $request->address;
        $new_order->email = $request->email;
        $new_order->phone_number = $request->phoneNumber;
        $new_order->date = today();
        $new_order->total_price = $request->totalPrice;
        $new_order->payment_status = true;
        $new_order->save();

        $list_item = [];
        foreach($request->cart as $item){
            $key = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $list_item[$key] = ['quantity' => $quantity , 'current_price' => $price];
        }
        $new_order->dishes()->attach($list_item);

        return response()->json([
            'results' => $request->all(),
            'order' => $new_order
        ]);
    }
}
