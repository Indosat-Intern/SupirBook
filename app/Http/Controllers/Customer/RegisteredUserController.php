<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('customerss.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
            'division' => 'required',
            'phone' => 'required',
        ]);

        Auth::login($user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'division' => $request->division,
            'phone' => $request->phone,
        ]));

        event(new Registered($user));

        Auth::guard('customer')->login($user);

        return redirect()->route('welcome');
    }

}
