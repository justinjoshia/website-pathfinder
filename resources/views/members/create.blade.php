@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Tambah Member</h1>
            <p>Buat akun peserta baru dan profil keanggotaannya.</p>
        </div>
    </section>

    <section class="card">
        <form action="{{ route('members.store') }}" method="POST">
            @include('members._form', ['submitLabel' => 'Simpan Member'])
        </form>
    </section>
@endsection
