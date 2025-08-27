<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
//     public function store(LoginRequest $request): RedirectResponse
//     {
//     //     $request->authenticate();

//     //     $request->session()->regenerate();

//     //     return redirect()->intended(route('dashboard', absolute: false));
//     // perform authentication (Breeze LoginRequest already handles attempt)
//    $request->authenticate();
//     $request->session()->regenerate();

//     $user = Auth::user();

//     if ($user->role === 'admin') {
//         return redirect()->intended('/admin/dashboard');
//     } elseif ($user->role === 'vendor') {
//         return redirect()->intended('/vendor/dashboard');
//     } else {
//         return redirect()->intended('/index');
//     }
// }
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate(); 
    $user = Auth::user();

    // Allow only role 'user'
    if ($user->role !== 'user') {
        Auth::guard('web')->logout();
        return back()->withErrors([
            'email' => 'Only users are allowed to login here.'
        ]);
    }

    $request->session()->regenerate();
    return redirect()->intended('/index'); 
}
    /**
     * Destroy an authenticated session.
     */
  public function destroy(Request $request): RedirectResponse
{
    $user = Auth::user(); 
    $role = $user ? $user->role : null; 

    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    if ($role === 'admin') {
        return redirect()->route('admin.login'); 
    } elseif ($role === 'vendor') {
        return redirect()->route('vendor.login'); 
    } else {
        return redirect()->route('home'); 
    }
}
}
