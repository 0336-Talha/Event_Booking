@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>All Events</h3>
    <a href="{{ route('events.create') }}" class="btn btn-dark">+ Create Event</a>
</div>

{{-- Search Form --}}
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form action="{{ route('events.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Search by name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="location" class="form-control" placeholder="📍 Search by location..." value="{{ request('location') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-dark btn-sm">Search</button>
                    <a href="{{ route('events.index', ['my_events' => 1]) }}" class="btn {{ request('my_events') ? 'btn-dark' : 'btn-outline-dark' }} btn-sm">
                        📋 My Events
                    </a>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>

                </div>

            </div>
        </form>
    </div>
</div>

{{-- Events Grid --}}
<div class="row">
    @forelse($events as $event)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="text-muted mb-1">📍 {{ $event->location }}</p>
                <p class="text-muted mb-1">
                    📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}
                </p>
                <p class="mb-1">
                    💺 Available:
                    <span class="badge {{ $event->available_seats > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $event->available_seats }} seats
                    </span>
                </p>
            </div>
            <div class="card-footer bg-white d-flex gap-2">
                <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-dark btn-sm w-100">View</a>

                @can('update', $event)
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                @endcan

                @can('delete', $event)
                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            😔 No events found!
            <a href="{{ route('events.index') }}" class="ms-2">Clear filters</a>
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-3">
    {{ $events->links() }}
</div>

@endsection
