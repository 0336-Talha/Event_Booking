@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">

        {{-- Event Detail Card --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $event->title }}</h5>
                <div class="d-flex gap-2">

                    @can('update', $event)
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-light btn-sm">
                        ✏️ Edit
                    </a>
                    @endcan

                    @can('delete', $event)
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                            🗑️ Delete
                        </button>
                    </form>
                    @endcan

                    <a href="{{ route('events.index') }}" class="btn btn-outline-light btn-sm">← Back</a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ $event->description ?? 'No description provided.' }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p>📍 <strong>Location:</strong> {{ $event->location }}</p>
                        <p>📅 <strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>💺 <strong>Total Seats:</strong> {{ $event->total_seats }}</p>
                        <p>✅ <strong>Available:</strong>
                            <span class="badge {{ $event->available_seats > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                {{ $event->available_seats }} seats
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if($event->available_seats > 0)

        @if(auth()->id() == $event->created_by)
        <div class="alert alert-warning text-center">
            ⚠️ You cannot book your own event!
        </div>
        @else
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Book Seats</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <div class="mb-3">
                        <label class="form-label">Number of Seats</label>
                        <input type="number" name="seats_booked" class="form-control" min="1" max="{{ $event->available_seats }}" required>
                        <small class="text-muted">
                            Max available: {{ $event->available_seats }}
                        </small>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        Confirm Booking
                    </button>
                </form>
            </div>
        </div>
        @endif

        @else
        <div class="alert alert-danger text-center">
            😔 Sorry! No seats available for this event.
        </div>
        @endif

    </div>
</div>

@endsection
