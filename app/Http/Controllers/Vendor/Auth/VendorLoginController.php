<?php
namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class VendorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('vendor.auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('vendor')->attempt($credentials, $request->filled('remember'))) {

        return redirect()->intended(route('vendor.dashboard'));
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }
}
