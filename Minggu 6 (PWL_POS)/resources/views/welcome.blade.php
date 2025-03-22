@extends('layouts.app')  {{--memanggil folder layouts,file app --}}

{{-- customize layout sections --}}
@section('subtitle', 'Welcome') {{-- Menetapkan subtitle halaman menjadi "Welcome" --}}
@section('content_header_title', 'Home') {{-- Menetapkan judul header halaman menjadi "Home" --}}
@section('content_header_subtitle', 'Welcome') {{-- Menetapkan subtitle header halaman menjadi "Welcome" --}}

{{-- content body: main page content --}}
@section('content_body')
    <p>Welcome to this beautiful admin panel</p> {{-- Menampilkan teks sambutan pada panel admin --}}
@endsection

{{-- push extra css --}}
@push('css')
    {{-- add here extra stylesheet --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- push extra scripts --}}
@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!");</script>   {{-- Menampilkan pesan di console browser untuk debugging --}}
@endpush