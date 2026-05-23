<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Redeem</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Riwayat Redeem</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Reward</th>
                <th>Point Digunakan</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($redeems as $redeem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $redeem->user_name }}</td>
                    <td>{{ $redeem->reward->name }}</td>
                    <td>{{ $redeem->points_used }}</td>
                    <td>{{ $redeem->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('rewards.index') }}">
        Kembali ke Rewards
    </a>

</body>
</html>