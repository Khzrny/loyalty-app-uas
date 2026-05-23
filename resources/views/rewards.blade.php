<!DOCTYPE html>
<html>
<head>
    <title>Rewards</title>
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

        button {
            padding: 8px 14px;
            cursor: pointer;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            width: 250px;
        }
    </style>
</head>
<body>

    <h1>Daftar Reward</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>Tambah Reward</h3>

    <form action="{{ route('rewards.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nama Reward" required>
        <br>

        <input type="number" name="point_required" placeholder="Point Dibutuhkan" required>
        <br>

        <button type="submit">Tambah Reward</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Reward</th>
                <th>Point</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rewards as $reward)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reward->name }}</td>
                    <td>{{ $reward->point_required }}</td>
                    <td>
                        <form action="{{ route('redeem.reward', $reward->id) }}" method="POST">
                            @csrf
                            <button type="submit">Redeem</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('redeem.history') }}">
        Lihat Riwayat Redeem
    </a>

</body>
</html>