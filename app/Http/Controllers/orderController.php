<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\client;
use App\Models\commande;
use App\Models\ligne_commande;
class orderController extends Controller
{
    public function order(Request $request){
        $validateddata=$request->validate([
            'mail'=>'required|email',
            'phone'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'adress'=>'required',
            'zipcode'=>'required',
        ]);
        $order=new client();
        $order->mail=$validateddata['mail'];
        $order->phone=$validateddata['phone'];
        $order->name=$validateddata['fname'];
        $order->lastname=$validateddata['lname'];
        $order->adress=$validateddata['adress'];
        $order->zipcode=$validateddata['zipcode'];
        $order->save();
        $clientId= $client->idclient;
        $commande=new commande();
        $commande->idclient=$clientId ;
        $commande->save();
        $cart = json_decode($request->input('cart'), true);
        foreach($cart as $item){
            $ligne_commande=new ligne_commande();
            $ligne_commande->idfood=$item['id_food'];
            $ligne_commande->price=$item['price'];
            $ligne_commande->food_name=$item['food_name'];

            $ligne_commande->save();
        }
        return redirect()->rout('backtodashboard')->with('successOrder','order placed successfully!');


    }
}
