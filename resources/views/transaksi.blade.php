<h1>Tambah Transaksi</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div id="items">
        <div class="item-row">
            <input type="text" name="product_name[]" placeholder="Nama Produk" required>
            <input type="number" name="qty[]" placeholder="Qty" min="1" required>
            <input type="number" name="price[]" placeholder="Harga" min="0" required>
        </div>
    </div>
    <br>
    <button type="button" onclick="addItem()">+ Tambah Item</button>
    <br><br>
    <button type="submit">Simpan Transaksi</button>
</form>

<script>
function addItem() {
    const container = document.getElementById('items');
    const row = `
        <div class="item-row">
            <input type="text" name="product_name[]" placeholder="Nama Produk" required>
            <input type="number" name="qty[]" placeholder="Qty" min="1" required>
            <input type="number" name="price[]" placeholder="Harga" min="0" required>
        </div>`;
    container.insertAdjacentHTML('beforeend', row);
}
</script>