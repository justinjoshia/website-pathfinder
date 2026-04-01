@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h1>Edit Member</h1>
            <p>Perbarui data profil anggota.</p>
        </div>
    </section>

    <section class="card">
        <form action="{{ route('members.update', $member) }}" method="POST">
            @method('PUT')
            @include('members._form', ['submitLabel' => 'Perbarui Member'])
        </form>
    </section>
@endsection
