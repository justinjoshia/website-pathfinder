@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>List Member</h1>
            <p>Kelola data anggota, cari nama, kelas, atau regu.</p>
        </div>
        <a href="{{ route('members.create') }}" class="button">Tambah Member</a>
    </section>

    <section class="card">
        <form method="GET" action="{{ route('members.index') }}" class="form-grid">
            <label>
                Search
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, kelas, atau regu">
            </label>
            <div class="actions" style="align-items: end;">
                <button type="submit" class="button">Cari</button>
                <a href="{{ route('members.index') }}" class="button secondary">Reset</a>
            </div>
        </form>
    </section>

    <section class="card" style="margin-top: 20px;">
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
                                <td>{{ $member->user->name }}</td>
                                <td>{{ $member->memberClass->name }}</td>
                                <td>{{ $member->team->name }}</td>
                                <td class="{{ $member->total_points < 50 ? 'points-low' : ($member->total_points > 50 && $member->total_points < 90 ? 'points-mid' : ($member->total_points >= 90 && $member->total_points <= 100 ? 'points-high' : '')) }}">{{ $member->total_points }}</td>
                                <td>
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
