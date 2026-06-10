<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pathfinder Salemba Young Lions' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pathfinder-logo.png') }}">
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto:wght@400;500;700;900&family=Open+Sans:wght@400;600;700;800&display=swap');</style>
    <style>
        :root {
            color-scheme: light;
            --bg: #f3ecda;
            --bg-soft: #e8dcc0;
            --panel: rgba(255, 251, 241, 0.92);
            --panel-solid: #fffaf0;
            --ink: #16241c;
            --muted: #5d6c61;
            --line: rgba(35, 61, 44, 0.16);
            --accent: #f0d11d;
            --accent-deep: #d8b100;
            --forest: #1f3b2d;
            --forest-soft: #2f5642;
            --cream: #fff7e7;
            --danger: #b42318;
            --success-bg: #e8f6ec;
            --success-text: #1f6b39;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", "Roboto", "Open Sans", "Segoe UI Variable", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(240, 209, 29, 0.22), transparent 26%),
                radial-gradient(circle at top right, rgba(31, 59, 45, 0.22), transparent 22%),
                linear-gradient(180deg, #f9f1dc 0%, var(--bg) 46%, #ece2ca 100%);
            color: var(--ink);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .container { width: min(1100px, calc(100% - 32px)); margin: 0 auto; }
        .topbar {
            border-bottom: 1px solid rgba(31, 59, 45, 0.14);
            background: var(--forest);
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
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            font-size: clamp(1.2rem, 2vw, 1.55rem);
            line-height: 1;
            letter-spacing: 0.01em;
            color: #fffdf5;
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
            object-fit: cover;
            object-position: center;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 251, 241, 0.9);
            padding: 0;
            flex-shrink: 0;
            box-shadow: 0 10px 24px rgba(7, 18, 12, 0.2);
        }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .nav a, .nav button {
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: rgba(255, 248, 223, 0.08);
            color: #fdf6de;
            padding: 10px 16px;
            border-radius: 999px;
            cursor: pointer;
            font: inherit;
            font-size: 0.94rem;
            font-weight: 700;
            transition: transform 140ms ease, background 140ms ease, border-color 140ms ease;
        }
        .nav a:hover, .nav button:hover {
            background: var(--accent);
            color: #16241c;
            border-color: rgba(240, 209, 29, 0.72);
            transform: translateY(-1px);
        }
        .menu-toggle {
            display: none;
            width: 46px;
            height: 46px;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50%;
            background: rgba(255, 248, 223, 0.1);
            color: #fffdf5;
            cursor: pointer;
            transition: background 140ms ease, border-color 140ms ease, transform 140ms ease;
        }
        .menu-toggle:hover {
            background: var(--accent);
            color: #16241c;
            border-color: rgba(240, 209, 29, 0.72);
            transform: translateY(-1px);
        }
        .menu-toggle svg {
            width: 24px;
            height: 24px;
            stroke-width: 2.4;
        }
        .mobile-menu {
            position: fixed;
            inset: 0;
            z-index: 80;
            pointer-events: none;
        }
        .mobile-menu.is-open { pointer-events: auto; }
        .mobile-menu-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(15, 28, 21, 0.46);
            opacity: 0;
            transition: opacity 180ms ease;
        }
        .mobile-menu.is-open .mobile-menu-backdrop { opacity: 1; }
        .mobile-menu-panel {
            position: absolute;
            top: 0;
            right: 0;
            width: min(320px, calc(100vw - 42px));
            height: 100%;
            padding: 20px;
            overflow-y: auto;
            background: var(--forest);
            color: #fffdf5;
            border-left: 1px solid rgba(255, 248, 223, 0.14);
            box-shadow: -18px 0 46px rgba(15, 28, 21, 0.24);
            transform: translateX(100%);
            transition: transform 220ms ease;
        }
        .mobile-menu.is-open .mobile-menu-panel { transform: translateX(0); }
        .mobile-menu-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255, 248, 223, 0.14);
        }
        .mobile-menu-title {
            font-weight: 900;
            color: #fffdf5;
        }
        .mobile-menu-close {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 248, 223, 0.16);
            border-radius: 50%;
            background: rgba(255, 248, 223, 0.08);
            color: #fffdf5;
            cursor: pointer;
        }
        .mobile-menu-close svg {
            width: 20px;
            height: 20px;
            stroke-width: 2.4;
        }
        .mobile-nav {
            display: grid;
            gap: 10px;
            padding-top: 18px;
        }
        .mobile-nav a, .mobile-nav button {
            width: 100%;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            border: 1px solid rgba(255, 248, 223, 0.14);
            background: rgba(255, 248, 223, 0.08);
            color: rgba(255, 248, 223, 0.9);
            padding: 13px 14px;
            border-radius: 14px;
            cursor: pointer;
            font: inherit;
            font-size: 0.96rem;
            font-weight: 800;
            text-align: left;
        }
        .mobile-nav a.active {
            background: var(--accent);
            color: #16241c;
            border-color: rgba(240, 209, 29, 0.72);
        }
        .mobile-nav form { margin: 0; }
        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            background:
                radial-gradient(circle at top right, rgba(240, 209, 29, 0.18), transparent 24%),
                linear-gradient(180deg, #f9f1dc 0%, var(--bg) 46%, #ece2ca 100%);
        }
        .admin-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 22px;
            padding: 22px 18px;
            background: var(--forest);
            color: #fffdf5;
            border-right: 1px solid rgba(255, 248, 223, 0.12);
            box-shadow: 18px 0 42px rgba(31, 59, 45, 0.12);
        }
        .admin-sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 8px 18px;
            border-bottom: 1px solid rgba(255, 248, 223, 0.14);
        }
        .admin-sidebar-brand .brand-logo {
            width: 52px;
            height: 52px;
        }
        .admin-sidebar-title {
            display: grid;
            gap: 4px;
            min-width: 0;
        }
        .admin-sidebar-title strong {
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            line-height: 1.1;
            color: #fffdf5;
        }
        .admin-sidebar-title span {
            color: rgba(255, 248, 223, 0.68);
            font-size: 0.82rem;
            font-weight: 700;
        }
        .admin-nav {
            display: grid;
            gap: 8px;
        }
        .admin-nav-label {
            margin: 8px 10px 4px;
            color: rgba(255, 248, 223, 0.52);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }
        .admin-side-link,
        .admin-side-button {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid transparent;
            background: transparent;
            color: rgba(255, 248, 223, 0.82);
            font: inherit;
            font-weight: 800;
            cursor: pointer;
            transition: background 140ms ease, color 140ms ease, border-color 140ms ease, transform 140ms ease;
        }
        .admin-side-link:hover,
        .admin-side-button:hover {
            background: rgba(240, 209, 29, 0.12);
            color: #fffdf5;
            border-color: rgba(240, 209, 29, 0.22);
            transform: translateX(2px);
        }
        .admin-side-link.active {
            background: var(--accent);
            color: #16241c;
            border-color: rgba(240, 209, 29, 0.72);
            box-shadow: 0 12px 24px rgba(216, 177, 0, 0.22);
        }
        .admin-side-icon {
            width: 22px;
            text-align: center;
            font-weight: 900;
        }
        .admin-sidebar-footer {
            margin-top: auto;
            display: grid;
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 248, 223, 0.14);
        }
        .admin-user-card {
            display: grid;
            gap: 4px;
            padding: 14px;
            border-radius: 16px;
            background: rgba(255, 248, 223, 0.08);
            border: 1px solid rgba(255, 248, 223, 0.1);
        }
        .admin-user-card strong {
            color: #fffdf5;
            line-height: 1.2;
        }
        .admin-user-card span {
            color: rgba(255, 248, 223, 0.68);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .admin-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 15;
            border-bottom: 1px solid rgba(31, 59, 45, 0.12);
            background: rgba(255, 251, 241, 0.84);
            backdrop-filter: blur(16px);
        }
        .admin-header-inner {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 18px 0;
        }
        .admin-header-title {
            display: grid;
            gap: 4px;
        }
        .admin-header-title strong {
            color: var(--forest);
            font-size: 1.05rem;
            font-weight: 900;
        }
        .admin-header-title span {
            color: var(--muted);
            font-size: 0.9rem;
        }
        .admin-mobile-brand {
            display: none;
        }
        .admin-header .menu-toggle {
            border-color: rgba(31, 59, 45, 0.16);
            background: rgba(255, 251, 241, 0.9);
            color: var(--forest);
        }
        .admin-content {
            padding: 34px 0 56px;
        }
        .admin-content .container {
            width: min(1180px, calc(100% - 40px));
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
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
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
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 16px 44px rgba(53, 66, 53, 0.08);
        }
        .hero-card {
            position: relative;
            overflow: hidden;
            background: var(--forest);
            color: #fffdf5;
            border: 0;
            box-shadow: 0 22px 44px rgba(31, 59, 45, 0.18);
        }
        .hero-card::after {
            content: "";
            position: absolute;
            inset: auto -70px -80px auto;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(205, 226, 210, 0.12);
            display: none;
        }
        .hero-card .muted { color: rgba(255, 251, 241, 0.82); }
        .hero-title {
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            font-size: clamp(2rem, 4vw, 2.9rem);
            margin: 0;
            line-height: 0.96;
            letter-spacing: -0.03em;
            color: #fffdf5;
        }
        .hero-kicker {
            font-family: "Open Sans", "Inter", sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 248, 223, 0.12);
            border: 1px solid rgba(255, 248, 223, 0.16);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }
        .hero-actions .button.secondary {
            background: rgba(255, 248, 223, 0.12);
            color: #fffdf5;
            border-color: rgba(255, 248, 223, 0.2);
        }
        .hero-actions .button:not(.secondary) {
            background: rgba(255, 248, 223, 0.92);
            color: var(--forest);
            border-color: rgba(255, 248, 223, 0.28);
            box-shadow: 0 12px 24px rgba(10, 24, 16, 0.16);
        }
        .section-card {
            position: relative;
            overflow: hidden;
        }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 20px;
        }
        .section-head h2 {
            margin: 0;
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            font-size: 1.9rem;
            color: var(--forest);
            line-height: 1;
        }
        .section-head p {
            margin: 8px 0 0;
            color: var(--muted);
            font-family: "Open Sans", "Inter", sans-serif;
        }
        .stat {
            font-family: "Roboto", "Inter", sans-serif;
            font-size: clamp(2rem, 3vw, 2.6rem);
            font-weight: 900;
            margin-top: 10px;
            letter-spacing: -0.03em;
        }
        .stat-card {
            background: rgba(255, 251, 241, 0.96);
            border-color: rgba(31, 59, 45, 0.14);
        }
        .stat-card .muted {
            color: var(--forest-soft);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.74rem;
            font-weight: 800;
        }
        .points-low { color: #b42318; }
        .points-mid { color: #b68900; }
        .points-high { color: #1f6b39; }
        .points-positive { color: #1f6b39; }
        .points-negative { color: #b42318; }
        .muted { color: var(--muted); line-height: 1.55; }
        .muted, th, .app-badge, .error {
            font-family: "Open Sans", "Inter", sans-serif;
        }
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
            background: linear-gradient(180deg, #f6dc34 0%, var(--accent) 100%);
            color: #213021;
            border: 1px solid rgba(184, 145, 0, 0.34);
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
            background: rgba(255, 250, 240, 0.96);
            color: var(--forest);
            border-color: rgba(31, 59, 45, 0.16);
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
            border-radius: 12px;
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
            background: rgba(240, 209, 29, 0.12);
        }
        tbody tr:hover { background: rgba(250, 243, 215, 0.78); }
        .error { color: var(--danger); font-size: 0.92rem; margin: 4px 0 0; font-weight: 700; }
        .pagination { margin-top: 18px; display: flex; justify-content: center; }
        .empty {
            padding: 28px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed rgba(41, 69, 54, 0.18);
            border-radius: 12px;
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
        .login-split {
            width: 100%;
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(320px, 1.05fr) minmax(360px, 0.95fr);
            background: rgba(255, 251, 241, 0.92);
            border: 0;
            border-radius: 0;
            overflow: hidden;
            box-shadow: none;
        }
        .login-showcase {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            padding: 40px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--forest);
            color: #fffdf5;
        }
        .login-showcase::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255, 248, 223, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 248, 223, 0.08) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.28;
            display: none;
        }
        .login-showcase::after {
            content: "";
            position: absolute;
            inset: auto -80px -110px auto;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(205, 226, 210, 0.12);
            display: none;
        }
        .login-showcase > * { position: relative; z-index: 1; }
        .login-showcase-top {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 248, 223, 0.82);
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }
        .login-showcase-badge {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: #cde2d2;
            box-shadow: 0 0 0 6px rgba(205, 226, 210, 0.14);
        }
        .login-showcase-copy h2 {
            margin: 0 0 14px;
            font-size: 1.1rem;
            font-weight: 700;
            color: rgba(255, 248, 223, 0.82);
        }
        .login-showcase-copy h1 {
            margin: 0;
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            font-size: clamp(3rem, 5vw, 4.7rem);
            line-height: 0.93;
            letter-spacing: -0.04em;
            color: #fffdf5;
        }
        .login-showcase-divider {
            width: 62px;
            height: 6px;
            margin: 24px 0 22px;
            border-radius: 999px;
            background: linear-gradient(90deg, #fffdf5 0%, #cde2d2 100%);
        }
        .login-showcase-copy p {
            margin: 0;
            max-width: 440px;
            color: rgba(255, 248, 223, 0.78);
            line-height: 1.8;
            font-size: 0.98rem;
        }
        .login-showcase-panel {
            display: grid;
            gap: 10px;
            max-width: 420px;
            padding: 18px 20px;
            border-radius: 12px;
            background: rgba(255, 248, 223, 0.1);
            border: 1px solid rgba(255, 248, 223, 0.14);
            backdrop-filter: blur(6px);
        }
        .login-showcase-panel strong {
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 248, 223, 0.72);
        }
        .login-showcase-panel span {
            font-size: 1.02rem;
            font-weight: 700;
            color: #fffdf5;
        }
        .login-form-pane {
            padding: 42px 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at top right, rgba(240, 209, 29, 0.12), transparent 22%),
                rgba(255, 252, 244, 0.96);
        }
        .login-form-inner {
            width: min(420px, 100%);
        }
        main:has(.login-shell) {
            padding: 0;
        }
        main:has(.login-shell) > .container {
            width: 100%;
        }
        .login-form-head {
            margin-bottom: 24px;
        }
        .login-form-logo {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            object-fit: cover;
            background: rgba(255, 251, 241, 0.92);
            border: 1px solid rgba(31, 59, 45, 0.14);
            padding: 0;
            box-shadow: 0 12px 28px rgba(31, 59, 45, 0.12);
            margin-bottom: 18px;
        }
        .login-form-head h1 {
            margin: 0;
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
            font-size: clamp(2.2rem, 4vw, 3rem);
            line-height: 0.96;
            color: var(--forest);
        }
        .login-form-head p {
            margin: 14px 0 0;
            color: var(--muted);
            line-height: 1.75;
        }
        .login-form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .section-title {
            font-family: "Roboto", "Inter", sans-serif;
            font-weight: 900;
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
            background: rgba(31, 59, 45, 0.08);
            color: var(--forest);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        @media (max-width: 700px) {
            .page-head { align-items: flex-start; flex-direction: column; }
            .topbar-inner { padding: 12px 0; }
            .topbar-inner > div:first-child,
            .brand-wrap,
            .brand-text { min-width: 0; }
            .brand { font-size: 1.08rem; line-height: 1.06; }
            .brand-user {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .nav { display: none; }
            .menu-toggle { display: inline-flex; flex-shrink: 0; }
            .admin-shell {
                grid-template-columns: 1fr;
            }
            .admin-sidebar {
                display: none;
            }
            .admin-header {
                position: sticky;
                border-bottom: 1px solid rgba(31, 59, 45, 0.14);
                background: var(--forest);
            }
            .admin-header-inner,
            .admin-content .container {
                width: min(100% - 28px, 1180px);
            }
            .admin-header-inner {
                padding: 12px 0;
            }
            .admin-header-title {
                display: none;
            }
            .admin-mobile-brand {
                display: block;
                min-width: 0;
            }
            .admin-header .brand {
                color: #fffdf5;
            }
            .admin-header .brand-user {
                color: #fff7d6;
                text-shadow: 0 1px 10px rgba(0, 0, 0, 0.18);
            }
            .admin-header .menu-toggle {
                border-color: rgba(255, 255, 255, 0.18);
                background: rgba(255, 248, 223, 0.1);
                color: #fffdf5;
            }
            .brand-logo { width: 48px; height: 48px; }
            .login-card { padding: 24px; border-radius: 26px; }
            .login-split {
                grid-template-columns: 1fr;
                border-radius: 0;
            }
            .login-showcase {
                min-height: 0;
                padding: 26px 22px;
            }
            .login-showcase-copy h1 { font-size: 2.6rem; }
            .login-form-pane { padding: 26px 22px; }
            th, td { padding: 14px; }
            .hero-actions .button,
            .hero-actions a { width: 100%; }
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
