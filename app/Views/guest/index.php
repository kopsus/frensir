<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-[#FFFBF0] h-screen h-max-screen flex flex-col">
    <!-- header -->
    <div class="relative w-full h-[36px] flex flex-row justify-between items-center px-[23px]">
        <img class="w-[38px] h-[18px] z-20" src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
        <img class="absolute w-[100px] z-10 h-full top-0 right-0" src="<?= base_url('assets/mobile/mobile-bg-cart.svg') ?>" alt="logo" />
        <a href="<?= base_url('guest/history') ?>" class="bg-[#8C0B40] rounded-lg text-white pb-[3px] px-[8px]">History</a>
        <button class="relative z-20" onclick="window.location.href='<?= base_url('guest/cart') ?>'">
            <img class="w-[16px] h-[16px]" src="<?= base_url('assets/mobile/mobile-cart.svg') ?>" alt="logo" />
        </button>
    </div>
    <!-- title -->
    <div class="pl-[33px] pt-[26px] font-bold flex flex-col">
        <p><span class="text-[#8C0B40]">Discover</span>tastes,</p>
        <p class="pl-2">Create <span class="text-[#D49D55]">Memories</span></p>
    </div>
    <!-- searchbar -->
     <div class="relative h-[32px] bg-white flex flex-row gap-3 px-[14px] py-[11px] rounded-2xl mx-[27px] mt-[18px] items-center justify-center">
        <img class="w-[9px] h-[9px] z-20" src="<?= base_url('assets/magnifiers.svg') ?>" alt="logo" />
        <input type="text" class="w-full h-[12px] outline-none" placeholder="Search Food & Drinks.." />
     </div>
    <!-- nav -->
     <div class="mt-[12px] relative flex flex-row justify-between w-[234px] h-[23px] mx-[39px] text-[8px]">
        <div class="flex flex-row items-center justify-start gap-2 h-full w-[65px] rounded-2xl bg-[#D49D55] font-medium pl-[10px] text-white">
            <a href="<?= base_url('guest') ?>" class="flex flex-row items-center gap-[10px] w-full h-full">
                <img class="w-[11px] h-full" src="<?= base_url('assets/mobile/food.svg') ?>" alt="icon"/>
                <p class="text-[8px] font-medium">All</p>
            </a>
        </div>
        <?php foreach ($categories as $category): ?>
            <div class="flex flex-row items-center gap-2 h-full w-[65px] rounded-2xl bg-[#FBFBFB] font-medium pl-[10px] text-white">
                <a href="<?= base_url('guest/menu/category/' . $category['Category_id']) ?>" class="flex flex-row items-center gap-[10px] w-full h-full">
                    <img class="w-[11px] h-full" src="<?= base_url('assets/mobile/food.svg') ?>" alt="icon"/>
                    <p class="text-[#D49D55] text-[8px] font-medium"><?= $category['Category_name'] ?></p>
                </a>
            </div>
        <?php endforeach; ?>
        <!-- <div class="flex flex-row items-center gap-2 h-full w-[65px] rounded-2xl bg-[#FBFBFB] font-medium pl-[10px] text-white">
            <img class="w-[11px] h-full" src="<?= base_url('assets/mobile/drink.svg') ?>" alt="icon"/>
            <p class="text-[#D49D55] text-[8px] font-medium">Drink</p>
        </div>
        <div class="flex flex-row items-center gap-1 h-full w-[65px] rounded-2xl bg-[#FBFBFB] font-medium pl-[10px] text-white">
            <img class="w-[11px] h-full" src="<?= base_url('assets/mobile/sidedish.svg') ?>" alt="icon"/>
            <p class="text-[#D49D55] text-[8px] font-medium">Side Dish</p>
        </div> -->
    </div>
    <!-- menu -->
    <div class="flex justify-center items-center w-full mt-[10px]">
        <div class="grid grid-cols-3 h-[246px] overflow-y-auto overflow-x-hidden gap-y-[18px] gap-x-[15px]">
             <?php foreach ($menus as $menu): ?>
                <div data-id="<?= $menu['Produk_id'] ?>" class="menu-item bg-white relative flex flex-col w-[82px] justift-center items-center">
                    <img class="w-full h-full" src="<?= base_url('images/' . $menu['Gambar_Produk']) ?>" alt="icon"/>
                    <p class="text-[8px] font-medium text-black mb-1"><?= $menu['Nama_Produk'] ?></p>
                    <p class="text-[6px] font-regular text-gray-300 mb-[11px]"><?= $menu['Rasa'] ?></p>
                    <button class="bg-[#8C0B40] rounded-lg text-white pb-[3px] px-[8px] w-full">
                        <sup class="text-[7px]">Rp</sup><span class="text-[10px] font-bold"><?= number_format($menu['Harga'], 0, ',', '.') ?></span>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- bottom -->
     <div class="flex justify-center absolute bottom-0 bg-[#8C0B40] rounded-t-2xl w-full h-[26px]"></div>
</div>
<script>
  $(document).ready(function(){
      $('.menu-item').on('click', function(){
        var productId = $(this).data('id');
        window.location.href = '<?= base_url("guest/detail") ?>?id=' + productId;
      });

  });
</script>
<?= $this->endSection() ?>