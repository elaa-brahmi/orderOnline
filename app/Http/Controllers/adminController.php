<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class adminController extends Controller
{
    public function authen(Request $req){
        $login=$req->input('login');
        $password=$req->input('password');
        $admin=DB::table('admin')->where('id',$login)->first();
        if ($admin && $admin->password === $password)  {
            return redirect()->route('auth')->with('success', 'Welcome Admin!');
        } else {
            return back()->withErrors(['login' => 'Invalid credentials.']);
        }

    }
}
