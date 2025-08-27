<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-warning" href="{{ url('/index') }}">
            <i class="bi bi-bag-check-fill"></i> E-Commerce
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.products.index') ? 'active' : '' }}" 
                       href="{{ route('shop.products.index') }}">
                        <i class="bi bi-grid-fill"></i> All Products
                    </a>
                </li>

                @auth
                    @if(Auth::user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.cart.index') ? 'active' : '' }}" 
                               href="{{ route('user.cart.index') }}">
                               <i class="bi bi-cart-check"></i> My Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.orders.index') ? 'active' : '' }}" 
                               href="{{ route('user.orders.index') }}">
                               <i class="bi bi-bag"></i> My Orders
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Search Bar -->
            <form action="{{ route('shop.products.index') }}" method="GET" class="d-flex me-3">

                <!-- Search Input -->
                <input type="text" name="search" class="form-control me-2"
                       placeholder="Search products..."
                       value="{{ request('search') }}">

                <button class="btn btn-outline-warning">Search</button>
            </form>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Dark/Light Mode Toggle -->
                <li class="nav-item me-2">
                    <button class="btn btn-sm btn-outline-light" id="themeToggle">🌙</button>
                </li>

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" 
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile.edit') }}">
                                    <i class="bi bi-gear"></i> Update Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<script>
    document.getElementById('themeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        this.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
    });
</script>
<style>
   
main {
    min-height: 80vh;
    background-color: #f8f9fa;
    color: #121212;
    transition: background-color 0.3s, color 0.3s;
}

body.dark-mode main {
    background-color: #121212;
    color: #e0e0e0;
}
body.dark-mode  {
    background-color: #121212;
    color: #e0e0e0;
}
body.dark-mode .navbar {
    background-color: #1f1f1f !important;
}

body.dark-mode .card {
    background-color: #1e1e1e;
    color: #e0e0e0;
    transition: background-color 0.3s, color 0.3s;
}

body.dark-mode .btn-outline-warning {
    color: #ffc107;
    border-color: #ffc107;
    transition: background-color 0.3s, color 0.3s;
}

body.dark-mode .btn-outline-warning:hover {
    background-color: #ffc107;
    color: #121212;
}

body.dark-mode a {
    color: #ffc107;
}

body.dark-mode .dropdown-menu {
    background-color: #2a2a2a;
    color: #fff;
}

body.dark-mode .card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transform: translateY(-3px);
}

</style>    