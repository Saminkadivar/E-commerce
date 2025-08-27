<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfileController extends Controller
{
    public function edit()
    {
        $vendor = Auth::user();
        return view('vendor.profile.edit', compact('vendor'));
    }

    public function update(Request $request)
    {
        $vendor = Auth::user();

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $vendor->id,
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:255',
            'bank_name'      => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc'      => 'nullable|string|max:20',
        ]);

        $vendor->update($request->only([
            'name',
            'email',
            'phone',
            'address',
            'bank_name',
            'account_number',
            'ifsc',
        ]));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
