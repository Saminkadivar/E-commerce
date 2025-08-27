<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-warning" href="{{ url('/index') }}">
            <i class="bi bi-bag-check-fill"></i> E-Commerce
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Menu -->
            <ul class="navbar-nav me-auto">
                <!-- Show Always -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.products.index') ? 'active' : '' }}" 
                       href="{{ route('shop.products.index') }}">
                        <i class="bi bi-grid-fill"></i> All Products
                    </a>
                </li>

                @auth
                    <!-- User Menu -->
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

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Dark/Light Mode Toggle -->
                <li class="nav-item me-2">
                    <button class="btn btn-sm btn-outline-light" id="themeToggle">
                        🌙
                    </button>
                </li>

                @guest
                    <!-- If NOT logged in -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <!-- Profile Dropdown -->
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

<!-- Dark/Light Mode Script -->
<script>
    const toggleBtn = document.getElementById('themeToggle');
    toggleBtn.addEventListener('click', () => {
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-white');
        toggleBtn.textContent = document.body.classList.contains('bg-dark') ? "☀️" : "🌙";
    });
</script>
