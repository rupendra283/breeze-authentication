<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function sellerindex(){
        return view('seller.login');
    }



    public function dashboard(){
        return view('seller.index');
    }


    public function login(Request $request){
        $check = $request->all();
        if (Auth::guard('seller')->attempt(['email'=> $check['email'],'password' =>$check['password'] ])) {
            return redirect()->route('seller.dashboard')->with('error','Seller Login Succesfully');
        }
        else {

            return back()->with('error', 'Invalid Email Or Password');
        }
    }


    public function sellerLogout(){

        Auth::guard('seller')->logout();

        return redirect()->route('seller.login_form')->with('error','Seller Logout Succesfully');

    }


    public function sellerRegister(){

        return view('seller.register');

    }

    public function sellerRegisterCreate(Request $request){

        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('seller.login_form')->with('error','Seller Created Succesfully');


    }

}
