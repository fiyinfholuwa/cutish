<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
            'completed' => Appointment::where('status', 'completed')->count(),
        ];
        
        $recentBookings = Appointment::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function admin_profile(){
        return view('admin.profile');
    }
    public function admin_gallery(){
        $galleryImages = Gallery::all();


        return view('admin.gallery', compact('galleryImages'));
    }

}
