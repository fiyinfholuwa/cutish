

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutish Hair | Premium Mobile Hairstyling in Toronto & GTA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #D1AE6C;
            --dark: #363435;
            --pink: #F18F91;
            --white: #FFFFFF;
            --light: #F8F7F4;
            --cream: #FFFCF8;
        }
        
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            scroll-behavior: smooth;
            background-color: var(--white);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .gold-bg { background-color: var(--gold); }
        .gold-text { color: var(--gold); }
        .dark-bg { background-color: var(--dark); }
        .dark-text { color: var(--dark); }
        .pink-bg { background-color: var(--pink); }
        .pink-text { color: var(--pink); }
        .light-bg { background-color: var(--light); }
        .cream-bg { background-color: var(--cream); }
        
        .section-padding {
            padding: 5rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .section-padding {
                padding: 3rem 1rem;
            }
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, #E0C080 100%);
            color: var(--dark);
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            border: none;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(209, 174, 108, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(209, 174, 108, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: pink;
            color: var(--dark);
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            border: 2px solid var(--gold);
        }
        
        .btn-secondary:hover {
            background-color: var(--gold);
            transform: translateY(-3px);
        }
        
        .btn-pink {
            background: linear-gradient(135deg, var(--pink) 0%, #F5A7A9 100%);
            color: white;
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            border: none;
            box-shadow: 0 10px 25px rgba(241, 143, 145, 0.3);
        }
        
        .btn-pink:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(241, 143, 145, 0.4);
        }
        
        .service-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            position: relative;
            border: 1px solid rgba(209, 174, 108, 0.1);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border-color: rgba(209, 174, 108, 0.3);
        }
        
        .active-nav {
            color: var(--gold);
            font-weight: 600;
            position: relative;
        }
        
        .active-nav::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--gold);
            border-radius: 3px;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from { width: 0; }
            to { width: 100%; }
        }
        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: linear-gradient(135deg, rgba(54, 52, 53, 0.95) 0%, rgba(54, 52, 53, 0.98) 100%), 
                        url('https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
        }
        
        @media (max-width: 768px) {
            .hero-section {
                background-attachment: scroll;
            }
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 3rem;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        @keyframes slideUp {
            from { transform: translateY(50px) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        
        .close-modal {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
        }
        
        .close-modal:hover {
            background: rgba(0, 0, 0, 0.1);
        }
        
        .form-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 1rem;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(209, 174, 108, 0.1);
        }
        
        .hidden-section {
            display: none;
        }
        
        .active-section {
            display: block;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .booking-status {
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-confirmed {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgb(21, 128, 61);
        }
        
        .status-pending {
            background-color: rgba(251, 191, 36, 0.1);
            color: rgb(180, 83, 9);
        }
        
        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgb(185, 28, 28);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            background: linear-gradient(135deg, var(--gold) 0%, #E0C080 100%);
            color: white;
            box-shadow: 0 10px 20px rgba(209, 174, 108, 0.2);
        }
        
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            position: relative;
            border: 1px solid rgba(209, 174, 108, 0.1);
            height: 100%;
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .stat-box {
            text-align: center;
            padding: 2.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(209, 174, 108, 0.1);
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            margin-bottom: 0.5rem;
            font-family: 'Montserrat', sans-serif;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--pink));
            border-radius: 2px;
        }
        
        .center-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .process-step {
            position: relative;
            padding: 2rem 0 2rem 5rem;
            margin-bottom: 1rem;
        }
        
        .process-step::before {
            content: '';
            position: absolute;
            left: 0;
            top: 2rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, #E0C080 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            box-shadow: 0 5px 15px rgba(209, 174, 108, 0.3);
        }
        
        .step-1::before { content: '01'; }
        .step-2::before { content: '02'; }
        .step-3::before { content: '03'; }
        .step-4::before { content: '04'; }
        
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
        
        .slide-up {
            opacity: 0;
            animation: slideUp 0.8s ease forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        
        .hero-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            display: inline-flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .hero-image-container {
            position: relative;
        }
        
        .hero-image {
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .hero-image:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
        }
        
        .floating-badge {
            position: absolute;
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            animation: float 4s ease-in-out infinite;
        }
        
        .floating-badge-1 {
            top: -20px;
            right: -20px;
            animation-delay: 0.2s;
        }
        
        .floating-badge-2 {
            bottom: 40px;
            left: -30px;
            animation-delay: 0.5s;
        }
        
        .service-highlight {
            position: relative;
            overflow: hidden;
        }
        
        .service-highlight::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--gold), var(--pink));
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--gold) 0%, var(--pink) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        @media (max-width: 640px) {
            .stat-number {
                font-size: 2.5rem;
            }
            
            .testimonial-card {
                padding: 2rem 1.5rem;
            }
            
            .process-step {
                padding: 1.5rem 0 1.5rem 3.5rem;
            }
            
            .process-step::before {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
            
            .hero-badge {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }

        nav {
    height: 100px;          /* your desired nav height */
    display: flex;
    align-items: center;
}



.logo-img {
    max-height: 100%;
    width: auto;
    object-fit: contain;
}


.dashboard-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(209, 174, 108, 0.1);
            height: 100%;
        }
        
        .dashboard-sidebar {
            position: sticky;
            top: 100px;
        }
        
        .dashboard-tab {
            display: block;
            width: 100%;
            text-align: left;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dashboard-tab:hover {
            background: rgba(209, 174, 108, 0.1);
        }
        
        .dashboard-tab.active {
            background: linear-gradient(135deg, rgba(209, 174, 108, 0.1) 0%, rgba(241, 143, 145, 0.1) 100%);
            color: var(--gold);
            font-weight: 600;
            border-left: 4px solid var(--gold);
        }
        
        .booking-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(209, 174, 108, 0.1);
        }
        
        .payment-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--gold);
        }
        
        @media (max-width: 640px) {
            .stat-number {
                font-size: 2.5rem;
            }
            
            .testimonial-card {
                padding: 2rem 1.5rem;
            }
            
            .process-step {
                padding: 1.5rem 0 1.5rem 3.5rem;
            }
            
            .process-step::before {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }
            
            .hero-badge {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            
            .dashboard-card {
                padding: 1.5rem;
            }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .radio-group {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .radio-option input {
            margin-right: 0.5rem;
        }
        
        .text-area {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            min-height: 120px;
            resize: vertical;
        }
        
        .text-area:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(209, 174, 108, 0.1);
        }
        
        .select-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            background: white;
            cursor: pointer;
        }
        
        .select-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(209, 174, 108, 0.1);
        }
        
        .checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .checkbox input {
            margin-right: 0.5rem;
        }
        
        .checkbox label {
            cursor: pointer;
        }
