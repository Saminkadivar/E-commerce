<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function destroy(User $vendor)
    {
        $vendor->delete();
        return back()->with('success', 'Vendor deleted successfully');
    }
}
