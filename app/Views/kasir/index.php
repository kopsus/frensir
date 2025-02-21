<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Kasir<?= $this->endSection() ?>
<?= $this->section('styles') ?>
<style>
    /* For WebKit browsers */
    ::-webkit-scrollbar {
        width: 6px; /* Vertical scrollbar width */
        height: 6px; /* Horizontal scrollbar height */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #a0aec0; /* Tailwind's gray-400 */
        border-radius: 3px;
    }

    ::-webkit-scrollbar-track {
        background-color: #edf2f7; /* Tailwind's gray-200 */
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
    <div class="relative flex flex-row max-h-screen">
        <div class="flex flex-col gap-[15px] justify-center items-center h-screen bg-[#FFFBF0]">
            <button type="button" class="cursor-pointer" onclick="window.location.href='<?= base_url('kasir/menu-list') ?>'" >
                <img src="<?= base_url('assets/menu-kasir.svg') ?>" alt="icon" />
            </button>
            <form action="<?= base_url('/logout') ?>" method="post">
                <button type="submit">
                    <div class="hover:cursor-pointer w-[66px] h-[311px] bg-[#8C0B40] rounded-r-lg flex flex-col items-center justify-center text-[34px] text-white font-medium">
                        <p>E</p>
                        <p>X</p>
                        <p>I</p>
                        <p>T</p>
                        <img class="w-[30px] h-[30px] mt-[30px]" src="<?= base_url('assets/leave.svg') ?>" alt="icon" />
                    </div>
                </button>
            </form>
        </div>
        <div class="w-full bg-[#FFFBF0] flex flex-col gap-[31px] pt-[63px] pl-[55px]">
            <!-- header -->
            <div class="relative flex flex-row justify-between items-center w-full pr-[70px]">
                <img src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" class="w-[108px] h-[52px]"/>
                <div class="flex flex-row justify-between w-[474px] h-[45px] gap-5">
                    <div class="w-[323px] relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                        <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                        <input class="outline-none" id="search" name="search" type="text" placeholder="Search menu..." />
                    </div>
                    <button id="take_order_button" class="hover:cursor-pointer w-[140px] h-[45px] items-center font-bold text-white bg-[#8C0B40] rounded-lg">Take Order</button>
                </div>
            </div>
            <!-- nav -->
            <div class="w-[776px] h-[63px] flex flex-row gap-[34px]">
                <?php $isAllActive = empty($currentCategoryId) ? 'bg-[#BFB89E] text-white' : 'bg-[#F8F8F8]'; ?>
                <div class="category-filter hover:cursor-pointer flex flex-row items-center gap-[20px] h-full w-[144px] rounded-2xl <?= $isAllActive ?> font-semibold px-[10px]" data-category="all">
                    <img class="w-[47px] h-[47px]" src="<?= base_url('assets/all-food.svg') ?>" alt="icon"/>
                    <p>All</p>
                </div>
                <?php foreach ($categories as $category): ?>
                    <?php $isActive = (isset($currentCategoryId) && $currentCategoryId == $category['Category_id']) ? 'bg-[#BFB89E] text-white' : 'bg-[#F8F8F8]'; ?>
                    <div class="category-filter hover:cursor-pointer flex flex-row items-center gap-[20px] h-full min-w-[144px] rounded-2xl text-nowrap <?= $isActive ?> font-semibold px-[10px]" data-category="<?= $category['Category_id'] ?>">
                        <?php
                        $svg = '';
                        if ($category['Category_name'] === 'Food') {
                            $svg = 'food.svg';
                        } else if ($category['Category_name'] === 'Drink') {
                            $svg = 'drink.svg';
                        } else if ($category['Category_name'] === 'Side Dish') {
                            $svg = 'sidedish.svg';
                        }
                        ?>
                        <img class="w-[47px] h-[47px]" src="<?= base_url('assets/' . $svg) ?>" alt="icon"/>
                        <p><?= $category['Category_name'] ?></p>
                    </div>
                <?php endforeach; ?>     
            </div>
            <!-- items -->
            <div class="overflow-x-hidden overflow-y-auto grid grid-cols-6 md:grid-cols-4 gap-32  w-full pr-[72px] max-h-[684px]">
                <?php foreach ($menus as $menu): ?>
                    <div class="menu-item hover:cursor-pointer w-[204px] bg-[#FBFBFB] flex flex-col px-[10px] pt-[10px] pb-[18px] min-h-[236px]"
                        data-id="<?= $menu['Produk_id'] ?>"
                        data-name="<?= $menu['Nama_Produk'] ?>"
                        data-price="<?= $menu['Harga'] ?>"
                        data-description="<?= $menu['Rasa'] ?>"
                        data-image="<?= base_url('images/') . $menu['Gambar_Produk'] ?>"
                        data-category="<?= $menu['Category_id'] ?>"
                    >
                        <img class="w-[184px] h-[129px] object-cover drop-shadow-xl flex rounded-2xl" src="<?= base_url('images/') . $menu['Gambar_Produk'] ?>" alt="icon"/>
                        <div class="items-start">
                            <p class="nama-produk line-clamp-1 font-medium text-[18px] mt-[16px] mb-[10px]"><?= $menu['Nama_Produk'] ?></p>
                            <p><span class="font-extrabold text-[14px] text-[#8C0B40]">Rp.<?= number_format($menu['Harga'], 0, ',', '.') ?></span><span class="text-[14px] font-semibold text-[#B2AB90]">/pc</span></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="w-2/5 bg-[#EAE1C0] max-w-[500px] h-full flex flex-col ">
            <!-- cart view -->
            <div class="relative min-h-screen">
                <div class="pt-10 pb-5 px-4">
                    <div class="absolute top-10 left-0 w-[203px] bg-[#FFFBF0] h-[49px] content-center text-center rounded-r-lg">
                        <p class="relative font-bold text-[18px]">Current Order</p>
                    </div>
                    <div id="list_items" class="relative z-30 overflow-x-hidden overflow-y-auto mt-[84px] h-[696px] whitespace-normal">
                        <!-- orders akan dirender di sini -->
                        <div id="orders_container">
                            <div class="relative flex w-full flex-col gap-4 rounded-t-2xl bg-[#FFFBF0] px-4 pt-4">
                                <div class="flex flex-row gap-4"></div>
                            </div>
                            <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4 h-[400px]">
                                <div class="flex flex-row gap-4">
                                    <div class="flex w-2/1 flex-col">
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <!-- (4) total items -->
                            <div class="w-full bg-white flex flex-col gap-3 rounded-b-2xl">
                                <div class="flex flex-row w-full justify-between font-semibold pt-4 px-20">
                                    <p>Subtotal</p>
                                    <p id="subtotal">Rp0</p>
                                </div>
                                <div class="flex flex-row w-full justify-between font-semibold px-20">
                                    <p>Total Sales Tax</p>
                                    <p id="tax">Rp0</p>
                                </div>
                                <div class="relative h-10">
                                    <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EEECE9] z-10"></div>
                                    <div class="absolute w-full bottom-5 flex items-center justify-center">
                                        <div class="w-full border border-dashed border-[#EAE1C0]"></div>
                                    </div>
                                    <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EEECE9] z-10"></div>
                                </div>
                                <div class="flex justify-between h-12 px-20 font-bold text-[16px] rounded-2xl">
                                    <p>Total</p>
                                    <p id="final_total">Rp0</p>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="flex justify-center items-center relative z-30">
                    <div id="confirm_order" class="hover:cursor-pointer bg-[#8C0B40] rounded-lg flex flex-row justify-center items-center gap-[14px] w-[305px] mt-[27px] w-[120px] h-[45px]">
                        <a class="items-center font-bold text-white">Confirm Order</a>
                        <img class="w-[25px] h-[25px]"src="<?= base_url('assets/next.svg') ?>" alt="icon" />
                    </div>
                </div>
                <div class="z-10 absolute bottom-0 left-0 rounded-t-3xl w-full bg-[#EEECE9] h-[400px]"></div>
            </div>
            <!-- end cart view -->
        </div>
    </div>
