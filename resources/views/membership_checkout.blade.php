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
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 14px 20px; color: #ecf0f1; text-decoration: none; font-size: 15px; transition: background 0.2s; }
        .sidebar a:hover { background-color: #2c3e50; }
        .sidebar a.active { background-color: #f39c12; color: white; font-weight: bold; }
        
        .sidebar .divider { border: none; border-top: 1px solid #4a6278; margin: 10px 0; }
        
        .content { margin-left: 200px; padding: 20px; flex: 1; }
        .content h2 { margin-bottom: 15px; color: #2c3e50; }
        
        .card { background: white; padding: 30px; border-radius: 15px; border: 1px solid #ddd; max-width: 400px; }
        .btn-pay { padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 15px; width: 100%; font-size: 16px; }
    </style>
</head>
<body>

<div class="navbar">
    <span>Welcome, {{ Auth::user()->name }}!</span>
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
            <p style="margin: 20px 0;">Total Bayar: <strong>Rp {{ number_format($price) }}</strong></p>
            
            <form action="/membership/pay/{{ $tier }}" method="POST">
                @csrf
                <button type="submit" class="btn-pay">Bayar Sekarang</button>
            </form>
            
            <br>
            <center><a href="/membership" style="color: #666; text-decoration:none;">Batal</a></center>
        </div>
    </div>
</div>

</body>
</html>