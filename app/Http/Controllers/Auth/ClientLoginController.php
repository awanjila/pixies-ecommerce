<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;




class ClientLoginController extends Controller
{

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // If validation fails, redirect back with validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::guard('client')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('catalog.index'));
        }
    
        // Authentication failed...
        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }





    
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }//endmethod

    public function checkAuthentication()
        {
            // Check if the user is authenticated
            if (auth('client')->check()) {
                return response()->json(['authenticated' => true]);
            } else {
                return response()->json(['authenticated' => false]);
            }
        }//endmethod
}
