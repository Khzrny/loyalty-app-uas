<!DOCTYPE html>
<html>
<head>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }

        .navbar {
            background: #2c3e50;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .layout { display: flex; margin-top: 0; }

        .sidebar {
            width: 200px;
            min-height: 100vh;
            background: #34495e;
            padding: 20px 0;
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: #ecf0f1;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar a:hover { background: #2c3e50; }
        .sidebar a.active { background: #f39c12; font-weight: bold; }

        .content { flex: 1; padding: 20px; }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 { font-size: 14px; color: #777; margin-bottom: 8px; }
        .card p { font-size: 32px; font-weight: bold; color: #2c3e50; }

        table { width: 100%; border-collapse: collapse; background: white;
                border-radius: 10px; overflow: hidden;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        th { background: #2c3e50; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>

<div class="navbar">
    <span>👑 Admin Dashboard</span>
    <span>{{ Auth::user()->name }}</span>
</div>

<div class="layout">
    <div class="sidebar">
        <a href="/admin" class="active">📊 Dashboard</a>
        <a href="/admin/laporan">📋 Laporan</a>
        <a href="/profile">👤 Profile</a>
    </div>

    <div class="content">
        <h2 style="margin-bottom:20px; color:#2c3e50;">Overview</h2>

        <div class="card-grid">
            <div class="card">
                <h3>Total User</h3>
                <p>{{ $totalUsers }}</p>
            </div>
            <div class="card">
                <h3>Total Transaksi</h3>
                <p>0</p>
            </div>
            <div class="card">
                <h3>Total Reward</h3>
                <p>0</p>
            </div>
        </div>

        <h3 style="margin-bottom:10px; color:#2c3e50;">Daftar User</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role ?? 'user' }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>