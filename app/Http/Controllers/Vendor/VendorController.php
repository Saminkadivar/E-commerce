<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function showLoginForm() {
        return view('vendor.auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email','password');

        if(Auth::guard('vendor')->attempt($credentials, $request->filled('remember'))){
            return redirect()->intended(route('vendor.dashboard'));
        }

        return back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function logout() {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }

    public function dashboard() {
        $vendorId = Auth::guard('vendor')->id();
        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        $totalSales = OrderItem::where('vendor_id', $vendorId)->sum('subtotal');

        return view('vendor.dashboard', compact('totalProducts','totalSales'));
    }

    public function profile() {
        $vendor = Auth::guard('vendor')->user();
        return view('vendor.profile', compact('vendor'));
    }

    public function updateProfile(Request $request) {
        $vendor = Auth::guard('vendor')->user();
        $data = $request->only('name','email','phone','bank_name','account_number','ifsc');
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }
        $vendor->update($data);
        return back()->with('success','Profile updated successfully');
    }

    public function salesReport() {
        $vendorId = Auth::guard('vendor')->id();
        $sales = OrderItem::where('vendor_id', $vendorId)
            ->select('product_id', \DB::raw('SUM(quantity) as total_sold'), \DB::raw('SUM(total) as total_amount'))
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('vendor.sales-report', compact('sales'));
    }
}
