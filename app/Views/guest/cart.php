<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest - cart<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<!-- <img src="<?= base_url('assets/mobile/ ') ?>" alt="icon" /> -->
<div class="relative w-screen h-screen flex flex-col bg-[#FFFBF0] overflow-x-hidden px-[21px] py-[25px]">
    <div class="flex flex-row justify-between mb-[12px]">
        <button onclick="window.location.href='<?= base_url('guest') ?>'">
            <img class="w-[18px] h-[18px]" src="<?= base_url('assets/mobile/back-gray.svg') ?>" alt="logo" />
        </button>
        <button>
            <img class="w-[28px] h-[28px]" src="<?= base_url('assets/mobile/cart-list.svg') ?>" alt="logo" />
        </button>
    </div>
    <!-- title -->
    <div class="flex flex-col mb-[18px]">
        <p class="font-bold text-[15px]">Cart List</p>
        <p id="cart-count" class="font-medium text-[9px] text-gray-400">All (0) items in cart</p>
    </div>
    <!-- list item -->
    <div id="cart-list" class="pl-2 pt-2 overflow-y-auto flex flex-col gap-[12px] items-center w-full h-[291px]">
         <!-- Cart items akan di-render di sini oleh jQuery -->
    </div>
    <!-- <div class="pl-2 pt-2 overflow-y-auto flex flex-col gap-[12px] items-center w-full h-[291px]">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="relative flex flex-row gap-[12px] w-full">
                <img class="absolute -top-2 -left-2 w-[24px] h-[24px] z-10" src="<?= base_url('assets/mobile/close-button.svg ') ?>" alt="icon" />
                <img class="w-[57px] h-[59px] rounded-lg object-cover z-0" src="<?= base_url('images/sample-food.png') ?>" />
                <div class="flex flex-row justify-between w-full">
                    <div class="flex flex-col gap-[10px]">
                        <div>
                            <p class="font-medium text-[12px]">Name Item Here</p>
                            <p class="font-reguler text-[10px]">spicy, salty, fresh</p>
                        </div>
                        <div class="relative flex flex-row text-[#D49D55]">
                            <sup class="absolute top-1 text-[6px]">Rp </sup><p class="pl-2 font-bold text-[14px]">25.000</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-[5px] items-center">
                        <img class="w-[14px] h-[14px] z-10" src="<?= base_url('assets/mobile/add.svg ') ?>" alt="icon" />
                        <p class="font-bold text-[7px]">1</p>
                        <img class="w-[14px] h-[14px] z-10" src="<?= base_url('assets/mobile/divide.svg ') ?>" alt="icon" />
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div> -->
    <!-- button -->
    <button id="confirm_order" class="mt-[40px] py-[11px] px-[17px] flex flex-row justify-center items-center rounded-4xl bg-[#8C0B40] text-white font-bold">
        <p class="text-[8px] pr-[9px]">Amount</p>
        <p id="total-amount" class="text-[14px] pr-[50px]">Rp0</p>
        <p class="text-[12px] pr-[4px]">Proceed</p>
        <img src="<?= base_url('assets/mobile/next-thin.svg') ?>" alt="icon">
    </button>
