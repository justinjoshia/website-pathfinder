@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>History Poin</h1>
            <p>{{ $isAdmin ? 'Histori seluruh anggota.' : 'Histori poin Anda.' }}</p>
        </div>
    </section>

    <section class="card">
        @if ($histories->isEmpty())
            <div class="empty">Belum ada histori poin.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            @if ($isAdmin)
                                <th>Member</th>
                            @endif
                            <th>Poin</th>
                            <th>Keterangan</th>
                            <th>Dibuat Oleh</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                @if ($isAdmin)
                                    <td>{{ $history->member->user->name }}</td>
                                @endif
                                <td class="{{ $history->points > 0 ? 'points-positive' : ($history->points < 0 ? 'points-negative' : '') }}">{{ $history->points > 0 ? '+' : '' }}{{ $history->points }}</td>
                                <td>{{ $history->description }}</td>
                                <td>{{ $history->creator->name }}</td>
                                <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">{{ $histories->links() }}</div>
        @endif
    </section>
@endsection
