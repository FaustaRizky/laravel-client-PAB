@extends('checkout-layout')

@section('content')
<div class="container">
    <h1>Checkout Barang: {{ $item['nama_barang'] }}</h1>

    <form action="{{ route('checkout.process', $item['id']) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Tunai</option>
                <option value="bank_transfer">Transfer Bank</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
    </form>
</div>
@endsection