</div>
<script>
let orders = JSON.parse(localStorage.getItem('orders')) || [];
$(document).ready(function() {
  function updateCartCount() {
    // Total item adalah jumlah dari masing-masing quantity
    const totalItems = orders.reduce((sum, item) => sum + item.Quantity, 0);
    $('#cart-count').text(`All (${totalItems}) items in cart`);
  }

  function updateTotalAmount() {
    let total = orders.reduce((sum, item) => {
      return sum + (parseInt(item.Harga) * item.Quantity);
    }, 0);

    total = total.toLocaleString('id-ID', { minimumFractionDigits: 0 });

    $('#total-amount').text(`Rp${total}`);
  }

  function renderCartList() {
    const $cartList = $('#cart-list');
    $cartList.empty();

    orders.forEach(function(item, index) {
      const orderHtml = `
        <div class="relative flex flex-row gap-[12px] w-full" data-index="${index}">
          <img class="absolute -top-2 -left-2 w-[24px] h-[24px] z-10 close-btn" src="<?= base_url('assets/mobile/close-button.svg') ?>" alt="icon" />
          <img class="w-[57px] h-[59px] rounded-lg object-cover z-0" src="<?= base_url('images/sample-food.png') ?>" alt="product image" />
          <div class="flex flex-row justify-between w-full">
            <div class="flex flex-col gap-[10px]">
              <div>
                <p class="font-medium text-[11px]">${item.Nama_Produk}</p>
                <p class="font-reguler text-[7px] text-gray-500">${item.Rasa}</p>
              </div>
              <div class="relative flex flex-row text-[#D49D55]">
                <sup class="absolute top-1 text-[6px]">Rp </sup>
                <p class="pl-2 font-bold text-[14px]">
                  ${parseInt(item.Harga).toLocaleString('id-ID', { minimumFractionDigits: 0 })}
                </p>
              </div>
            </div>
            <div class="flex flex-col gap-[5px] items-center">
              <img class="w-[14px] h-[14px] z-10 plus-btn" src="<?= base_url('assets/mobile/add.svg') ?>" alt="plus icon" />
              <p class="font-bold text-[7px] quantity-display">${item.Quantity}</p>
              <img class="w-[14px] h-[14px] z-10 minus-btn" src="<?= base_url('assets/mobile/divide.svg') ?>" alt="minus icon" />
            </div>
          </div>
        </div>
      `;
      $cartList.append(orderHtml);
    });

    updateTotalAmount();
    updateCartCount();
  }

  renderCartList();

  // Event handler: Tombol plus pada tiap item untuk menambah quantity
  $('#cart-list').on('click', '.plus-btn', function() {
    const $orderItem = $(this).closest('[data-index]');
    const index = $orderItem.data('index');
    orders[index].Quantity++;
    localStorage.setItem('orders', JSON.stringify(orders));
    $orderItem.find('.quantity-display').text(orders[index].Quantity);
    updateTotalAmount();
    updateCartCount();
  });

  // Event handler: Tombol minus untuk mengurangi quantity (minimal 1)
  $('#cart-list').on('click', '.minus-btn', function() {
    const $orderItem = $(this).closest('[data-index]');
    const index = $orderItem.data('index');
    if (orders[index].Quantity > 1) {
      orders[index].Quantity--;
      localStorage.setItem('orders', JSON.stringify(orders));
      $orderItem.find('.quantity-display').text(orders[index].Quantity);
      updateTotalAmount();
      updateCartCount();

    }
  });

  $('#cart-list').on('click', '.close-btn', function() {
    const $orderItem = $(this).closest('[data-index]');
    const index = $orderItem.data('index');
    orders.splice(index, 1);
    localStorage.setItem('orders', JSON.stringify(orders));
    renderCartList();
  });
});

var base_url = "<?= base_url(); ?>";
$('#confirm_order').on('click', function() {
  var transformedOrders = orders.map(function(item) {
    return {
      id: item.Produk_id,
      quantity: item.Quantity,
      Nama_Produk: item.Nama_Produk,
      Rasa: item.Rasa,
      Harga: item.Harga
    };
  });
  
  $.ajax({
    url: '/kasir/create_order',
    type: 'POST',
    data: JSON.stringify(transformedOrders ),
    contentType: 'application/json',
    dataType: 'json',
    success: function(response) {
      localStorage.removeItem("orders");
      alert('Order berhasil diproses');
      const url = base_url + 'guest/receipt?order_id=' + encodeURIComponent(response.order_id);
      window.location.href = url;
    },
    error: function(xhr, status, error) {
      alert('Terjadi kesalahan saat membuat orders..');
      console.error('Terjadi kesalahan:', error);
    }
  })
})
</script>
<?= $this->endSection() ?>