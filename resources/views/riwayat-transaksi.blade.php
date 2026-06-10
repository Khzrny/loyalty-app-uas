<h1>Riwayat Transaksi</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@forelse($transaksi as $t)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">
        <p>Transaksi #{{ $t->id }} — {{ $t->created_at->format('d M Y') }} — <strong>{{ ucfirst($t->status) }}</strong></p>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th>
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
        <p>Total: Rp {{ number_format($t->total_price, 0, ',', '.') }}</p>
        <p>Point: {{ $t->total_point }}</p>

        @if($t->status == 'pending')
            <a href="{{ route('checkout', $t->id) }}">
                <button>Checkout</button>
            </a>
        @endif
    </div>
@empty
    <p>Belum ada transaksi.</p>
@endforelse