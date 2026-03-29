<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalEvents   = Event::count();
        $totalBookings = Booking::where('user_id', auth()->id())->count();

        return view('dashboard', compact('totalEvents', 'totalBookings'));
    }
}
