<!DOCTYPE html>
<html>
<head>
    <title>Reward Saya</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background:#ececec;
        }

        .container{
            display:flex;
            min-height:100vh;
        }

        /* Sidebar */
        .sidebar{
            width:220px;
            background:#2f4761;
            color:white;
            padding-top:20px;
        }

        .sidebar h3{
            text-align:center;
            margin-bottom:30px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 25px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#f39c12;
        }

        .active{
            background:#f39c12;
        }

        /* Content */
        .content{
            flex:1;
        }

        .topbar{
            background:#2f4761;
            color:white;
            padding:15px 25px;
            font-weight:bold;
        }

        .card{
            background:white;
            margin:25px;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        .card h2{
            color:#2f4761;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#2f4761;
            color:white;
        }

        th,td{
            padding:14px;
            text-align:center;
        }

        tbody tr:nth-child(even){
            background:#f8f8f8;
        }

        tbody tr:hover{
            background:#f1f1f1;
        }

        .status{
            background:#f39c12;
            color:white;
            padding:5px 12px;
            border-radius:20px;
            font-size:13px;
        }

        .empty{
            text-align:center;
            padding:30px;
            color:#777;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Kopi Jago</h3>

        <a href="/profile">Home</a>
        <a href="/riwayat-transaksi">Transaksi</a>
        <a href="/rewards" class="active">Rewards</a>
        <a href="/redeem">Redeem</a>
        <a href="/membership">
            <span class="icon"></span> Membership
        </a>
    </div>

    <!-- Content -->
    <div class="content">

        <div class="topbar">
            Reward Saya
        </div>

        <div class="card">

            <h2>Riwayat Reward</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Poin Ditukar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($rewards as $reward)

                    @foreach($reward->details as $detail)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $reward->total_point }} Point</td>

                        <td>
                            <span class="status">
                                {{ ucfirst($reward->status) }}
                            </span>
                        </td>
                    </tr>

                    @endforeach

                @empty

                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada reward yang ditukar.
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>