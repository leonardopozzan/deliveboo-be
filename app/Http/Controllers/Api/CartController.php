<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPaymentRequest;
use App\Models\Dish;
use App\Models\Order;
use Braintree\Gateway;
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
        $new_order->payment_status = $request->paymentStatus == 'true';
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

    public function makePayment(Request $request, Gateway $gateway){

        $result = $gateway->transaction()->sale([
            'amount' =>  $request->amount,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
            'submitForSettlement' => true
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => 'transazione eseguita'
                ];
                return response()->json($data);
            } else{
            $data = [
            'success' => false,
                'message' => 'transazione fallita'
            ];
            return response()->json($data);
            }
            
    }

    public function generate(Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
        	'token' => $token
        ];
        return response()->json($data);
        
        }
}
