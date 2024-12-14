<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('customer.login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function showRegister()
    {
        return view('customer.register', ['title' => 'Register']);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        
        Customer::create($validatedData);
        return redirect()->route('login')->with('success', 'Account successfully created. Please login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
