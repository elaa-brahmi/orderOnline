<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;
use App\Models\Client;
use App\Models\Commande;
use App\Models\LigneCommande;


class adminController extends Controller
{
    public function authen(Request $req){
        if($req->isMethod('get')){
            return redirect()->route("authentification");
        }
        $login=$req->input('login');
        $password=$req->input('password');
        $admin=DB::table('admin')->where('id',$login)->first();
        if ($admin && $admin->password === $password)  {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } else {
            return back()->withErrors(['login' => 'Invalid credentials.']);
        }

    }
    public function display_food(){
        $foods=Food::all();
        if(request()->ajax()){
            return response()->json(["foods"=>$foods]);
        }
        return view("espaceAdmin",['foods'=>$foods]);

    }
    public function save_food(Request $request){
        $food=new Food;
        $food->name=$request->input('name');
        $food->description=$request->input('description');
        $food->category=$request->input('category');
        $food->price=$request->input('price');
        $food->photo=$request->input('photo');
        $food->save();
        return redirect()->route('foodadded')->with("foodadded",'food added successfully');
    }
    public function delete($idfood){
        $food=Food::find($idfood);
        $food->delete();
        return response()->json(['success'=>'food deleted !']);

    }
    public function getfood($id){
        $food=Food::find($id);
        return response()->json(["food"=>$food]);
    }
    public function update(Request $request){

        $id=$request->input('id');
        $food=Food::find($id);
        if (!$food) {
            // Handle the case where the food item isn't found
            return redirect()->back()->with('error', 'Food item not found.');
        }
        $food->name=$request->input('name');
        $food->description=$request->input('description');
        $food->category=$request->input('category');
        $food->price=$request->input('price');
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->move(public_path('pics'), $request->file('photo')->getClientOriginalName());
            // Save the relative path (just the filename) in the database
            $food->photo = $request->file('photo')->getClientOriginalName();
        }
        $food->save();
        return redirect()->route('displayFood')->with("foodupdated",'food updated successfully');
    }
    public function orders(){
        $commandes=Commande::select('idclient','updated_at','idcommande')->get();
        $orders=[];
        foreach($commandes as $commande){
            $client=Client::where('idclient',$commande->idclient)->first();
            $items_ordered = LigneCommande::where('idcommande', $commande->idcommande)->get();
            $orders[$commande->idcommande]=[
                'client'=>$client,
                'commande'=>$commande,
                'items_ordered'=>$items_ordered
            ];
        }
        return response()->json(['orders' => $orders ]);
    }
}
