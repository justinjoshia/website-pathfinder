<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pathfinder Salemba Young Lions' }}</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f6f1e8;
            --panel: #fffdf9;
            --ink: #1f2937;
            --muted: #6b7280;
            --line: #ded6c8;
            --accent: #8b5e34;
            --danger: #b42318;
            --success-bg: #e8f6ec;
            --success-text: #1f6b39;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            background: radial-gradient(circle at top, #fff9ef, var(--bg));
            color: var(--ink);
        }
        a { color: inherit; text-decoration: none; }
        .container { width: min(1100px, calc(100% - 32px)); margin: 0 auto; }
        .topbar {
            border-bottom: 1px solid var(--line);
            background: rgba(255, 253, 249, 0.96);
            position: sticky;
            top: 0;
        }
        .topbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
        }
        .brand { font-size: 1.15rem; font-weight: 700; letter-spacing: 0.04em; }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .nav a, .nav button {
            border: 1px solid var(--line);
            background: var(--panel);
            padding: 10px 14px;
            border-radius: 999px;
            cursor: pointer;
            font: inherit;
        }
        main { padding: 28px 0 48px; }
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 24px;
        }
        .page-head h1 { margin: 0; font-size: clamp(1.8rem, 3vw, 2.6rem); }
        .page-head p { margin: 8px 0 0; color: var(--muted); }
        .grid { display: grid; gap: 16px; }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 20px;
        }
        .stat { font-size: 2rem; font-weight: 700; margin-top: 8px; }
        .points-low { color: #b42318; }
        .points-mid { color: #b58105; }
        .points-high { color: #1f6b39; }
        .points-positive { color: #1f6b39; }
        .points-negative { color: #b42318; }
        .muted { color: var(--muted); }
        .flash {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 14px;
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid #c9e8d1;
        }
        .form-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        label { display: grid; gap: 8px; font-weight: 600; }
        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            font: inherit;
        }
        textarea { min-height: 110px; resize: vertical; }
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--accent);
            color: #fff;
            border: 1px solid var(--accent);
            padding: 12px 18px;
            border-radius: 12px;
            cursor: pointer;
            font: inherit;
        }
        .button.secondary {
            background: var(--panel);
            color: var(--ink);
            border-color: var(--line);
        }
        .button.danger {
            background: #fff3f2;
            color: var(--danger);
            border-color: #f3c6c3;
        }
        .actions { display: flex; flex-wrap: wrap; gap: 10px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 12px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; }
        th { color: var(--muted); font-size: 0.92rem; }
        .error { color: var(--danger); font-size: 0.92rem; margin: 4px 0 0; }
        .pagination { margin-top: 18px; display: flex; justify-content: center; }
        .empty {
            padding: 28px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed var(--line);
            border-radius: 16px;
        }
        .login-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .login-card {
            width: min(460px, 100%);
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 28px;
        }
        @media (max-width: 700px) {
            .page-head, .topbar-inner { align-items: flex-start; flex-direction: column; }
            .nav { width: 100%; }
        }
    </style>
</head>
<body>
    @auth
        <header class="topbar">
            <div class="container topbar-inner">
                <div>
                    <div class="brand">Pathfinder Salemba Young Lions</div>
                    <div class="muted">{{ auth()->user()->name }} · {{ auth()->user()->role === 'admin' ? 'Master Guide' : 'User' }}</div>
                </div>
                <nav class="nav">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('members.index') }}">Member</a>
                    @else
                        <a href="{{ route('profile') }}">Profil Saya</a>
                    @endif
                    <a href="{{ route('points.index') }}">History Poin</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </nav>
            </div>
        </header>
    @endauth

    <main>
        <div class="container">
            @if (session('status'))
                <div class="flash">{{ session('status') }}</div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