.gold-text {
    color: #FFD700; /* This is a nice gold color */
}

    </style>
</head>

<body class="bg-white">
    <!-- Navigation -->
    <nav class="nav-glass fixed top-0 left-0 right-0 z-50 py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold dark-text">
<img  class="logo-img"
    src="{{ asset('logo.png') }}" 
    style="height:150px; width:120px; object-fit:contain;" 
    alt="Logo"
/>
                </a>
            </div>
            
            <div class="hidden lg:flex space-x-8">
    <a href="{{ route('home') }}" 
       class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('home') ? 'gold-text' : '' }}">Home</a>

    <a href="{{ route('about') }}" 
       class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('about') ? 'gold-text' : '' }}">About</a>

    <a href="{{ route('contact') }}" 
       class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('contact') ? 'gold-text' : '' }}">Contact Us</a>

    <a href="{{ route('gallery') }}" 
       class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('gallery') ? 'gold-text' : '' }}">Gallery</a>

    @auth
        <a href="{{ route('dashboard') }}" 
           class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('dashboard') ? 'gold-text' : '' }}">Dashboard</a>
        <a href="{{ route('logout') }}" class="nav-link dark-text font-medium hover:gold-text">Logout</a>
    @else
        <a href="{{ route('register') }}" 
           class="nav-link dark-text font-medium hover:gold-text {{ request()->routeIs('register') ? 'gold-text' : '' }}">Register</a>
        <a href="{{ route('login') }}" 
           class="btn-primary py-2 px-4 {{ request()->routeIs('login') ? 'gold-text' : '' }}">Login</a>
    @endauth
</div>

            <div class="lg:hidden">
                <button id="mobile-menu-btn" class="text-2xl dark-text p-2">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div   id="mobile-menu" class="mobile-menu fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50 p-8 lg:hidden">
            <div class="flex justify-between items-center mb-10">
                <button id="close-mobile-menu" class="text-2xl dark-text p-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div style="background: white !important; padding:50px;" class="flex flex-col space-y-6">
    <a href="{{ route('home') }}" 
       class="nav-link dark-text font-medium hover:gold-text py-3 text-lg border-b border-gray-100 {{ request()->routeIs('home') ? 'gold-text' : '' }}">
       Home
    </a>

    <a href="{{ route('about') }}" 
       class="nav-link dark-text font-medium hover:gold-text py-3 text-lg border-b border-gray-100 {{ request()->routeIs('about') ? 'gold-text' : '' }}">
       About
    </a>

    <a href="{{ route('gallery') }}" 
       class="nav-link dark-text font-medium hover:gold-text py-3 text-lg border-b border-gray-100 {{ request()->routeIs('gallery') ? 'gold-text' : '' }}">
       Gallery
    </a>

    <a href="{{ route('register') }}" 
       class="nav-link dark-text font-medium hover:gold-text py-3 text-lg border-b border-gray-100 {{ request()->routeIs('register') ? 'gold-text' : '' }}">
       Register
    </a>

    <a href="{{ route('login') }}" 
       class="btn-primary w-full text-center mt-4 {{ request()->routeIs('login') ? 'gold-text' : '' }}">
       Login
    </a>
