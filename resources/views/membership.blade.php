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
        .tiers-container { display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap; }
        .tier-box { flex: 1; min-width: 250px; padding: 30px; border-radius: 15px; text-align: center; background: white; border: 2px solid #ddd; }
        .tier-active { border-color: #f39c12; background: #fffdf0; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        button.subscribe-btn { padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 15px; }
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
        <h2>Pilih Paket Langganan Kamu</h2>
        
        <div class="tiers-container">
            <div class="tier-box {{ Auth::user()->membership_level == 'Bronze' ? 'tier-active' : '' }}">
                <h3>Bronze</h3>
                <p>Rp 0 / bulan</p>
                <p>Fitur Standar</p>
                @if(Auth::user()->membership_level == 'Bronze') <strong style="color: #f39c12; display:block; margin-top:10px;">Aktif</strong> @endif
            </div>

            <div class="tier-box {{ Auth::user()->membership_level == 'Silver' ? 'tier-active' : '' }}">
                <h3>Silver</h3>
                <p>Rp 50.000 / bulan</p>
                <p>Fitur Lebih Lengkap</p>
                @if(Auth::user()->membership_level !== 'Silver')
                    <form action="/subscribe/Silver" method="POST">
                        @csrf
                        <button class="subscribe-btn" type="submit">Berlangganan</button>
                    </form>
                @else
                    <strong style="color: #f39c12; display:block; margin-top:10px;">Aktif</strong>
                @endif
            </div>

            <div class="tier-box {{ Auth::user()->membership_level == 'Gold' ? 'tier-active' : '' }}">
                <h3>Gold</h3>
                <p>Rp 100.000 / bulan</p>
                <p>Fitur VIP & Cashback</p>
                @if(Auth::user()->membership_level !== 'Gold')
                    <form action="/subscribe/Gold" method="POST">
                        @csrf
                        <button class="subscribe-btn" type="submit">Berlangganan</button>
                    </form>
                @else
                    <strong style="color: #f39c12; display:block; margin-top:10px;">Aktif</strong>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>