<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Event Booking</a>

            <div class="ms-auto d-flex align-items-center gap-2">
                @auth
                <a href="{{ route('events.index') }}" class="btn btn-outline-light btn-sm">Events</a>
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-light btn-sm">My Bookings</a>

                {{-- Thoda gap aur naam alag --}}
                <div class="vr bg-light ms-2 me-2"></div>

                <div class="dropdown">
                    <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        👤 {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
                <a href="/register" class="btn btn-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