<!-- modal detail menus -->
<div 
    class="fixed antialiased inset-0 bg-stone-200/60 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300 ease-out z-[9999]" 
    id="modal" 
    aria-hidden="true"
>
    <div class="relative items-center bg-[#FFFBF0] rounded-lg w-[458px] h-[537px] scale-95 transition-transform duration-300 ease-out flex flex-col pt-[67px] pb-[55px] px-[70px]">
        <div class="relative pl-[83px] items-center flex flex-row w-full mb-[30px]">
            <p class="font-bold text-[24px]">Menu Detail</p>
            <img class="absolute right-0" src="<?= base_url("assets/menu-detail-icon.svg") ?>" alt="icon" />
        </div>
        <img id="modalImage" class="w-[165px] h-[165px] rounded-lg object-cover mb-[4px]" src="<?= base_url('images/sample-food.png') ?>" alt="icon"/>
        <p id="modalProductName" class="font-semibold text-[22px]">Big Burgers</p>
        <p id="modalDescription" class="font-medium text-[11px] text-[#72716D] mb-[42px]">spicy, salty</p>
        <p id="modalPrice" class="font-extrabold text-[22px] text-[#8C0B40]">Rp25.000</p>
        <li id="totalPrice" class="font-extrabold text-[#F4C78A] text-[15px] mb-[15px]">25.000</li>
        <div class="w-full flex flex-row justify-center items-center gap-[22px]">
            <div class="flex flex-row gap-3 items-center">
                <button id="divide"><img class="w-[33px] h-[33px] hover:cursor-pointer " src="<?=  base_url('assets/mobile/divide.svg') ?>" alt="icon" /></button> 
                <p id="totalItems" class="font-bold text-[14px]">1</p> 
                <button id="increase"><img class="w-[33px] h-[33px] hover:cursor-pointer " src="<?=  base_url('assets/mobile/add.svg') ?>" alt="icon" /></button> 
            </div>
            <div id="addorder" class="hover:cursor-pointer flex flex-row gap-[8px] justify-center items-center w-[148px] h-[37px] rounded-xl bg-[#8C0B40]">
                <p class="font-bold text-[12px] text-white">Add Order</p> 
                <img class="w-[16px] h-[16px]" src="<?= base_url('assets/next.svg') ?>" alt="logo" />
            </div>
        </div>
    </div>
