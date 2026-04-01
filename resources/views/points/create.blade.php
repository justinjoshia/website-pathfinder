@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Tambah / Kurangi Poin</h1>
            <p>{{ $member->user->name }} · {{ $member->memberClass->name }} · {{ $member->team->name }}</p>
        </div>
        <a href="{{ route('members.show', $member) }}" class="button secondary">Kembali</a>
    </section>

    <section class="card">
        <form action="{{ route('points.store', $member) }}" method="POST" class="grid">
            @csrf

            <label>
                Jumlah Poin
                <input type="number" name="points" value="{{ old('points') }}" placeholder="Contoh: 10 atau -5" required>
                @error('points')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>

            <label>
                Deskripsi
                <textarea name="description" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>

            <div class="actions">
                <button type="submit" class="button">Simpan Perubahan</button>
            </div>
        </form>
    </section>
@endsection
