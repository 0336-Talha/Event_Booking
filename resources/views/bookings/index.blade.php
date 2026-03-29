@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>My Bookings</h3>
    <a href="{{ route('events.index') }}" class="btn btn-dark btn-sm">
        Browse Events
    </a>
</div>

{{-- Bookings Table --}}
<div class="card shadow-sm">
    <div class="card-body">
        @if($bookings->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Location</th>
                        <th>Event Date</th>
                        <th>Seats Booked</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('events.show', $booking->event->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $booking->event->title }}
                            </a>
                        </td>
                        <td>📍 {{ $booking->event->location }}</td>
                        <td>
                            📅 {{ \Carbon\Carbon::parse($booking->event->event_date)->format('d M Y, h:i A') }}
                        </td>
                        <td>💺 {{ $booking->seats_booked }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                        </td>
                        <td>
                            @if($booking->status == 'booked')
                            <span class="badge bg-success">Booked</span>
                            @else
                            <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'booked')
                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Cancel this booking?')">
                                    Cancel
                                </button>
                            </form>
                            @else
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-primary btn-sm" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->links() }}
        </div>

        @else
        <div class="text-center py-5">
            <h5 class="text-muted">😔 No bookings yet!</h5>
            <a href="{{ route('events.index') }}" class="btn btn-dark mt-2">
                Browse Events
            </a>
        </div>
        @endif
    </div>
</div>

@endsection
