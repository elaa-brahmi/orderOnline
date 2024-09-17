<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Commande;
use App\Models\LigneCommande;
class orderController extends Controller
{
    public function order(Request $request){
        $validateddata=$request->validate([
            'mail'=>'required|email',
            'phone'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'town'=>'required',
            'zipcode'=>'required',
        ]);
        $client=new Client();
        $client->mail=$validateddata['mail'];
        $client->phone=$validateddata['phone'];
        $client->name=$validateddata['fname'];
        $client->lastname=$validateddata['lname'];
        $client->adress=$validateddata['town'];
        $client->zipcode=$validateddata['zipcode'];
        $client->save();
        $clientId= $client->idclient;
        $commande=new Commande();
        $commande->idclient=$clientId ;
        $commande->save();
        $cart = json_decode($request->input('cart'), true);
        foreach($cart as $item){
            $ligne_commande=new LigneCommande();
            $ligne_commande->idcommande=$commande->idcommande;
            $ligne_commande->idfood=$item['id_food'];
            $ligne_commande->price=$item['price'];
            $ligne_commande->food_name=$item['food_name'];
            $ligne_commande->save();
        }
        return redirect()->route('backtodashboard')->with('successOrder','order placed successfully!');
    }
}
