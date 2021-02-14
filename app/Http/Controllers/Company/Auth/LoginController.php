<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:company', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('company-views.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('company.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('company')->logout();
        $request->session()->invalidate();
        return redirect()->route('company.auth.login');
    }
}
