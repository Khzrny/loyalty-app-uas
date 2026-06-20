<h1>Tambah Transaksi</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
    @csrf
    
    <div id="input-section">
        <div id="items">
            <div class="item-row">
                <input type="text" name="product_name[]" placeholder="Nama Produk" class="p-name" required>
                <input type="number" name="qty[]" placeholder="Qty" class="p-qty" min="1" required>
                <input type="number" name="price[]" placeholder="Harga" class="p-price" min="0" required>
            </div>
        </div>
        <br>
        <button type="button" onclick="addItem()">+ Tambah Item</button>
        <br><br>
        <button type="button" onclick="showReview()">Review Transaksi</button>
    </div>

    <div id="review-section" style="display:none; border: 1px solid #ccc; padding: 15px; margin-top: 20px;">
        <h3>Konfirmasi Transaksi</h3>
        <div id="review-content"></div>
        <br>
        <button type="submit">Simpan Transaksi</button>
        <button type="button" onclick="hideReview()">Kembali</button>
    </div>
</form>

<script>
function addItem() {
    const container = document.getElementById('items');
    const row = `
        <div class="item-row" style="margin-top:10px;">
            <input type="text" name="product_name[]" placeholder="Nama Produk" class="p-name" required>
            <input type="number" name="qty[]" placeholder="Qty" class="p-qty" min="1" required>
            <input type="number" name="price[]" placeholder="Harga" class="p-price" min="0" required>
        </div>`;
    container.insertAdjacentHTML('beforeend', row);
}

function showReview() {
    const names = document.querySelectorAll('.p-name');
    const qtys = document.querySelectorAll('.p-qty');
    const prices = document.querySelectorAll('.p-price');
    let html = '<ul>';
    
    for(let i=0; i<names.length; i++) {
        html += `<li>${names[i].value} - ${qtys[i].value} x Rp ${prices[i].value}</li>`;
    }
    html += '</ul>';
    
    document.getElementById('review-content').innerHTML = html;
    document.getElementById('input-section').style.display = 'none';
    document.getElementById('review-section').style.display = 'block';
}

function hideReview() {
    document.getElementById('input-section').style.display = 'block';
    document.getElementById('review-section').style.display = 'none';
}
</script>