</div>

            <div class="absolute bottom-8 left-8 right-8">
                
            </div>
        </div>
    </nav>

@yield('content')

<!-- Footer -->
    <footer class="dark-bg text-white py-16">

    @if (!request()->routeIs('dashboard') && !request()->routeIs('user.profile') && !request()->routeIs('payment'))

        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div>

<img  class=""
    src="{{ asset('logo2.png') }}" 
    style="height:80px; width:100px; border-radius:20px !important;" 
    alt="Logo"
/>                    <p class="text-gray-300 mb-8">
                        Premium mobile hairstyling services in Toronto and the GTA. Bringing salon-quality transformations to your doorstep.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://instagram.com/cutish.ca" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-gold-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="mailto:cutishhair@gmail.com" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-gold-600 transition-colors">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="tel:+14377331946" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-gold-600 transition-colors">
                            <i class="fas fa-phone"></i>
                        </a>
                    </div>
                </div>
                
               
                
                <div>
                    <h3 class="text-xl font-bold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
    <li>
        <a href="{{ route('home') }}" 
           class="text-gray-300 hover:gold-text transition-colors {{ request()->routeIs('home') ? 'gold-text' : '' }}">
           Home
        </a>
    </li>
    <li>
        <a href="{{ route('about') }}" 
           class="text-gray-300 hover:gold-text transition-colors {{ request()->routeIs('about') ? 'gold-text' : '' }}">
           About Us
        </a>
    </li>
    <li>
        <a href="{{ route('contact') }}" 
           class="text-gray-300 hover:gold-text transition-colors {{ request()->routeIs('contact') ? 'gold-text' : '' }}">
           Contact
        </a>
    </li>
    <li>
        <a href="{{ route('gallery') }}" 
           class="text-gray-300 hover:gold-text transition-colors {{ request()->routeIs('gallery') ? 'gold-text' : '' }}">
           Gallery
        </a>
    </li>
    <li>
        <a href="{{ route('login') }}" 
           class="text-gray-300 hover:gold-text transition-colors {{ request()->routeIs('login') ? 'gold-text' : '' }}">
           Login
        </a>
    </li>
