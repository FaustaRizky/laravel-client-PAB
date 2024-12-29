<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .item-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-5px);
        }

        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .item-detail {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .item-price {
            font-size: 18px;
            color: #d9534f;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Barang</h1>

        <div class="items-grid">
            @foreach ($items as $item)
                <div class="item-card">
                    <!-- Ganti dengan gambar barang yang sesuai -->
                    <img src="https://via.placeholder.com/300x200.png?text=Image+Unavailable" alt="Item Image" class="item-image">
                    <p class="item-name">{{ $item['nama_barang'] }}</p> <!-- Ganti akses ke array -->
                    <p class="item-detail">{{ $item['detail'] }}</p> <!-- Ganti akses ke array -->
                    <p class="item-price">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</p> <!-- Ganti akses ke array -->
                    <a href="{{ route('checkout.form', ['itemId' => $item['id']]) }}" class="btn btn-primary">Beli</a>

                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
