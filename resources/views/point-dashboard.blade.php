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
        .content { margin-left: 200px; padding: 40px; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .point-card { background-color: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; width: 100%; max-width: 400px; }
        .point-value { font-size: 48px; color: #f39c12; font-weight: bold; margin: 20px 0; }
        .logout-btn { position: fixed; bottom: 20px; right: 20px; }
        .logout-btn button { padding: 8px 16px; background-color: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer; }
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
        <a href="/membership">Membership</a>
    </div>

    <div class="content">
        <div class="point-card">
            <h2>Dashboard Poin</h2>
            <p>Total Poin Anda saat ini adalah:</p>
            <div class="point-value">{{ Auth::user()->point ?? 0 }} Poin</div>
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