<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Mail\BookingConfirmed;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('event')->latest()->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request)
    {

        $event = Event::findOrFail($request->event_id);


        if (auth()->id() == $event->created_by) {
            return back()->with('error', 'You cannot book your own event!');
        }
        if ($request->seats_booked > $event->available_seats) {
            return back()->with('error', 'Not enough seats available!');
        }
        DB::transaction(function () use ($request, $event) {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $request->event_id,
                'seats_booked' => $request->seats_booked,
                'booking_date' => Carbon::now('Asia/Karachi'),
                'status' => 'booked',
            ]);
            $event->decrement('available_seats', $request->seats_booked);
            Mail::to(auth()->user()->email)
                ->send(new BookingConfirmed($booking->load('event', 'user')));
        });

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }



        if ($booking->status === 'cancelled') {
            return redirect()->route('bookings.index')
                ->with('error', 'Booking is already cancelled.');
        }

        $booking->event->increment('available_seats', $booking->seats_booked);

        $booking->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->status === 'cancelled') {
            $booking->delete();
            return redirect()->route('bookings.index')
                ->with('success', 'Booking is deleted successfully.');
        }
        return redirect()->route('bookings.index')
            ->with('error', 'Cancel the booking before deletion');
    }
}
