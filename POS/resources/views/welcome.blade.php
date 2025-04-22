@extends('layouts.template')

@section('content')
<div class="card">
   <div class="card-header">
       <h3 class="card-title">
           <span style="color: rgb(223, 53, 141);">Halo, apakabar!</span> <br><br>
           <span style="color: blue;">Hello, how are you?</span> <br><br>
           <span style="color: green;">こんにちは、お元気ですか？</span><br><br>
           <span style="color: orange;">你好，你好吗？</span> <br><br>
           {{-- <span style="color: red;">안녕하세요, 어떻게 지내세요?</span> <br> --}}
       </h3>
       <div class="card-tools"></div>
   </div>
   <div class="card-body">
       Selamat datang, ini adalah halaman utama dari website ini. 
       <br><br>
       Berikut adalah fitur-fitur yang tersedia dalam website ini:
       <ul>
           <li>Level User</li>
           <li>Data User</li>
           <li>Kategori Barang</li>
           <li>Data Supplier</li>
           <li>Data Barang</li>
           <li>Stok Barang</li>
           <li>Transaksi Penjualan</li>
       </ul>
       Semoga Tampilan dan fungsi pada website ini sudah sesuai dan dapat berjalan dengan baik.
   </div>
</div>
@endsection