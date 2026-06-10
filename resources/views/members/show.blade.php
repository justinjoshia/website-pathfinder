@extends('layouts.app')

@section('content')
    <section class="card hero-card" style="margin-bottom: 22px;">
        <div class="hero-kicker">Profil Member</div>
        <h1 class="hero-title">{{ $member->user->name }}</h1>
        <p class="muted" style="max-width: 720px; margin-top: 14px;">
            Lihat rincian kelas, regu, total poin, dan seluruh histori perubahan nilai anggota ini.
        </p>
        <div class="hero-actions">
            <a href="{{ route('points.create', $member) }}" class="button">Tambah / Kurangi Poin</a>
            <a href="{{ route('members.edit', $member) }}" class="button secondary">Edit</a>
            <a href="{{ route('members.index') }}" class="button secondary">Kembali ke Kelola Member</a>
            <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Hapus member ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="button danger">Hapus</button>
            </form>
        </div>
    </section>

    <section class="grid grid-4">
        <article class="card stat-card">
            <div class="muted">Nama</div>
            <div class="stat" style="font-size: 1.5rem;">{{ $member->user->name }}</div>
        </article>
        <article class="card stat-card">
            <div class="muted">Kelas</div>
            <div class="stat" style="font-size: 1.35rem;">{{ $member->memberClass->name }}</div>
        </article>
        <article class="card stat-card">
            <div class="muted">Regu</div>
            <div class="stat" style="font-size: 1.35rem;">{{ $member->team->name }}</div>
        </article>
        <article class="card stat-card">
            <div class="muted">Total Poin</div>
            <div class="stat {{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</div>
        </article>
    </section>

    <section class="card section-card" style="margin-top: 20px;">
        <div class="section-head">
            <div>
                <h2>Histori Poin</h2>
                <p>Semua perubahan poin untuk member ini.</p>
            </div>
        </div>

        @if ($histories->isEmpty())
            <div class="empty">Belum ada histori poin.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Poin</th>
                            <th>Keterangan</th>
                            <th>Dibuat Oleh</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td data-label="Poin" class="{{ $history->points > 0 ? 'points-positive' : ($history->points < 0 ? 'points-negative' : '') }}">{{ $history->points > 0 ? '+' : '' }}{{ $history->points }}</td>
                                <td data-label="Keterangan">{{ $history->description }}</td>
                                <td data-label="Dibuat Oleh">{{ $history->creator->name }}</td>
                                <td data-label="Waktu">{{ $history->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">{{ $histories->links() }}</div>
        @endif
    </section>
@endsection
