<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-[#FFFBF0] h-screen h-max-screen flex flex-col">
    <!-- header -->
    <div class="relative w-full h-[36px] flex flex-row justify-between items-center px-[23px]">
        <img class="w-[38px] h-[18px] z-20" src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
        <img class="absolute w-[100px] z-10 h-full top-0 right-0" src="<?= base_url('assets/mobile/mobile-bg-cart.svg') ?>" alt="logo" />
       
        <button class="relative z-20" onclick="window.location.href='<?= base_url('guest/cart') ?>'">
            <img class="w-[16px] h-[16px]" src="<?= base_url('assets/mobile/mobile-cart.svg') ?>" alt="logo" />
        </button>
    </div>
    <!-- title -->
    <div class="pl-[33px] pt-[26px] font-bold flex flex-col">
        <p><span class="text-[#8C0B40]">Discover</span>tastes,</p>
        <p>Create <span class="text-[#D49D55]">Memories</span></p>
    </div>
    <!-- searchbar -->
     <div class="relative h-[32px] bg-white flex flex-row gap-3 px-[14px] py-[11px] rounded-2xl mx-[27px] mt-[18px] items-center justify-center">
        <img class="w-[9px] h-[9px] z-20" src="<?= base_url('assets/magnifiers.svg') ?>" alt="logo" />
        <input type="text" class="w-full h-[12px] outline-none" placeholder="Search Food & Drinks.." />
     </div>
    <!-- nav -->
<div class="mt-4 flex gap-2 overflow-x-auto px-8">
    <?php $isAllActive = ($activeCategory == 'all') ? 'bg-[#D49D55] text-white' : 'bg-[#FBFBFB] text-[#D49D55]'; ?>
    <a href="<?= base_url('guest') ?>" 
       class="flex items-center gap-2 py-1 px-2 rounded-full text-xs font-medium <?= $isAllActive ?>">
        <img class="w-4" src="<?= base_url('assets/all-food.svg') ?>" alt="All"/>
        All
    </a>

    <?php foreach ($categories as $category): ?>
        <?php 
            $isActive = ($activeCategory == $category['Category_id']) ? 'bg-[#D49D55] text-white' : 'bg-[#FBFBFB] text-[#D49D55]';

            // Menentukan ikon berdasarkan nama kategori
            $icon = 'default.svg'; // Default jika kategori tidak dikenali
            if ($category['Category_name'] === 'Food') {
                $icon = 'food.svg';
            } elseif ($category['Category_name'] === 'Drink') {
                $icon = 'drink.svg';
            } elseif ($category['Category_name'] === 'Side Dish') {
                $icon = 'sidedish.svg';
            }
        ?>
        <a href="<?= base_url('guest/menu/category/' . $category['Category_id']) ?>" 
           class="flex items-center gap-2 py-1 px-2 rounded-full text-xs font-medium <?= $isActive ?>">
            <img class="w-4" src="<?= base_url('assets/' . $icon) ?>" alt="<?= $category['Category_name'] ?>"/>
            <?= $category['Category_name'] ?>
        </a>
    <?php endforeach; ?>
</div>


    <!-- menu -->
    <div class="flex justify-center mt-6 px-8">
        <div class="grid grid-cols-2 justify-center md:grid-cols-4 gap-4 w-full">
            <?php foreach ($menus as $menu): ?>
                <div data-id="<?= $menu['Produk_id'] ?>" 
                     class="menu-item bg-white rounded-xl shadow-lg p-3 flex flex-col items-center cursor-pointer">
                    <div class="w-full h-32 md:h-52 overflow-hidden rounded-lg">
                        <img class="w-full h-full object-cover" src="<?= base_url('images/' . $menu['Gambar_Produk']) ?>" alt="<?= $menu['Nama_Produk'] ?>" />
                    </div>
                    <p class="text-sm font-medium text-black mt-2 text-center"><?= $menu['Nama_Produk'] ?></p>
                    <p class="text-xs text-gray-400 mb-2 text-center"><?= $menu['Rasa'] ?></p>
                    <button class="bg-[#8C0B40] rounded-lg text-white text-sm px-4 py-1 w-full">
                        Rp <?= number_format($menu['Harga'], 0, ',', '.') ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- bottom -->
     <!-- <div class="flex justify-center absolute bottom-0 bg-[#8C0B40] rounded-t-2xl w-full h-[26px]"></div> -->
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