<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pathfinder Salemba Young Lions' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pathfinder-logo.png') }}">
    <style>@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap');</style>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4eedf;
            --bg-soft: #efe5c8;
            --panel: rgba(255, 251, 241, 0.92);
            --panel-solid: #fffaf0;
            --ink: #1f2a22;
            --muted: #667065;
            --line: rgba(60, 79, 58, 0.16);
            --accent: #f1ce2f;
            --accent-deep: #d7b21a;
            --forest: #294536;
            --forest-soft: #3c5c4c;
            --cream: #fff7e7;
            --danger: #b42318;
            --success-bg: #e8f6ec;
            --success-text: #1f6b39;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Manrope", "Segoe UI Variable", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(241, 206, 47, 0.2), transparent 28%),
                radial-gradient(circle at top right, rgba(41, 69, 54, 0.16), transparent 24%),
                linear-gradient(180deg, #f8f1df 0%, var(--bg) 52%, #efe7d5 100%);
            color: var(--ink);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .container { width: min(1100px, calc(100% - 32px)); margin: 0 auto; }
        .topbar {
            border-bottom: 1px solid var(--line);
            background: rgba(255, 250, 240, 0.82);
            position: sticky;
            top: 0;
            backdrop-filter: blur(18px);
            z-index: 20;
        }
        .topbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 18px 0;
        }
        .brand {
            font-family: "DM Serif Display", Georgia, serif;
            font-size: clamp(1.2rem, 2vw, 1.55rem);
            line-height: 1;
            letter-spacing: 0.01em;
        }
        .brand-wrap { display: flex; align-items: center; gap: 14px; }
        .brand-text { display: grid; gap: 4px; }
        .brand-user {
            color: #fff7d6;
            font-weight: 800;
            line-height: 1.25;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.18);
        }
        .brand-logo {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: contain;
            object-position: center;
            border: 1px solid rgba(41, 69, 54, 0.14);
            background: rgba(255, 255, 255, 0.72);
            padding: 4px;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(41, 69, 54, 0.08);
        }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .nav a, .nav button {
            border: 1px solid var(--line);
            background: rgba(255, 250, 240, 0.88);
            color: var(--forest);
            padding: 10px 16px;
            border-radius: 999px;
            cursor: pointer;
            font: inherit;
            font-size: 0.94rem;
            font-weight: 700;
            transition: transform 140ms ease, background 140ms ease, border-color 140ms ease;
        }
        .nav a:hover, .nav button:hover {
            background: #fffdf7;
            border-color: rgba(41, 69, 54, 0.28);
            transform: translateY(-1px);
        }
        main { padding: 34px 0 56px; }
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 26px;
        }
        .page-head h1 {
            margin: 0;
            font-family: "DM Serif Display", Georgia, serif;
            font-size: clamp(2.2rem, 4vw, 3.3rem);
            line-height: 0.96;
            letter-spacing: -0.02em;
            color: #233326;
        }
        .page-head p {
            margin: 12px 0 0;
            color: var(--muted);
            max-width: 640px;
            font-size: 1rem;
            line-height: 1.65;
        }
        .grid { display: grid; gap: 18px; }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 16px 44px rgba(53, 66, 53, 0.08);
        }
        .stat {
            font-family: "DM Serif Display", Georgia, serif;
            font-size: clamp(2rem, 3vw, 2.6rem);
            font-weight: 400;
            margin-top: 10px;
            letter-spacing: -0.03em;
        }
        .points-low { color: #b42318; }
        .points-mid { color: #b68900; }
        .points-high { color: #1f6b39; }
        .points-positive { color: #1f6b39; }
        .points-negative { color: #b42318; }
        .muted { color: var(--muted); line-height: 1.55; }
        .flash {
            margin-bottom: 18px;
            padding: 16px 18px;
            border-radius: 18px;
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid #c9e8d1;
            box-shadow: 0 12px 28px rgba(31, 107, 57, 0.08);
        }
        .form-grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        label {
            display: grid;
            gap: 8px;
            font-weight: 700;
            color: var(--forest);
            letter-spacing: -0.01em;
        }
        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(41, 69, 54, 0.14);
            background: rgba(255, 255, 255, 0.86);
            color: var(--ink);
            font: inherit;
            transition: border-color 140ms ease, box-shadow 140ms ease, background 140ms ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(41, 69, 54, 0.34);
            box-shadow: 0 0 0 4px rgba(241, 206, 47, 0.18);
            background: #fff;
        }
        textarea { min-height: 110px; resize: vertical; }
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(180deg, #f4d840 0%, var(--accent) 100%);
            color: #213021;
            border: 1px solid rgba(196, 160, 0, 0.32);
            padding: 13px 19px;
            border-radius: 16px;
            cursor: pointer;
            font: inherit;
            font-weight: 800;
            box-shadow: 0 12px 26px rgba(215, 178, 26, 0.24);
            transition: transform 140ms ease, box-shadow 140ms ease, filter 140ms ease;
        }
        .button:hover {
            transform: translateY(-1px);
            filter: brightness(1.01);
            box-shadow: 0 14px 28px rgba(215, 178, 26, 0.28);
        }
        .button.secondary {
            background: rgba(255, 250, 240, 0.92);
            color: var(--forest);
            border-color: rgba(41, 69, 54, 0.14);
            box-shadow: none;
        }
        .button.danger {
            background: #fff3f2;
            color: var(--danger);
            border-color: #f3c6c3;
            box-shadow: none;
        }
        .actions { display: flex; flex-wrap: wrap; gap: 10px; }
        .table-wrap {
            overflow-x: auto;
            border: 1px solid rgba(41, 69, 54, 0.1);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.46);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }
        th, td {
            padding: 16px 18px;
            border-bottom: 1px solid rgba(41, 69, 54, 0.08);
            text-align: left;
            vertical-align: top;
        }
        th {
            color: var(--forest-soft);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            background: rgba(241, 206, 47, 0.12);
        }
        tbody tr:hover { background: rgba(255, 248, 230, 0.66); }
        .error { color: var(--danger); font-size: 0.92rem; margin: 4px 0 0; font-weight: 700; }
        .pagination { margin-top: 18px; display: flex; justify-content: center; }
        .empty {
            padding: 28px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed rgba(41, 69, 54, 0.18);
            border-radius: 22px;
            background: rgba(255, 251, 241, 0.76);
        }
        .login-shell {
            min-height: 100vh;
            display: grid;
            place-items: stretch;
            padding: 0;
        }
        .login-card {
            width: min(540px, 100%);
            background:
                linear-gradient(135deg, rgba(241, 206, 47, 0.12), transparent 42%),
                rgba(255, 251, 241, 0.9);
            border: 1px solid rgba(41, 69, 54, 0.12);
            border-radius: 32px;
            padding: 34px;
            box-shadow: 0 26px 60px rgba(53, 66, 53, 0.14);
        }
        .section-title {
            font-family: "DM Serif Display", Georgia, serif;
            font-size: 1.7rem;
            margin: 0 0 8px;
            line-height: 1;
        }
        .app-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(41, 69, 54, 0.08);
            color: var(--forest);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        @media (max-width: 700px) {
            .page-head, .topbar-inner { align-items: flex-start; flex-direction: column; }
            .nav { width: 100%; }
            .brand-logo { width: 48px; height: 48px; }
            .login-card { padding: 24px; border-radius: 26px; }
            th, td { padding: 14px; }
        }
    </style>
</head>
<body>
    @auth
        @if (auth()->user()->isAdmin())
            <div class="admin-shell">
                <aside class="admin-sidebar">
                    <div class="admin-sidebar-brand">
                        <img src="{{ asset('images/pathfinder-logo.png') }}" alt="Pathfinder Salemba Young Lions Logo" class="brand-logo">
                        <div class="admin-sidebar-title">
                            <strong>Pathfinder SYL</strong>
                            <span>Admin Panel</span>
                        </div>
                    </div>

                    <nav class="admin-nav">
                        <div class="admin-nav-label">Menu Utama</div>
                        <a href="{{ route('dashboard') }}" class="admin-side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="admin-side-icon">D</span>
                            Dashboard
                        </a>
                        <a href="{{ route('members.index') }}" class="admin-side-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                            <span class="admin-side-icon">M</span>
                            Kelola Member
                        </a>
                        <a href="{{ route('points.index') }}" class="admin-side-link {{ request()->routeIs('points.index') ? 'active' : '' }}">
                            <span class="admin-side-icon">H</span>
                            History Poin
                        </a>
                    </nav>

                    <div class="admin-sidebar-footer">
                        <div class="admin-user-card">
                            <strong>{{ auth()->user()->display_identity }}</strong>
                            <span>Master Guide</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="admin-side-button">
                                <span class="admin-side-icon">L</span>
                                Logout
                            </button>
                        </form>
                    </div>
                </aside>

                <div class="admin-main">
                    <header class="admin-header">
                        <div class="admin-header-inner">
                            <div class="admin-header-title">
                                <strong>Pathfinder Salemba Young Lions</strong>
                                <span>{{ auth()->user()->display_identity }}</span>
                            </div>
                            <div class="admin-mobile-brand">
                                <div class="brand-wrap">
                                    <img src="{{ asset('images/pathfinder-logo.png') }}" alt="Pathfinder Salemba Young Lions Logo" class="brand-logo">
                                    <div class="brand-text">
                                        <div class="brand">Pathfinder Salemba Young Lions</div>
                                        <div class="brand-user">{{ auth()->user()->display_identity }}</div>
                                    </div>
                                </div>
                            </div>
                            <button class="menu-toggle" type="button" aria-label="Buka menu" aria-controls="mobile-menu" aria-expanded="false" data-menu-open>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </header>

                    <main class="admin-content">
                        <div class="container">
                            @if (session('status'))
                                <div class="flash">{{ session('status') }}</div>
                            @endif

                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        @else
            <header class="topbar">
                <div class="container topbar-inner">
                    <div>
                        <div class="brand-wrap">
                            <img src="{{ asset('images/pathfinder-logo.png') }}" alt="Pathfinder Salemba Young Lions Logo" class="brand-logo">
                            <div class="brand-text">
                                <div class="brand">Pathfinder Salemba Young Lions</div>
                                <div class="brand-user">{{ auth()->user()->display_identity }}</div>
                            </div>
                        </div>
                    </div>
                    <button class="menu-toggle" type="button" aria-label="Buka menu" aria-controls="mobile-menu" aria-expanded="false" data-menu-open>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                        </svg>
                    </button>
                    <nav class="nav">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('profile') }}">Profil Saya</a>
                        <a href="{{ route('points.index') }}">History Poin</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </nav>
                </div>
            </header>

            <main>
                <div class="container">
                    @if (session('status'))
                        <div class="flash">{{ session('status') }}</div>
                    @endif

                    @yield('content')
                </div>
            </main>
        @endif
        <div class="mobile-menu" id="mobile-menu" aria-hidden="true" inert>
            <button class="mobile-menu-backdrop" type="button" aria-label="Tutup menu" data-menu-close></button>
            <aside class="mobile-menu-panel" role="dialog" aria-modal="true" aria-label="Menu navigasi">
                <div class="mobile-menu-head">
                    <div>
                        <div class="mobile-menu-title">Menu</div>
                        <div class="muted">{{ auth()->user()->display_identity }}</div>
                    </div>
                    <button class="mobile-menu-close" type="button" aria-label="Tutup menu" data-menu-close>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <nav class="mobile-nav">
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Kelola Member</a>
                        <a href="{{ route('points.index') }}" class="{{ request()->routeIs('points.index') ? 'active' : '' }}">History Poin</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profil Saya</a>
                        <a href="{{ route('points.index') }}" class="{{ request()->routeIs('points.index') ? 'active' : '' }}">History Poin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </nav>
            </aside>
        </div>
    @else
        <main>
            <div class="container">
                @if (session('status'))
                    <div class="flash">{{ session('status') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    @endauth
    @auth
        <script>
            (() => {
                const menu = document.getElementById('mobile-menu');
                const openButton = document.querySelector('[data-menu-open]');
                const closeButtons = document.querySelectorAll('[data-menu-close]');

                if (!menu || !openButton) {
                    return;
                }

                const setMenuState = (isOpen) => {
                    menu.classList.toggle('is-open', isOpen);
                    menu.setAttribute('aria-hidden', String(!isOpen));
                    menu.inert = !isOpen;
                    openButton.setAttribute('aria-expanded', String(isOpen));
                    document.body.style.overflow = isOpen ? 'hidden' : '';

                    if (isOpen) {
                        menu.querySelector('[data-menu-close]')?.focus();
                    } else {
                        openButton.focus();
                    }
                };

                openButton.addEventListener('click', () => setMenuState(true));
                closeButtons.forEach((button) => {
                    button.addEventListener('click', () => setMenuState(false));
                });
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        setMenuState(false);
                    }
                });
            })();
        </script>
    @endauth
</body>
</html>