</div>
<!-- end detail menus -->

<!-- modal take order -->
<div 
    class="fixed antialiased inset-0 bg-stone-200/60 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300 ease-out z-[9999]" 
    id="modal_take_order" 
    aria-hidden="true"
>
    <div class="relative bg-[#FFFBF0] rounded-lg w-[458px] h-[380px] scale-95 transition-transform duration-300 ease-out flex flex-col">
        <p class="mt-[42px] mb-[44px] px-[33px] py-[13px] text-[22px] text-white bg-[#8C0B40] flex items-center justify-center w-[293px] h-[53px]">Take Customer Order</p>
        <div class="flex flex-col justify-center">
            <div class="flex flex-row gap-1 items-center px-[75px]">
                <img class="w-[24px] h-[24px]" src="<?= base_url('assets/order-fills.svg') ?>" alt="icon">
                <p class="font-semibold text-[20px] text-[#8C0B40]">Order Code</p>
            </div>
            <div class="flex items-center px-[14px] mx-[75px] mt-[8px] h-[49px] border border-[#8C0B40] rounded-lg mb-[56px]">
                <input class="outline-none w-full h-[21px] items-center" id="order_code" name="order_code" type="text" placeholder="#FF22334">
            </div>
            <div class="flex flex-row w-full gap-[37px] items-center justify-center">
                <button id="modal_take_order_submit" class="hover:cursor-pointer bg-[#8C0B40] rounded-lg text-white text-[21px] font-semibold py-[11px] px-[41px]">Submit</button>
                <button onclick="hideModal()" class="hover:cursor-pointer bg-[#8C0B40] rounded-lg text-white text-[21px] font-semibold py-[11px] px-[41px]">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal take order -->

<!-- modal add customer name -->
<div 
    class="fixed antialiased inset-0 bg-stone-200/60 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300 ease-out z-[9999]" 
    id="modal_customer_name" 
    aria-hidden="true"
