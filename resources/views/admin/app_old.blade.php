<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #D1AE6C;
            --dark: #363435;
            --pink: #F18F91;
            --white: #FFFFFF;
            --light: #F8F7F4;
            --cream: #FFFCF8;
        }
        
        .bg-gold { background-color: var(--gold); }
        .text-gold { color: var(--gold); }
        .bg-dark { background-color: var(--dark); }
        .text-dark { color: var(--dark); }
        .bg-pink { background-color: var(--pink); }
        .text-pink { color: var(--pink); }
        .bg-cream { background-color: var(--cream); }
        .bg-light { background-color: var(--light); }
        
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar-mini {
            width: 70px;
        }
        .sidebar-full {
            width: 260px;
        }
        .main-content {
            transition: all 0.3s;
            margin-left: 260px;
        }
        .main-content-full {
            margin-left: 70px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar sidebar-full bg-dark text-white fixed h-full overflow-y-auto">
            <div class="p-6">
<a href="#!" class="text-2xl font-bold dark-text">
<img  class="logo-img"
    src="{{ asset('logo.png') }}" 
    style="height:150px; width:120px; object-fit:contain;" 
    alt="Logo"
/>
                </a>                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-tachometer-alt w-6 mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments.index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.appointments.*') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-calendar-check w-6 mr-3"></i>
                                <span>Appointment List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.services.index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.services.*') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-concierge-bell w-6 mr-3"></i>
                                <span>Manage Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.payments.index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.payments.*') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-credit-card w-6 mr-3"></i>
                                <span>Payment History</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-users w-6 mr-3"></i>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.testimonials.index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-700' : '' }}">
                                <i class="fas fa-star w-6 mr-3"></i>
                                <span>Manage Testimonials</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-dark">@yield('title')</h1>
                <button id="sidebarToggle" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Toggle sidebar
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('sidebar-mini sidebar-full');
                $('.main-content').toggleClass('main-content-full main-content');
            });
            
            // CSRF token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</body>
</html>