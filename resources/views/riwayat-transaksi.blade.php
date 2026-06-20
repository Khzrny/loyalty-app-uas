<!DOCTYPE html>
<html>
<head>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }

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
            top: 0; left: 0; right: 0;
            z-index: 100;
        }

        .navbar .point {
            font-size: 16px;
            background-color: #f39c12;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .layout { display: flex; margin-top: 55px; }

        .sidebar {
            width: 200px;
            min-height: calc(100vh - 55px);
            background-color: #34495e;
            padding: 20px 0;
            position: fixed;
            top: 55px; left: 0;
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

        .sidebar a:hover { background-color: #2c3e50; }

        .sidebar a.active {
            background-color: #f39c12;
            color: white;
            font-weight: bold;
        }

        .sidebar .divider { border: none; border-top: 1px solid #4a6278; margin: 10px 0; }

        .content { margin-left: 200px; padding: 20px; flex: 1; }
        .content h2 { margin-bottom: 15px; color: #2c3e50; }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 15px;
            margin-bottom: 15px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
        }

        .badge-pending { background-color: #f39c12; }
        .badge-completed { background-color: #27ae60; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { padding: 8px 10px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background-color: #f5f5f5; color: #2c3e50; }

        .checkout-btn {
            padding: 7px 16px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
        }

        .logout-btn { position: fixed; bottom: 20px; right: 20px; }
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
    <span>Riwayat Transaksi</span>
    <a href="/points" class="point">Point: {{ Auth::user()->point ?? 0 }}</a>
</div>

<div class="layout">

    <div class="sidebar">
        <a href="/profile">
            <span class="icon"></span> Home
        </a>
        <hr class="divider">
        <a href="/riwayat-transaksi" class="active">
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
        <h2>Riwayat Transaksi</h2>

        @if(session('success'))
            <p style="color:green; margin-bottom:10px">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p style="color:red; margin-bottom:10px">{{ session('error') }}</p>
        @endif

        @forelse($transaksi as $t)
            <div class="card">
                <div class="card-header">
                    <span style="font-weight:bold; color:#2c3e50">
                        Transaksi #{{ $t->id }} — {{ $t->created_at->format('d M Y') }}
                    </span>
                    <span class="badge {{ $t->status == 'completed' ? 'badge-completed' : 'badge-pending' }}">
                        {{ ucfirst($t->status) }}
                    </span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($t->details as $d)
                        <tr>
                            <td>{{ $d->product_name }}</td>
                            <td>{{ $d->qty }}</td>
                            <td>Rp {{ number_format($d->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="margin-bottom:5px"><strong>Total: Rp {{ number_format($t->total_price, 0, ',', '.') }}</strong></p>
                <p style="margin-bottom:10px">Point didapat: <strong>{{ $t->total_point }}</strong></p>

                @if($t->status == 'pending')
                    <a href="{{ route('checkout', $t->id) }}" class="checkout-btn">Checkout</a>
                @endif
            </div>
        @empty
            <p>Belum ada transaksi.</p>
        @endforelse
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