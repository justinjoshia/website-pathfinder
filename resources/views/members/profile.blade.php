@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Profil Saya</h1>
            <p>Data keanggotaan dan total poin pribadi.</p>
        </div>
        <a href="{{ route('points.index') }}" class="button">Lihat History Poin</a>
    </section>

    <section class="grid grid-4">
        <article class="card">
            <div class="muted">Nama</div>
            <div class="stat" style="font-size: 1.5rem;">{{ $member->user->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Kelas</div>
            <div class="stat" style="font-size: 1.35rem;">{{ $member->memberClass->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Regu</div>
            <div class="stat" style="font-size: 1.35rem;">{{ $member->team->name }}</div>
        </article>
        <article class="card">
            <div class="muted">Total Poin</div>
            <div class="stat {{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</div>
        </article>
    </section>
@endsection
