<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{
    public function index(){
        $testimonials = Testimonial::where('status', 'active')->get();
        return view('frontend.home', compact('testimonials'));
    }
    public function about(){
        return view('frontend.about');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function gallery(){
        $galleries = Gallery::all();
        return view('frontend.gallery', compact('galleries'));
    }
    public function dashboard(){
        return view('frontend.dashboard');
    }


public function check_login()
{
    $user = Auth::user();

    if (!$user) {
        // Not logged in, redirect to login
        return redirect()->route('login');
    }

    if ($user->user_type === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('dashboard');
    }
}
}

