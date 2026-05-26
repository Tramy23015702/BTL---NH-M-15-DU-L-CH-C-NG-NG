<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Household;
use App\Models\Service;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'destinations' => Destination::count(),
            'households'   => Household::count(),
            'services'     => Service::count(),
            'bookings'     => Booking::count(),
            'users'        => User::where('role', 'user')->count(),
            'pending'      => Booking::where('status', 'pending')->count(),
            'confirmed'    => Booking::where('status', 'confirmed')->count(),
            'cancelled'    => Booking::where('status', 'cancelled')->count(),
        ];

        $recentBookings = Booking::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
