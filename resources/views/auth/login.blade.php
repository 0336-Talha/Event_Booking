@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{ route("logged") }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Login</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/register">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
