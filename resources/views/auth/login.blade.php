@extends('layouts.app')

@section('content')
    <div class="login-shell">
        <div class="login-card">
            <div class="page-head">
                <div>
                    <h1>Login</h1>
                    <p>Masuk sebagai Master Guide atau User.</p>
                </div>
            </div>

            <form action="{{ route('login.store') }}" method="POST" class="grid">
                @csrf

                <label>
                    Nama User
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>

                <label>
                    Password
                    <input type="password" name="password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>

                <label>
                    <span>Ingat saya</span>
                    <input type="checkbox" name="remember" value="1">
                </label>

                <button type="submit" class="button">Masuk</button>
            </form>

            <p class="muted" style="margin-top: 20px;">Seeder default: `masterguide / password123`</p>
        </div>
    </div>
@endsection
