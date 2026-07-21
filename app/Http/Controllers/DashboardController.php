<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MarkyBooking;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin gets global metrics across the entire establishment
            $totalBookings = MarkyBooking::count();
            $totalUsers = User::count();
            
            return view('marky_views.dashboard', compact('totalBookings', 'totalUsers'));
        }

        // Standard user only sees their own direct metrics
        $totalBookings = MarkyBooking::where('marky_customer_email', $user->email)->count();
        
        return view('marky_views.dashboard_user', compact('totalBookings'));
    }
}