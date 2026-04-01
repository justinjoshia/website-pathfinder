@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Ringkasan admin dan daftar seluruh member.</p>
        </div>
        <div class="actions">
            <a href="{{ route('members.index') }}" class="button">Kelola Member</a>
        </div>
    </section>

    <section class="grid grid-3">
        <article class="card">
            <div class="muted">Total Member</div>
            <div class="stat">{{ $memberCount }}</div>
        </article>
        <article class="card">
            <div class="muted">Master Guide</div>
            <div class="stat">{{ $adminCount }}</div>
        </article>
    </section>

    <section class="card" style="margin-top: 20px;">
        <div class="page-head">
            <div>
                <h1 style="font-size: 1.5rem;">Semua Member</h1>
                <p>Daftar seluruh anggota yang terdaftar.</p>
            </div>
        </div>

        @if ($members->isEmpty())
            <div class="empty">Belum ada member.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Kelas</th>
                            <th>Regu</th>
                            <th>Total Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->user->name }}</td>
                                <td>{{ $member->memberClass->name }}</td>
                                <td>{{ $member->team->name }}</td>
                                <td class="{{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
