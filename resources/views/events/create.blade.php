@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Create New Event</h5>
            </div>
            <div class="card-body">

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p class="mb-0">⚠️ {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="event_date" class="form-control" value="{{ old('event_date') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Seats <span class="text-danger">*</span></label>
                        <input type="number" name="total_seats" class="form-control" value="{{ old('total_seats') }}" min="1" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark">Create Event</button>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
