<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPaymentRequest;
use App\Mail\CustomerRecap;
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
            'phoneNumber' => 'required|regex:/^([0-9]*)$/|size:10',
        ],[
            'name.required' =>  'Il nome è obbligatorio',
            'name.max' =>  'Il nome non può superare i :max caratteri',
            'email.required' =>  'L\'email è obbligatoria',
            'email.max' =>  'L\'email non può superare i :max caratteri',
            'email.email' =>  'L\'email deve contenere @ e .',
            'address.required' =>  'L\'indirizzo è obbligatorio',
            'address.max' =>  'L\'indirizzo non può superare i :max caratteri',
            'phoneNumber.required' =>  'Il numero di telefono è obbligatorio',
            'phoneNumber.size' =>  'Il numero di telefono deve essere di :size caratteri',
            'phoneNumber.regex' =>  'Il numero di telefono deve contenere solo numeri',

        ]);

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

        $message = "<br> Ordine: <br>";
            foreach ($request->cart as $dishData) {
                $dish = Dish::where('id', $dishData['id'])->first();
                $message .= $dish->name . ", quantità: " . $dishData['quantity'] .  ", prezzo: " . $dishData['price'] . "<br>";
            };

        $new_lead = new Lead();
        $new_lead->name = $data['name'];
        $new_lead->email = $data['email'];
        $new_lead->message = $message;
        $new_lead->save();

        Mail::to($new_lead->email)->send(new CustomerRecap($new_lead, $new_order));

        $restaurant_email = Restaurant::where('id',$request->cart[0]['restaurant_id'])->first()->email;

        $new_lead = new Lead();
        $new_lead->name = $data['name'];
        $new_lead->email = $data['email'];
        $new_lead->message = "http://127.0.0.1:8000/admin/orders/" . $new_order->code;
        $new_lead->save();

        Mail::to($restaurant_email)->send(new NewOrder($new_lead));


        return response()->json([
            'success' => true,
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

    public function checkForm(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'address' => 'required|max:150',
            'phoneNumber' => 'required|regex:/^([0-9]*)$/|size:10',
        ],[
            'name.required' =>  'Il nome è obbligatorio',
            'name.max' =>  'Il nome non può superare i :max caratteri',
            'email.required' =>  'L\'email è obbligatoria',
            'email.max' =>  'L\'email non può superare i :max caratteri',
            'email.email' =>  'L\'email deve contenere @ e .',
            'address.required' =>  'L\'indirizzo è obbligatorio',
            'address.max' =>  'L\'indirizzo non può superare i :max caratteri',
            'phoneNumber.required' =>  'Il numero di telefono è obbligatorio',
            'phoneNumber.size' =>  'Il numero di telefono deve essere di :size caratteri',
            'phoneNumber.regex' =>  'Il numero di telefono deve contenere solo numeri',

        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]); 
        }else{
            return response()->json([
                'success' => true,
            ]); 
        }

    }
}
