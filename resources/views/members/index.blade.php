@extends('layouts.app')

@section('content')
    <section class="card hero-card" style="margin-bottom: 22px;">
        <div class="hero-kicker">Kelola Member</div>
        <h1 class="hero-title">Data Anggota Pathfinder</h1>
        <p class="muted" style="max-width: 720px; margin-top: 14px;">
            Cari anggota, cek kelas dan regu, lalu lanjutkan ke detail atau pengelolaan poin dari satu halaman yang lebih terstruktur.
        </p>
        <div class="hero-actions">
            <a href="{{ route('members.create') }}" class="button">Tambah Member</a>
            <a href="{{ route('dashboard') }}" class="button secondary">Kembali ke Dashboard</a>
        </div>
    </section>

    <section class="card section-card">
        <div class="section-head">
            <div>
                <h2>Filter Anggota</h2>
                <p>Cari berdasarkan nama, kelas, atau regu.</p>
            </div>
        </div>
        <form method="GET" action="{{ route('members.index') }}" class="form-grid">
            <label>
                Search Member
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, kelas, atau regu">
            </label>
            <div class="actions" style="align-items: end;">
                <button type="submit" class="button">Cari</button>
                <a href="{{ route('members.index') }}" class="button secondary">Reset</a>
            </div>
        </form>
    </section>

    <section class="card section-card" style="margin-top: 20px;">
        <div class="section-head">
            <div>
                <h2>Daftar Member</h2>
                <p>Menampilkan {{ $members->count() }} member pada halaman ini.</p>
            </div>
        </div>
        @if ($members->isEmpty())
            <div class="empty">Belum ada member yang sesuai.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Regu</th>
                            <th>Total Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td data-label="Nama">{{ $member->user->name }}</td>
                                <td data-label="Kelas">{{ $member->memberClass->name }}</td>
                                <td data-label="Regu">{{ $member->team->name }}</td>
                                <td data-label="Total Poin" class="{{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</td>
                                <td data-label="Aksi">
                                    <div class="actions">
                                        <a href="{{ route('members.show', $member) }}" class="button secondary">Detail</a>
                                        <a href="{{ route('points.create', $member) }}" class="button">Poin</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">{{ $members->links() }}</div>
        @endif
    </section>
@endsection
