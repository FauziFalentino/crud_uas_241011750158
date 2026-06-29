<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Merchandise Event') - CRUD UAS</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- Custom Premium Styles -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #0f172a;
            --accent: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.4);
        }

        body {
            font-family: var(--font-body);
            background-color: var(--light-bg);
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: var(--font-heading);
            font-weight: 600;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--secondary) 0%, #1e293b 100%);
            box-shadow: var(--shadow-md);
            padding: 0.85rem 1.5rem;
        }

        .navbar-custom .navbar-brand {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand span {
            color: var(--primary-light);
        }

        .navbar-custom .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.25s ease;
        }

        .navbar-custom .nav-link:hover, 
        .navbar-custom .nav-link.active {
            color: #ffffff;
        }

        /* Custom Buttons */
        .btn-custom-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2), 0 2px 4px -2px rgba(99, 102, 241, 0.2);
        }

        .btn-custom-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3), 0 4px 6px -4px rgba(99, 102, 241, 0.3);
        }

        .btn-custom-outline {
            border: 1.5px solid var(--border-color);
            color: #475569;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            background: transparent;
            transition: all 0.2s ease-in-out;
        }

        .btn-custom-outline:hover {
            background-color: var(--light-bg);
            border-color: #94a3b8;
            color: var(--secondary);
            transform: translateY(-1px);
        }

        /* Card Customization */
        .card-custom {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-light);
        }

        /* Footer */
        footer {
            background-color: var(--secondary);
            color: #64748b;
            padding: 1.5rem 0;
            margin-top: auto;
            border-top: 1px solid #1e293b;
        }

        /* Glassmorphism utility */
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
        }

        /* Flash Message Animation */
        .alert-anim {
            animation: slideInDown 0.4s ease-out forwards;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('catalog') }}">
                <i class="fa-solid fa-store me-2 text-primary-light"></i>UAS<span>Merch.</span>
            </a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Katalog Publik</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    </li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-custom-primary">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login Admin
                        </a>
                    @else
                        <span class="text-light-subtle d-none d-sm-inline">
                            <i class="fa-solid fa-circle-user me-2 text-primary-light"></i>{{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm rounded-3">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="py-4 flex-grow-1">
        <div class="container">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show alert-anim border-0 rounded-4 shadow-sm py-3 px-4 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                    <div>
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show alert-anim border-0 rounded-4 shadow-sm py-3 px-4 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-4 me-3 text-danger"></i>
                    <div>
                        <strong>Kesalahan!</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer Area -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1 text-light">&copy; {{ date('Y') }} UAS Rekayasa Web - NIM 241011750158</p>
            <small class="text-secondary">Dibuat untuk memenuhi tugas UAS pemrograman web Laravel</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    @yield('scripts')
</body>
</html>
