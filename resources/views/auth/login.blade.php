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
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="password" name="password" id="password" required>
                        <button
                            type="button"
                            id="toggle-password"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                            class="button secondary"
                            style="padding: 10px 12px;"
                        >
                            <span id="eye-open" style="display: none; line-height: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </span>
                            <span id="eye-closed" style="line-height: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-.722-3.25"/>
                                    <path d="M2 8a10.645 10.645 0 0 0 20 0"/>
                                    <path d="m20 15-1.726-2.05"/>
                                    <path d="m4 15 1.726-2.05"/>
                                    <path d="m9 18 .722-3.25"/>
                                </svg>
                            </span>
                        </button>
                    </div>
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

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('toggle-password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        togglePasswordButton?.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            togglePasswordButton.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            togglePasswordButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            eyeOpen.style.display = isHidden ? 'inline-block' : 'none';
            eyeClosed.style.display = isHidden ? 'none' : 'inline-block';
        });
    </script>
@endsection
