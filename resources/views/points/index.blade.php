@extends('layouts.app')

@section('content')
    <section class="card hero-card" style="margin-bottom: 22px;">
        <div class="hero-kicker">Point History</div>
        <h1 class="hero-title">Riwayat Poin</h1>
        <p class="muted" style="max-width: 720px; margin-top: 14px;">
            {{ $isAdmin ? 'Pantau seluruh perubahan poin anggota untuk memastikan histori penilaian tetap jelas dan rapi.' : 'Lihat semua penambahan dan pengurangan poin Anda dalam satu histori yang mudah dibaca.' }}
        </p>
    </section>

    <section class="card section-card">
        <div class="section-head">
            <div>
                <h2>{{ $isAdmin ? 'Histori Seluruh Anggota' : 'Histori Poin Saya' }}</h2>
                <p>{{ $isAdmin ? 'Daftar lengkap perubahan poin seluruh member.' : 'Daftar lengkap perubahan poin pribadi Anda.' }}</p>
            </div>
        </div>
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
                                    <td data-label="Member">{{ $history->member->user->name }}</td>
                                @endif
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
