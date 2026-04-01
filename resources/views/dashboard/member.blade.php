@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Dashboard Member</h1>
            <p>Ringkasan profil dan histori poin pribadi.</p>
        </div>
        <div class="actions">
            <a href="{{ route('profile') }}" class="button">Lihat Profil</a>
            <a href="{{ route('points.index') }}" class="button secondary">Semua History</a>
        </div>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 18px; flex-wrap: wrap;">
            <img src="{{ asset('images/pathfinder-logo.png') }}" alt="Pathfinder Salemba Young Lions Logo" class="brand-logo" style="width: 92px; height: 92px;">
            <div>
                <div class="brand" style="font-size: 1.4rem;">Pathfinder Salemba Young Lions</div>
                <div class="muted">Lihat profil, regu, kelas, dan perkembangan poin Anda.</div>
            </div>
        </div>
    </section>

    <section class="grid grid-4">
        <article class="card">
            <div class="muted">Nama</div>
            <div class="stat" style="font-size: 1.5rem;">{{ $member->user->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Kelas</div>
            <div class="stat" style="font-size: 1.25rem;">{{ $member->memberClass->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Regu</div>
            <div class="stat" style="font-size: 1.25rem;">{{ $member->team->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Total Poin</div>
            <div class="stat {{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</div>
        </article>
    </section>

    <section class="card" style="margin-top: 20px;">
        <div class="page-head">
            <div>
                <h1 style="font-size: 1.5rem;">Histori Poin Terbaru</h1>
                <p>10 histori terakhir milik Anda.</p>
            </div>
        </div>

        @if ($recentHistories->isEmpty())
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
                        @foreach ($recentHistories as $history)
                            <tr>
                                <td class="{{ $history->points > 0 ? 'points-positive' : ($history->points < 0 ? 'points-negative' : '') }}">{{ $history->points > 0 ? '+' : '' }}{{ $history->points }}</td>
                                <td>{{ $history->description }}</td>
                                <td>{{ $history->creator->name }}</td>
                                <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
