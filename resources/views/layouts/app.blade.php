<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DOCNESTIFY</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #2563eb;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
        }

        body {
            font-family: 'Nunito', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #374151;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-header .logo {
            width: 32px;
            height: 32px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }

        .sidebar-header .brand-text {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link-sidebar {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            gap: 0.75rem;
        }

        .nav-link-sidebar:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .nav-link-sidebar.active {
            background: var(--primary-color);
            color: white;
        }

        .nav-link-sidebar i {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-link-text {
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-link-text {
            opacity: 0;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .topbar {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .content-area {
            padding: 2rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid #374151;
        }

        /* Esconder navbar padrão quando logado */
        .navbar-default {
            display: none;
        }

        /* Mostrar navbar apenas para guests */
        .guest-navbar {
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed + .main-content {
                margin-left: 0;
            }

            .guest-navbar {
                display: block !important;
            }
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .mobile-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        @guest
            <!-- Navbar para usuários não logados -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm guest-navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">DocNestify</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto"></ul>
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        @else
            <!-- Layout com Sidebar para usuários logados -->
            <!-- Mobile Overlay -->
            <div class="mobile-overlay" id="mobileOverlay"></div>

            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <div class="logo">D</div>
                    <span class="brand-text">DocNestify</span>
                </div>

                <div class="nav-menu">
                    <div class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link-sidebar {{ Request::routeIs('home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('clientes.index') }}" class="nav-link-sidebar {{ Request::routeIs('clientes.*') ? 'active' : '' }}" class="nav-link-sidebar">
                            <i class="fas fa-users"></i>
                            <span class="nav-link-text">Clientes</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link-sidebar">
                            <i class="fas fa-folder"></i>
                            <span class="nav-link-text">Pastas</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link-sidebar">
                            <i class="fas fa-layer-group"></i>
                            <span class="nav-link-text">Categorias</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link-sidebar">
                            <i class="fas fa-tags"></i>
                            <span class="nav-link-text">Tags</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link-sidebar">
                            <i class="fas fa-book"></i>
                            <span class="nav-link-text">Acervo</span>
                        </a>
                    </div>
                </div>

                <div class="sidebar-footer">
                    <a href="#" class="nav-link-sidebar" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-link-text">Sair</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Top Bar -->
                <div class="topbar">
                    <button class="toggle-btn" id="toggleBtn">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="user-menu">
                        <span class="text-muted">Bem-vindo, {{ Auth::user()->name }}!</span>
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="content-area">
                    @yield('content')
                </div>
            </div>
        @endguest
    </div>

    <script>
        @auth
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        const mobileOverlay = document.getElementById('mobileOverlay');

        if (sidebar && toggleBtn && mobileOverlay) {
            // Toggle sidebar
            toggleBtn.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    // Mobile behavior
                    sidebar.classList.toggle('show');
                    mobileOverlay.classList.toggle('show');
                } else {
                    // Desktop behavior
                    sidebar.classList.toggle('collapsed');
                }
            });

            // Close sidebar when clicking overlay (mobile)
            mobileOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                mobileOverlay.classList.remove('show');
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    mobileOverlay.classList.remove('show');
                }
            });

            // Active nav link functionality
            document.querySelectorAll('.nav-link-sidebar').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Don't prevent default for logout link
                    if (this.getAttribute('onclick')) return;
                    
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link-sidebar').forEach(l => l.classList.remove('active'));
                    // Add active class to clicked link
                    this.classList.add('active');
                });
            });
        }
        @endauth
    </script>
</body>
</html>