<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest - Detail Menu<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
    <div class="relative w-screen h-screen flex flex-col bg-[#8C0B40] overflow-x-hidden">
        <img class="w-[216px] h-[216px] absolute top-[-10px] -right-4 " src="<?= base_url('assets/mobile/polygon.svg') ?>" alt="logo" />
        <div class="flex flex-row justify-between items-center my-[15px] mx-[19px] z-10">
            <button onclick="history.back()"><img class="w-[18px] h-[18px]" src="<?= base_url('assets/mobile/back.svg') ?>" alt="logo" /></button>
            <button onclick="window.location.href='<?= base_url('guest/cart') ?>'"><img class="w-[28px] h-[28px]" src="<?= base_url('assets/mobile/mobile-cart-detail.svg') ?>" alt="logo" /></button>
        </div>
        <!-- title -->
        <div class="text-white flex flex-col justify-center px-[25px] gap-[28px]">
            <div class="flex flex-col z-20">
                <p class="font-reguler text-[25px]"><?= $data['Nama_Produk'] ?></p>
                <p class="font-medium text-[10px]"><?= $data['Rasa'] ?></p>
            </div>
            <p><sup class="font-bold text-[13px]">Rp</sup><span class="font-extrabold text-[25px]"><?= number_format($data['Harga'], 0, ',', '.') ?></span></p>
        </div>
        <!-- main content -->
        <div class="relative bg-[#FFFBF0] flex flex-col w-full h-screen mt-[17px] z-10 rounded-t-4xl">
            <!-- rating -->
            <div class="flex space-x-1 mx-[21px] mt-[15px] w-[90px] h-[11px]">
                <?php $rating = $data['Star']?>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $rating): ?>
                        <!-- Filled Stars -->
                        <svg 
                        class="w-6 h-6 text-yellow-500" 
                        fill="currentColor" 
                        viewBox="0 0 20 20" 
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049.927C9.325.293 10.675.293 10.951.927l1.462 2.959 3.265.474c.67.097.94.921.454 1.394L13.6 8.188l.557 3.246c.114.666-.584 1.175-1.17.857L10 10.347l-2.988 1.57c-.586.318-1.284-.191-1.17-.857l.557-3.246-2.533-2.434c-.486-.473-.216-1.297.454-1.394l3.265-.474L9.049.927z" />
                        </svg>
                    <?php else: ?>
                        <!-- Unfilled Stars -->
                        <svg 
                        class="w-6 h-6 text-gray-300" 
                        fill="currentColor" 
                        viewBox="0 0 20 20" 
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049.927C9.325.293 10.675.293 10.951.927l1.462 2.959 3.265.474c.67.097.94.921.454 1.394L13.6 8.188l.557 3.246c.114.666-.584 1.175-1.17.857L10 10.347l-2.988 1.57c-.586.318-1.284-.191-1.17-.857l.557-3.246-2.533-2.434c-.486-.473-.216-1.297.454-1.394l3.265-.474L9.049.927z" />
                        </svg>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <!-- image -->
            <img class="w-[105px] h-[109px] absolute right-10 -top-14 z-20 object-cover rounded-lg" src="<?= base_url('images/' . $data['Gambar_Produk']) ?>" alt="logo" />
            <!-- details items -->
            <div class="flex flex-col gap-4 mx-[21px] mt-[12px] mb-[84px]">
                <p>Details</p>
                <div class="flex flex-row">
                    <p class="font-reguler line-clamp-5 overflow-hidden text-[10px] text-[#696969]"><?= $data['Deskripsi'] ?></p>
                </div>
                <div class="flex flex-row gap-2 items-center">
                    <img class="w-[28px] h-[28px]" src="<?= base_url('assets/mobile/timer.svg') ?>" alt="logo" />
                    <p class="font-light text-[9px] text-[#696969]"><?= $data['Waktu'] ?> mins</p>
                </div>
            </div>
            <!-- button checkout -->
            <div class="w-full flex flex-row justify-center items-center gap-[22px]">
                <div class="flex flex-row gap-3 items-center">
                    <button  id="decrement"><img class="w-[33px] h-[33px]" src="<?=  base_url('assets/mobile/divide.svg') ?>" alt="icon" /></button>
                    <p id="quantity" class="font-bold text-[14px]">1</p>
                    <button id="increment"><img class="w-[33px] h-[33px]" src="<?=  base_url('assets/mobile/add.svg') ?>" alt="icon" /></button>
                </div>
                <div id="add-to-cart" class="flex flex-row gap-[8px] justify-center items-center w-[148px] h-[37px] rounded-2xl bg-[#8C0B40]"
                    data-produk_id="<?= $data['Produk_id'] ?>"
                    data-nama_produk="<?= $data['Nama_Produk'] ?>"
                    data-gambar_produk="<?= $data['Gambar_Produk'] ?>"
                    data-rasa="<?= $data['Rasa'] ?>"
                    data-harga="<?= $data['Harga'] ?>"
                >
                    <p class="font-bold text-[12px] text-white">Add to Cart</p>
                    <img class="w-[16px] h-[16px]" src="<?= base_url('assets/next.svg') ?>" alt="logo" />
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
  let quantity = parseInt($('#quantity').text()) || 1;

  // Event handler untuk tombol decrement
  $('#decrement').on('click', function() {
    if (quantity > 1) {
      quantity--;
      $('#quantity').text(quantity);
    }
  });

  // Event handler untuk tombol increment
  $('#increment').on('click', function() {
    quantity++;
    $('#quantity').text(quantity);
  });

  // Event handler untuk tombol Add to Cart
  $('#add-to-cart').on('click', function() {
    const productId = $(this).data('produk_id');
    const namaProduk = $(this).data('nama_produk');
    const gambarProduk = $(this).data('gambar_produk');
    const rasa = $(this).data('rasa');
    const harga = $(this).data('harga');

    let orders = JSON.parse(localStorage.getItem('orders')) || [];
    const existingProductIndex = orders.findIndex(item => item.Produk_id === productId);

    if (existingProductIndex !== -1) {
      orders[existingProductIndex].Quantity += quantity;
    } else {
      orders.push({
        Produk_id: productId,
        Quantity: quantity,
        Nama_Produk: namaProduk,
        Gambar_Produk: gambarProduk,
        Rasa: rasa,
        Harga: harga
      });
    }

    localStorage.setItem('orders', JSON.stringify(orders));
    alert('Produk telah ditambahkan ke cart!');
  });
});
</script>
<?= $this->endSection() ?>
