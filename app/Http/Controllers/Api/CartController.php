<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPaymentRequest;
use App\Mail\NewOrder;
use App\Models\Dish;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Restaurant;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Faker\Generator as Faker;

class CartController extends Controller
{
    public function purchase(Request $request, Faker $faker){
        
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'address' => 'required|max:150',
            'phoneNumber' => 'required|regex:/^([0-9]*)$/|max:10',
        ],);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]); 
        }

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



        $new_lead = new Lead();
        $new_lead->name = $data['name'];
        $new_lead->email = $data['email'];
        $new_lead->message = $new_order->code;
        $new_lead->save();

        Mail::to($new_lead->email)->send(new NewOrder($new_lead));

        $restaurant_email = Restaurant::where('id',$request->cart[0]['restaurant_id'])->first()->email;
        
        Mail::to($restaurant_email)->send(new NewOrder($new_lead));


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