</ul>

                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-6">Contact Info</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt gold-text mr-3 mt-1"></i>
                            <span class="text-gray-300">Toronto & GTA, Ontario</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone gold-text mr-3 mt-1"></i>
                            <span class="text-gray-300">+1 (437) 733-1946</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope gold-text mr-3 mt-1"></i>
                            <span class="text-gray-300">cutishhair@gmail.com</span>
                        </li>
                    </ul>
                    <div class="mt-8 p-4 bg-gray-800 rounded-lg">
                        <p class="text-sm text-gray-300">Emergency or after-hours appointments available upon request.</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-gray-400">© 2024 Cutish Hair. All rights reserved.</p>
                <p class="text-gray-500 text-sm mt-2">Professional Mobile Hairstyling Services • Toronto & GTA</p>
            </div>
        </div>
    </footer>

    <!-- Booking Modal -->
    <div id="booking-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="hideModal('booking')">&times;</span>
            <h3 class="text-2xl font-bold mb-6">Book Appointment</h3>
            <p class="text-gray-600 mb-6">Fill out the form below to schedule your hairstyling service.</p>
            
            <form id="modal-booking-form">
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Select Service</label>
                    <select class="form-input" required>
                        <option value="">Choose a service</option>
                        <option value="wig">Wig Installation ($120+)</option>
                        <option value="silk">Silk Press ($90+)</option>
                        <option value="bridal">Bridal Styling ($200+)</option>
                        <option value="weave">Sew-In Weaves ($150+)</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-2 font-medium">Preferred Date</label>
                        <input type="date" class="form-input" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-medium">Preferred Time</label>
                        <select class="form-input" required>
                            <option value="">Select time</option>
                            <option value="9:00">9:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:30">1:30 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:30">4:30 PM</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Location Type</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="location" value="home" class="mr-2" checked>
                            <span>My Home</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="location" value="venue" class="mr-2">
                            <span>Event Venue</span>
                        </label>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Your Phone Number</label>
                    <input type="tel" class="form-input" required>
                </div>
                
                <button type="submit" class="btn-primary w-full">
                    <span>Confirm Booking</span>
                    <i class="fas fa-check ml-3"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Application Data
     

       
       
          


        // Initialize mobile menu
        function initMobileMenu() {
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileMenuBtn = document.getElementById('mobile-menu-btn');
                
                if (mobileMenu && mobileMenuBtn && 
                    !mobileMenu.contains(e.target) && 
                    !mobileMenuBtn.contains(e.target) && 
                    mobileMenu.classList.contains('active')) {
                    closeMobileMenu();
                }
            });
        }

        // Open mobile menu
        function openMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) {
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        // Close mobile menu
        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

       

        // Initialize animations
        function initAnimations() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, observerOptions);
            
            // Observe elements that should animate
            document.querySelectorAll('.fade-in, .slide-up').forEach(el => {
                observer.observe(el);
            });
        }

       

        // Animate elements on scroll
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-section');
            
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.05}px)`;
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    initAnimations();

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-mobile-menu');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            openMobileMenu();
        });
    }

    if (closeMenuBtn) {
        closeMenuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeMobileMenu();
        });
    }
});

    </script>


    <!-- Modal CSS -->
<style>
    .action_modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .action_modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .action_modal {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 32px;
        max-width: 400px;
        width: 90%;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.3);
        transform: scale(0.9) translateY(20px);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        text-align: center;
        position: relative;
    }

    .action_modal-overlay.active .action_modal {
        transform: scale(1) translateY(0);
    }

    .action_modal-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .action_modal-icon.success {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .action_modal-icon.error {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .action_modal-icon.info {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .action_modal-icon.warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .action_modal-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1f2937;
    }

    .action_modal-message {
        font-size: 16px;
        color: #6b7280;
        margin-bottom: 24px;
        line-height: 1.5;
    }

    .action_modal-btn {
        padding: 12px 28px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }

    .action_modal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }
</style>

<!-- Modal HTML -->
<div class="action_modal-overlay" id="clipboardModal" onclick="closeClipboardModal(event)">
    <div class="action_modal" onclick="event.stopPropagation()">
        <div class="action_modal-icon" id="modalIcon">
            <span id="modalIconText"><i class="fa fa-info-circle text-white"></i></span>
        </div>
        <h3 class="action_modal-title" id="modalTitle">Notice</h3>
        <p class="action_modal-message" id="modalMessage">This is a message.</p>
        <button class="action_modal-btn" onclick="closeClipboardModal()">Ok</button>
    </div>
</div>

<!-- Modal JS -->
<script>
    function showSessionModal(type, message) {
        const overlay = document.getElementById('clipboardModal');
        const icon = document.getElementById('modalIcon');
        const iconText = document.getElementById('modalIconText');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMessage');

        // Reset classes to allow proper icon color
        icon.className = 'action_modal-icon';

        if (type === 'success') {
            icon.classList.add('success');
            iconText.innerHTML = '<i class="fa fa-check-circle text-white"></i>';
            title.textContent = 'Success!';
        } else if (type === 'info') {
            icon.classList.add('info');
            iconText.innerHTML = '<i class="fa fa-info-circle text-white"></i>';
            title.textContent = 'Info';
        } else if (type === 'warning') {
            icon.classList.add('warning');
            iconText.innerHTML = '<i class="fa fa-exclamation-triangle text-white"></i>';
            title.textContent = 'Warning';
        } else if (type === 'error') {
            icon.classList.add('error');
            iconText.innerHTML = '<i class="fa fa-times-circle text-white"></i>';
            title.textContent = 'Error';
        } else {
            icon.classList.add('info');
            iconText.innerHTML = '<i class="fa fa-info-circle text-white"></i>';
            title.textContent = 'Notice';
        }

        msg.textContent = message;
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeClipboardModal(event) {
        if (event && event.target !== event.currentTarget) return;

        const overlay = document.getElementById('clipboardModal');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close modal on Escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeClipboardModal();
        }
    });

    @if(Session::has('message'))
    // Get Laravel flash message type and message
    const type = "{{ Session::get('alert-type', 'info') }}";
    const message = "{{ Session::get('message') }}";

    // Show modal on page load
    showSessionModal(type, message);

    // Clear session keys so it won't show again
    {{ Session::forget('message') }}
    {{ Session::forget('alert-type') }}
    @endif
</script>

</body>
</html>