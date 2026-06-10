@extends('layouts.app')

@section('content')
    <div class="login-shell">
        <div class="login-split">
            <section class="login-showcase">
                <div class="login-showcase-top">
                    <span class="login-showcase-badge"></span>
                    Pathfinder Salemba Young Lions
                </div>

                <div class="login-showcase-copy">
                    <h2>Senang melihat Anda kembali</h2>
                    <h1>WELCOME<br>BACK</h1>
                    <div class="login-showcase-divider"></div>
                </div>
            </section>

            <section class="login-form-pane">
                <div class="login-form-inner">
                    <div class="login-form-head" style="text-align: center;">
                        <h1>Login</h1>
                    </div>

                    <form action="{{ route('login.store') }}" method="POST" class="grid">
                    @csrf

                        <label>
                            Nama User
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama user">
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label>
                            Password
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <input type="password" name="password" id="password" required placeholder="Masukkan password">
                                <button
                                    type="button"
                                    id="toggle-password"
                                    aria-label="Tampilkan password"
                                    aria-pressed="false"
                                    class="button secondary"
                                    style="padding: 12px 14px; min-width: 54px;"
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

                        <div class="login-form-meta">
                            <label style="display: flex; align-items: center; gap: 10px; font-weight: 600; color: var(--muted);">
                                <input type="checkbox" name="remember" value="1" style="width: 18px; height: 18px;">
                                <span>Ingat saya</span>
                            </label>
                            <div class="app-badge" style="margin: 0; background: rgba(31, 59, 45, 0.06);">Secure Session</div>
                        </div>

                        <button type="submit" class="button">Masuk ke Dashboard</button>
                    </form>
                </div>
            </section>
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
