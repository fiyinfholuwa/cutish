{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.app')

@section('title', 'Dashboard')

@section('content')
                @include('frontend.sidebar')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-4 sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm sm:text-base">Total Appointments</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-dark">{{ $stats['total'] }}</h3>
            </div>
            <div class="bg-pink bg-opacity-20 p-3 rounded-full">
                <i class="fas fa-calendar text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow p-4 sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm sm:text-base">Pending</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</h3>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow p-4 sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm sm:text-base">Confirmed</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-blue-600">{{ $stats['confirmed'] }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-blue-600 text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow p-4 sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm sm:text-base">Completed</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-green-600">{{ $stats['completed'] }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-double text-green-600 text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-4 py-3 sm:px-6 border-b">
        <h2 class="text-lg sm:text-xl font-semibold text-dark">Recent Bookings</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] sm:min-w-full table-auto">
            <thead class="bg-light">
                <tr>
                    <th class="p-3 text-left text-sm sm:text-base">ID</th>
                    <th class="p-3 text-left text-sm sm:text-base">Service</th>
                    <th class="p-3 text-left text-sm sm:text-base">Date & Time</th>
                    <th class="p-3 text-left text-sm sm:text-base">Location</th>
                    <th class="p-3 text-left text-sm sm:text-base">Status</th>
                    <th class="p-3 text-left text-sm sm:text-base">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBookings as $booking)
                <tr class="border-b hover:bg-cream">
                    <td class="p-2 sm:p-4 text-sm sm:text-base">#{{ $booking->id }}</td>
                    <td class="p-2 sm:p-4 text-sm sm:text-base">{{ $booking->service->name ?? 'N/A' }}</td>
                    <td class="p-2 sm:p-4 text-sm sm:text-base">
                        {{ $booking->appointment_date }}<br>
                        <span class="text-gray-500 text-xs sm:text-sm">{{ $booking->appointment_time }}</span>
                    </td>
                    <td class="p-2 sm:p-4 text-sm sm:text-base">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm 
                            {{ $booking->location_type == 'home' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ ucfirst($booking->location_type) }}
                        </span>
                    </td>
                    <td class="p-2 sm:p-4 text-sm sm:text-base">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm
                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                            @elseif($booking->status == 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="p-2 sm:p-4 text-sm sm:text-base font-semibold text-gold">${{ $booking->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