>
    <div class="relative bg-[#FFFBF0] rounded-lg w-[458px] h-[380px] scale-95 transition-transform duration-300 ease-out flex flex-col">
        <p class="mt-[42px] mb-[44px] px-[33px] py-[13px] text-[22px] text-white bg-[#8C0B40] flex items-center justify-center w-[293px] h-[53px]">Take Customer Order</p>
        <div class="flex flex-col justify-center">
            <div class="flex flex-row gap-1 items-center px-[75px]">
                <img class="w-[20ox] h-[20px]" src="<?= base_url('assets/user-fill.svg') ?>" alt="icon">
                <p class="font-semibold text-[20px] text-[#8C0B40]">Name</p>
            </div>
            <div class="flex items-center px-[14px] mx-[75px] mt-[8px] h-[49px] border border-[#8C0B40] rounded-lg mb-[56px]">
                <input class="outline-none active:outline-none w-full h-[21px] items-center" id="name_order" name="name_order" type="text" placeholder="Frendi Anton">
            </div>
            <div class="flex flex-row w-full gap-[37px] items-center justify-center">
                <button class="hover:cursor-pointer bg-[#8C0B40] rounded-lg text-white text-[21px] font-semibold py-[11px] px-[41px]">Submit</button>
                <button onclick="hideModal()" class="hover:cursor-pointer bg-[#8C0B40] rounded-lg text-white text-[21px] font-semibold py-[11px] px-[41px]">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal add customer name -->


