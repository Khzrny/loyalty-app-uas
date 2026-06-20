<!DOCTYPE html>
<html>
<head>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        
        .navbar { background-color: #2c3e50; color: white; padding: 15px 20px; font-size: 18px; font-weight: bold; display: flex; justify-content: space-between; align-items: center; position: fixed; top: 0; left: 0; right: 0; z-index: 100; }
        .navbar .point { font-size: 16px; background-color: #f39c12; padding: 5px 12px; border-radius: 20px; color: white; text-decoration: none; }
        
        .layout { display: flex; margin-top: 55px; }
        .sidebar { width: 200px; min-height: calc(100vh - 55px); background-color: #34495e; padding: 20px 0; position: fixed; top: 55px; left: 0; }
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 14px 20px; color: #ecf0f1; text-decoration: none; font-size: 15px; }
        .sidebar a.active { background-color: #f39c12; color: white; font-weight: bold; }
        .divider { border: none; border-top: 1px solid #4a6278; margin: 10px 0; }
        
        .content { margin-left: 200px; padding: 40px; flex: 1; }
        .card { background: white; padding: 30px; border-radius: 15px; border: 1px solid #ddd; max-width: 500px; }
        .btn-pay { padding: 12px 25px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 20px; width: 100%; }
    </style>
</head>
<body>

<div class="navbar">
    <span>Konfirmasi Pembayaran</span>
    <a href="/points" class="point">Point: {{ Auth::user()->point ?? 0 }}</a>
</div>

<div class="layout">
    <div class="sidebar">
        <a href="/profile">Home</a>
        <hr class="divider">
        <a href="/riwayat-transaksi">Transaksi</a>
        <a href="/rewards">Rewards</a>
        <a href="/redeem">Redeem</a>
        <a href="/membership" class="active">Membership</a>
    </div>

    <div class="content">
        <div class="card">
            <h2>Konfirmasi Paket {{ $tier }}</h2>
            <p style="margin: 20px 0;">Anda akan berlangganan paket <strong>{{ $tier }}</strong>.</p>
            <p style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">
                Total: Rp {{ number_format($price, 0, ',', '.') }}
            </p>

            <form action="/process-payment/{{ $tier }}" method="POST">
                @csrf
                <button class="btn-pay" type="submit">Bayar & Aktifkan</button>
            </form>
            
            <br>
            <center><a href="/membership" style="color: #666; text-decoration:none;">Batal</a></center>
        </div>
    </div>
</div>

</body>
</html>