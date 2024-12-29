@extends('checkout-layout')

@section('content')
<div class="container text-center">
    <h1>Terima Kasih</h1>
    <p>Transaksi Anda berhasil diproses.</p>
    <p><strong>Nama:</strong> {{ session('transaction')['name'] }}</p>
    <p><strong>Alamat:</strong> {{ session('transaction')['address'] }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ session('transaction')['payment_method'] }}</p>
    <p><strong>Status:</strong> {{ session('transaction')['status'] }}</p>
    <a href="{{ url('/items') }}" class="btn btn-primary">Kembali ke Daftar Barang</a>
</div>
@endsection
