<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .navbar .point {
            font-size: 16px;
            background-color: #f39c12;
            padding: 5px 12px;
            border-radius: 20px;
            /* Tambahan agar warna teks tetap putih dan tidak ada garis bawah saat menjadi link */
            color: white;
            text-decoration: none;
        }

        .layout {
            display: flex;
            margin-top: 55px;
        }

        .sidebar {
            width: 200px;
            min-height: calc(100vh - 55px);
            background-color: #34495e;
            padding: 20px 0;
            position: fixed;
            top: 55px;
            left: 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 20px;
            color: #ecf0f1;
            text-decoration: none;
            font-size: 15px;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            background-color: #2c3e50;
        }

        .sidebar a.active {
            background-color: #f39c12;
            color: white;
            font-weight: bold;
        }

        .sidebar .icon {
            font-size: 18px;
        }

        .sidebar .divider {
            border: none;
            border-top: 1px solid #4a6278;
            margin: 10px 0;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
            flex: 1;
        }

        .content h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .product-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            background-color: #ddd;
        }

        .product-card .info {
            padding: 10px;
        }

        .product-card .info h3 {
            font-size: 15px;
            margin-bottom: 4px;
            color: #2c3e50;
        }

        .product-card .info p {
            font-size: 13px;
            color: #777;
            margin-bottom: 4px;
        }

        .product-card .info .point-badge {
            display: inline-block;
            background-color: #f39c12;
            color: white;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-bottom: 8px;
        }

        .product-card .info button {
            width: 100%;
            padding: 7px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .logout-btn button {
            padding: 8px 16px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="navbar">
    <span>Welcome, {{ $user->name }}!</span>
    <a href="/points" class="point">Point: {{ $user->point ?? 0 }}</a>
</div>

<div class="layout">

    <div class="sidebar">
        <a href="/profile" class="active">
            <span class="icon"></span> Home
        </a>
        <hr class="divider">
        <a href="/riwayat-transaksi">
            <span class="icon"></span> Transaksi
        </a>
        <a href="/rewards">
            <span class="icon"></span> Rewards
        </a>
        <a href="/redeem">
            <span class="icon"></span> Redeem
        </a>
        <a href="/membership">
            <span class="icon"></span> Membership
        </a>
    </div>

    <div class="content">
        <h2>Best Seller !!</h2>
       <div class="product-grid">

    <div class="product-card">
        <img src="{{ asset('images/kopi.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Milk</h3>
            <p>Rp 8.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Milk">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="8000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

    <div class="product-card">
        <img src="{{ asset('images/kopi2.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Sugar</h3>
            <p>Rp 10.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Sugar">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="10000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

    <div class="product-card">
        <img src="{{ asset('images/kopi.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Latte</h3>
            <p>Rp 12.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Latte">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="12000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

    <div class="product-card">
        <img src="{{ asset('images/kopi2.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Sugar</h3>
            <p>Rp 10.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Sugar">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="10000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

    <div class="product-card">
        <img src="{{ asset('images/kopi.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Milk</h3>
            <p>Rp 8.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Milk">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="8000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

    <div class="product-card">
        <img src="{{ asset('images/kopi2.jpg') }}" alt="Kopi">
        <div class="info">
            <h3>Coffe Latte</h3>
            <p>Rp 12.000</p>
            <span class="point-badge">10 Point</span><br>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_name[]" value="Coffe Latte">
                <input type="hidden" name="qty[]" value="1">
                <input type="hidden" name="price[]" value="12000">
                <button type="submit">Beli</button>
            </form>
        </div>
    </div>

</div>

        </div>
    </div>

</div>

<div class="logout-btn">
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>