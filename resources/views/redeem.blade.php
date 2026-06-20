<!DOCTYPE html>
<html>
<head>
    <style>
        /* (Style ini sama persis dengan profile.blade.php kamu) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        .navbar { background-color: #2c3e50; color: white; padding: 15px 20px; font-weight: bold; position: fixed; top: 0; width: 100%; display: flex; justify-content: space-between; align-items: center; z-index: 100; }
        .navbar .point { background-color: #f39c12; padding: 5px 12px; border-radius: 20px; color: white; text-decoration: none; }
        .layout { display: flex; margin-top: 55px; }
        .sidebar { width: 200px; min-height: calc(100vh - 55px); background-color: #34495e; padding: 20px 0; position: fixed; }
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 14px 20px; color: #ecf0f1; text-decoration: none; }
        .sidebar a.active { background-color: #f39c12; }
        .content { margin-left: 200px; padding: 40px; flex: 1; }
        .card { background: white; padding: 30px; border-radius: 10px; max-width: 400px; border: 1px solid #ddd; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #2c3e50; color: white; border: none; border-radius: 5px; cursor: pointer; }
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
        <a href="/riwayat-transaksi">Transaksi</a>
        <a href="/rewards">Rewards</a>
        <a href="/redeem" class="active">Redeem</a>
        <a href="/membership">Membership</a>
    </div>

    <div class="content">
        <div class="card">
            <h2>Redeem Code</h2>
            @if(session('success')) <p style="color: green;">{{ session('success') }}</p> @endif
            @if(session('error')) <p style="color: red;">{{ session('error') }}</p> @endif
            
            <form action="/redeem" method="POST">
                @csrf
                <input type="text" name="code" placeholder="Masukkan kode redeem" required>
                <button type="submit">Tukar Poin</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>