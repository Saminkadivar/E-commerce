@extends('vendor.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white">
            <h4>Vendor Profile</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('vendor.profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name',$vendor->name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email',$vendor->email) }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone',$vendor->phone) }}" class="form-control">
                </div>  
                <div class="mb-3">
                    <label class="form-label">Address</label>   
                    <input type="text" name="address" value="{{ old('address',$vendor->address) }}" class="form-control">
                </div>
                <h5 class="mt-4">Bank Details</h5>
                <div class="mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name',$vendor->bank_name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" name="account_number" value="{{ old('account_number',$vendor->account_number) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">IFSC Code</label>
                    <input type="text" name="ifsc" value="{{ old('ifsc',$vendor->ifsc) }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
