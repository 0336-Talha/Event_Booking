@extends('layouts.app')

@section('content')
<div class="container py-4">
    <p class="text-muted mb-4">Welcome back — here's your overview</p>

    <div class="row g-3">

        {{-- Events Card --}}
        <div class="col-md-6">
            <a href="{{ route('events.index') }}" class="text-decoration-none">
                <div class="card h-100 border shadow-sm p-3 dashboard-card">
                    <div class="icon-box bg-primary bg-opacity-10 rounded mb-3">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <p class="text-muted small mb-1">Total Events</p>
                    <h2 class="fw-semibold mb-1">{{ $totalEvents }}</h2>
                    <p class="text-primary small mb-0">View all events →</p>
                </div>
            </a>
        </div>

        {{-- Bookings Card --}}
        <div class="col-md-6">
            <a href="{{ route('bookings.index') }}" class="text-decoration-none">
                <div class="card h-100 border shadow-sm p-3 dashboard-card">
                    <div class="icon-box bg-success bg-opacity-10 rounded mb-3">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 12V22H4V12"></path>
                            <path d="M22 7H2v5h20V7z"></path>
                            <path d="M12 22V7"></path>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                        </svg>
                    </div>
                    <p class="text-muted small mb-1">Total Bookings</p>
                    <h2 class="fw-semibold mb-1">{{ $totalBookings }}</h2>
                    <p class="text-success small mb-0">View all bookings →</p>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    .icon-box {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-card {
        transition: border-color 0.2s;
    }

    .dashboard-card:hover {
        border-color: #0d6efd !important;
    }

</style>
@endsection
