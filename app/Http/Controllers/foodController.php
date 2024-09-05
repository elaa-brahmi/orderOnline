<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
class foodController extends Controller
{

    public function showbycategory($category){
        $foods = Food::where('category', $category)->get();

        if (request()->ajax()) {
            // Return JSON data if the request is made via AJAX
            return response()->json(['foods' => $foods]);
        }

        // Return the view if it's a normal page request
        return view('dashboard', ['foods' => $foods]);


    }
}
