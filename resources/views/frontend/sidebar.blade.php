<div class="lg:col-span-1">
    <!-- Desktop Sidebar -->
    <div class="dashboard-card dashboard-sidebar hidden lg:block">
        <div class="flex items-center mb-8 pb-6 border-b border-gray-100">
            <div class="w-14 h-14 rounded-full gold-bg flex items-center justify-center mr-4">
                <i class="fas fa-user text-white text-xl"></i>
            </div>
            <div>
                <h4 id="user-name" class="font-bold text-lg">{{ Auth::user()->first_name }}</h4>
                <p class="text-sm text-gray-600">logged in</p>
            </div>
        </div>
        
        <div class="space-y-1">
            <a href="{{ route('dashboard') }}" class="dashboard-tab {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt mr-3"></i> My Appointments
            </a>
            <a href="{{ route('payment') }}" class="dashboard-tab {{ request()->routeIs('payment') ? 'active' : '' }}">
                <i class="fas fa-receipt mr-3"></i> Payment History
            </a>
            <a href="{{ route('user.profile') }}" class="dashboard-tab {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="fas fa-user-cog mr-3"></i> Profile Settings
            </a>
            <a href="{{ route('logout') }}" id="logout-btn" class="dashboard-tab text-red-600 hover:text-red-700">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="lg:hidden mb-6">
        <!-- User Info (Mobile) -->
        <div class="dashboard-card mb-4 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-full gold-bg flex items-center justify-center mr-3">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <h4 class="font-bold">{{ Auth::user()->first_name }}</h4>
                    <p class="text-xs text-gray-600">logged in</p>
                </div>
            </div>
        </div>

        <!-- Horizontal Scroll Menu -->
        <div class="overflow-x-auto hide-scrollbar">
            <div class="flex space-x-2 pb-2">
                <a href="{{ route('dashboard') }}" 
                   class="mobile-nav-tab {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt text-lg mb-1"></i>
                    <span class="text-xs whitespace-nowrap">Appointments</span>
                </a>
                <a href="{{ route('payment') }}" 
                   class="mobile-nav-tab {{ request()->routeIs('payment') ? 'active' : '' }}">
                    <i class="fas fa-receipt text-lg mb-1"></i>
                    <span class="text-xs whitespace-nowrap">Payments</span>
                </a>
                <a href="{{ route('user.profile') }}" 
                   class="mobile-nav-tab {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <i class="fas fa-user-cog text-lg mb-1"></i>
                    <span class="text-xs whitespace-nowrap">Profile</span>
                </a>
                <a href="{{ route('logout') }}" 
                   id="logout-btn-mobile" 
                   class="mobile-nav-tab mobile-nav-logout">
                    <i class="fas fa-sign-out-alt text-lg mb-1"></i>
                    <span class="text-xs whitespace-nowrap">Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Hide scrollbar for mobile navigation */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Mobile navigation tabs */
.mobile-nav-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.25rem;
    background: white;
    border-radius: 0.75rem;
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
    min-width: 100px;
    text-decoration: none;
    color: #6b7280;
}

.mobile-nav-tab:hover {
    border-color: #d1d5db;
    background: #f9fafb;
}

.mobile-nav-tab.active {
    background: linear-gradient(135deg, #C5A572 0%, #9B7E57 100%);
    border-color: #C5A572;
    color: white;
    box-shadow: 0 4px 6px -1px rgba(197, 165, 114, 0.3);
}

.mobile-nav-tab.mobile-nav-logout {
    color: #dc2626;
    border-color: #fee2e2;
}

.mobile-nav-tab.mobile-nav-logout:hover {
    background: #fef2f2;
    border-color: #fecaca;
}

.mobile-nav-tab i {
    display: block;
}

/* Gold background class (if not already defined) */
.gold-bg {
    background: linear-gradient(135deg, #C5A572 0%, #9B7E57 100%);
}

/* Dashboard card (if not already defined) */
.dashboard-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.dashboard-sidebar {
    padding: 2rem;
}

/* Desktop tabs */
.dashboard-tab {
    display: flex;
    align-items: center;
    padding: 0.875rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
    color: #4b5563;
}

.dashboard-tab:hover {
    background: #f9fafb;
}

.dashboard-tab.active {
    background: linear-gradient(135deg, #C5A572 0%, #9B7E57 100%);
    color: white;
    font-weight: 600;
}
</style>