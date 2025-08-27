<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #fff;
        }
        .vendor-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('vendor.dashboard') }}">
                <span class="fs-4">🛍</span> Vendor Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#vendorNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="vendorNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <a href="{{ route('vendor.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                           Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vendor.orders.index') }}" 
                           class="nav-link {{ request()->routeIs('vendor.orders.*') ? 'active' : '' }}">
                           My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vendor.reports.index') }}" 
                           class="nav-link {{ request()->routeIs('vendor.reports.*') ? 'active' : '' }}">
                           Reports
                        </a>
                    </li>
                 
                    <li class="nav-item">
                        <a href="{{ route('vendor.products.index') }}" 
                           class="nav-link {{ request()->routeIs('vendor.products.*') ? 'active' : '' }}">
                           My Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vendor.profile.edit') }}" 
                           class="nav-link {{ request()->routeIs('vendor.profile.*') ? 'active' : '' }}">
                           Profile
                        </a>
                    </li>

                    {{--  User Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="vendorDropdown" 
                           role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                                 alt="avatar" class="vendor-avatar me-2">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="{{ route('vendor.profile.edit') }}">✏️ Update Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('vendor.dashboard') }}">📊 Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('vendor.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Vendor Panel. All Rights Reserved.</p>
            <small>Powered by E-Commerce</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
