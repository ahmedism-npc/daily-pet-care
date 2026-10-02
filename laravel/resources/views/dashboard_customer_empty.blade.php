@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom" style="border-color: var(--border) !important;">
    <h1 class="h2" style="color: var(--primary);">Halo, {{ Auth::user()->name }} 👋</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="{{ route('logout') }}" method="POST" class="me-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
</div>

<div class="alert alert-info" style="background-color: var(--card); color: var(--foreground); border-color: var(--border);">
    <strong style="color: var(--primary);">Selamat Datang!</strong> Akun Anda belum ditautkan dengan data pelanggan di klinik kami. Silakan hubungi kasir saat Anda berkunjung agar riwayat perawatan hewan peliharaan Anda muncul di halaman ini.
</div>
@endsection