<script>
// filtering search
$(document).ready(function(){
    $('#search').on('keyup', function(){
        var searchTerm = $(this).val().toLowerCase();
        $('div#body').each(function(){
            var namaProduk = $(this).find('p#Nama_Produk').text().toLowerCase();
            if(namaProduk.indexOf(searchTerm) !== -1){
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    var selectedCategory = "all";
    $('.category-filter').on('click', function() {
        $('.category-filter').removeClass('bg-[#BFB89E] text-white').addClass('bg-[#F8F8F8]');
        $(this).removeClass('bg-[#F8F8F8]').addClass('bg-[#BFB89E] text-white');

        selectedCategory = $(this).data('category');

        $('.menu-item').each(function() {
            var itemCategory = $(this).data('category');

            if (selectedCategory === "all" || selectedCategory == itemCategory) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // handle take order
    $('#modal_take_order_submit').on('click', function(e){
        e.preventDefault();
        var orderCode = $('#order_code').val().trim();
        if(orderCode === ''){
            alert('Masukkan order code!');
            return;
        }
        $.ajax({
            url: "kasir/take_order",
            type: "POST",
            dataType: "json",
            data: { order_code: orderCode },
            success: function(response) {
                console.log("Response AJAX:", response);
                if(response.redirect){
                    window.location.href = 'kasir/'+response.redirect+'?order_id='+response.order_id;
                } else {
                    alert(response.error || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error){
                console.error("AJAX Error:", error);
                console.log("Response Text:", xhr.responseText);
            }
        });
    });
});
</script>
<script>
let orders = []
let currentMenuId = null;
let currentMenuPrice = 0;

// Fungsi untuk membuka modal
function showModal($type) {
    const modal = document.getElementById($type);
    if (modal) {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
    }
}

// Fungsi untuk menyembunyikan modal (jika diperlukan)
function hideModal() {
  document.querySelectorAll('#modal, #modal_take_order, #modal_customer_name').forEach(modal => {
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
  });
}

document.querySelectorAll('#modal, #modal_take_order, #modal_customer_name').forEach(modal => {
  modal.addEventListener('click', function(e) {
    if (e.target === this) {
      hideModal();
    }
  });
});

// Event listener untuk setiap item menu
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function(){
        currentMenuId = this.dataset.id;
        const name = this.dataset.name;
        const price = this.dataset.price;
        const description = this.dataset.description;
        const image = this.dataset.image;

        currentMenuPrice = Number(price);

        document.getElementById('modalProductName').innerText = name;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalPrice').innerText = currentMenuPrice.toLocaleString('id-ID');
        document.getElementById('modalImage').src = image;
        
        document.getElementById('totalItems').innerText = 1;
        updateTotalPrice();
        showModal('modal');
    });
});

document.getElementById('take_order_button').addEventListener('click', function(){
    showModal('modal_take_order');
});

// Event listener untuk tombol increase
document.getElementById('increase').addEventListener('click', function(){
    const totalItemsEl = document.getElementById('totalItems');
    let total = parseInt(totalItemsEl.innerText);
    totalItemsEl.innerText = total + 1;
    updateTotalPrice();
});

// Event listener untuk tombol divide
document.getElementById('divide').addEventListener('click', function(){
    const totalItemsEl = document.getElementById('totalItems');
    let total = parseInt(totalItemsEl.innerText);
    if(total > 1) {
        totalItemsEl.innerText = total - 1;
        updateTotalPrice();
    }
});

function updateTotalPrice(){
    const totalItemsEl = document.getElementById('totalItems');
    let quantity = parseInt(totalItemsEl.innerText);
    let totalPrice = currentMenuPrice * quantity;
    document.getElementById('totalPrice').innerText = totalPrice.toLocaleString('id-ID');
}

// Event listener untuk tombol addorder
document.getElementById('addorder').addEventListener('click', function(){
    const order = {
        id: currentMenuId,
        name: document.getElementById('modalProductName').innerText,
        image: document.getElementById('modalImage').src,
        price: parsePrice(document.getElementById('modalPrice').innerText),
        total_price: parsePrice(document.getElementById('totalPrice').innerText),
        quantity: parseInt(document.getElementById('totalItems').innerText)
    };

    // Cari apakah order dengan id yang sama sudah ada di variabel orders
    const existingOrderIndex = orders.findIndex(o => o.id === order.id);
    if (existingOrderIndex !== -1) {
        orders[existingOrderIndex].total_price = parsePrice(orders[existingOrderIndex].total_price) + parsePrice(order.total_price);
        orders[existingOrderIndex].quantity += order.quantity;
    } else {
        orders.push(order);
    }
    renderCart();
    updateTotals();
    hideModal();
});

function parsePrice(priceStr) {
    if (priceStr == null) return 0;
    if (typeof priceStr !== 'string') {
        priceStr = String(priceStr);
    }
    return Number(priceStr.replace(/[^0-9]/g, ''));
}


// render cart
function renderCart() {
  const ordersContainer = document.getElementById('orders_container');

  if (!orders || orders.length === 0) {
    const defaultHTML = `
      <div class="relative flex w-full flex-col gap-4 rounded-t-2xl bg-[#FFFBF0] px-4 pt-4">
          <div class="flex flex-row gap-4"></div>
      </div>
      <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4 h-[400px]">
          <div class="flex flex-row gap-4">
              <div class="flex w-2/1 flex-col">
              </div>
          </div>
      </div>`;
    ordersContainer.innerHTML = defaultHTML;
    return;
  }

  ordersContainer.innerHTML = '';

  // Render setiap order dari array global orders
  orders.forEach((order, index) => {
    // Format harga menggunakan Intl.NumberFormat
    const formattedPrice = new Intl.NumberFormat('id-ID').format(order.price);
    const formattedTotalPrice = new Intl.NumberFormat('id-ID').format(order.total_price);
    let itemHTML = '';

    if (index === 0) {
      itemHTML = `
      <div class="relative flex w-full flex-col gap-4 rounded-t-2xl bg-[#FFFBF0] px-4 pt-4">
          <div class="flex flex-row gap-4">
              <div class="w-2/4 place-items-center">
                  <img class="w-[67px] h-[67px] object-cover rounded-lg" src="${order.image}" />
              </div>
              <div class="flex w-2/1 flex-col">
                  <div class="mb-6 flex w-full justify-between font-semibold">
                      <p>${order.name}</p>
                      <img onclick="removeOrder('${order.id}')" class="w-[18px] h-[18px] hover:cursor-pointer" src="<?= base_url('assets/mobile/close-red.svg') ?>" alt="icon"/>
                  </div>
                  <div class="relative flex flex-row">
                      <p>
                          <span class="font-bold text-[#8C0B40]">Rp${formattedPrice} </span>
                          <span class="text-gray-400">/pc</span>
                      </p>
                      <li class="fon-semibold ml-4 text-gray-400">${formattedTotalPrice}</li>
                      <p class="absolute right-2">x${order.quantity}</p>
                  </div>
              </div>
          </div>
          <div class="h-10">
              <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EAE1C0]"></div>
              <div class="absolute w-full bottom-5 flex items-center">
                  <div class="w-full border border-dashed border-[#EAE1C0]"></div>
              </div>
              <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EAE1C0]"></div>
          </div>
      </div>`;
    } else if (index === orders.length - 1) {
      itemHTML = `
      <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4">
          <div class="flex flex-row gap-4">
              <div class="w-2/4 place-items-center">
                  <img class="w-[67px] h-[67px] object-cover rounded-lg" src="${order.image}" />
              </div>
              <div class="flex w-2/1 flex-col">
                  <div class="mb-6 flex w-full justify-between font-semibold">
                      <p>${order.name}</p>
                      <img onclick="removeOrder('${order.id}')" class="w-[18px] h-[18px] hover:cursor-pointer" src="<?= base_url('assets/mobile/close-red.svg') ?>" alt="icon"/>
                  </div>
                  <div class="relative flex flex-row h-[50px]">
                      <p>
                          <span class="font-bold text-[#8C0B40]">Rp${formattedPrice} </span>
                          <span class="text-gray-400">/pc</span>
                      </p>
                      <li class="fon-semibold ml-4 text-gray-400">${formattedTotalPrice}</li>
                      <p class="absolute right-2">x${order.quantity}</p>
                  </div>
              </div>
          </div>
      </div>`;
    } else {
      itemHTML = `
      <div class="relative flex w-full flex-col gap-4 bg-[#FFFBF0] px-4 pt-4">
          <div class="flex flex-row gap-4">
              <div class="w-2/4 place-items-center">
                  <img class="w-[67px] h-[67px] object-cover rounded-lg" src="${order.image}" />
              </div>
              <div class="flex w-2/1 flex-col">
                  <div class="mb-6 flex w-full justify-between font-semibold">
                      <p>${order.name}</p>
                      <img onclick="removeOrder('${order.id}')" class="w-[18px] h-[18px] hover:cursor-pointer" src="<?= base_url('assets/mobile/close-red.svg') ?>" alt="icon"/>
                  </div>
                  <div class="relative flex flex-row">
                      <p>
                          <span class="font-bold text-[#8C0B40]">Rp${formattedPrice} </span>
                          <span class="text-gray-400">/pc</span>
                      </p>
                      <li class="fon-semibold ml-4 text-gray-400">${formattedTotalPrice}</li>
                      <p class="absolute right-2">x${order.quantity}</p>
                  </div>
              </div>
          </div>
          <div class="h-10">
              <div class="absolute left-0 bottom-0 h-10 w-5 rounded-r-full bg-[#EAE1C0]"></div>
              <div class="absolute w-full bottom-5 flex items-center">
                  <div class="w-full border border-dashed border-[#EAE1C0]"></div>
              </div>
              <div class="absolute right-0 bottom-0 h-10 w-5 rounded-l-full bg-[#EAE1C0]"></div>
          </div>
      </div>`;
    }
    // Tambahkan HTML order ke container khusus
    ordersContainer.innerHTML += itemHTML;
    });
}

function updateTotals() {
  let subtotal = orders.reduce((sum, order) => sum + parseFloat(order.total_price), 0);
  let tax = subtotal * 0.10;
  let finalTotal = subtotal + tax;

  const formattedSubtotal = new Intl.NumberFormat('id-ID', { 
    style: 'decimal', 
    minimumFractionDigits: 0 
  }).format(subtotal);
  const formattedTax = new Intl.NumberFormat('id-ID', { 
    style: 'decimal', 
    minimumFractionDigits: 0 
  }).format(tax);
  const formattedFinalTotal = new Intl.NumberFormat('id-ID', { 
    style: 'decimal', 
    minimumFractionDigits: 0 
  }).format(finalTotal);
  document.getElementById('subtotal').innerText = `Rp${formattedSubtotal}`;
  document.getElementById('tax').innerText = `Rp${formattedTax}`;
  document.getElementById('final_total').innerText = `Rp${formattedFinalTotal}`;
}

function removeOrder(orderId) {
  orders = orders.filter(order => order.id !== orderId);
  renderCart();
  updateTotals();
}

var base_url = "<?= base_url(); ?>";
$('#confirm_order').on('click', function() {
      $.ajax({
        url: '/kasir/create_order',
        type: 'POST',
        data: JSON.stringify(orders),
        contentType: 'application/json',
        dataType: 'json',
        success: function(response) {
          alert('Order berhasil diproses');
          const url = base_url + 'kasir/receipt?order_id=' + encodeURIComponent(response.order_id);
          window.location.href = url;
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan saat membuat orders..');
          console.error('Terjadi kesalahan:', error);
        }
      });
});
</script>
<?= $this->endSection() ?>