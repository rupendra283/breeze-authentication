<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email'=> $check['email'],'password' =>$check['password'] ])) {
            return redirect()->route('admin.dashboard')->with('error','Admin Login Succesfully');
        }
        else {

            return back()->with('error', 'Invalid Email Or Password');
        }
    }
    public function dashboard(){
        return view('admin.index');
    }
    public function adminLogout(){

        Auth::guard('admin')->logout();

        return redirect()->route('login_form')->with('error','Admin Logout Succesfully');

    }

    public function adminRegister(){

        return view('admin.register');

    }

    public function adminRegisterCreate(Request $request){

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login_form')->with('error','Admin Created Succesfully');


    }

}
