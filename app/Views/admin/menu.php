<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Dashboard<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-white px-[46px] pt-[53px] flex flex-row gap-[49px] flex-1 h-[96vh]">
    <?= view('templates/sidenav', ['activePage' => $activePage]) ?>
    <div id="content" class="flex flex-col gap-[25px] mt-[70px] w-full">
        <div id="headers" class="flex flex-row justify-between items-center w-full">
            <p class="font-bold text-[36px] text-[#8C0B40] ">Menu List</p>
            <div class="flex flex-row justify-between w-[474px] h-[45px] gap-[31px]">
                <div class="w-full mr-6 relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                    <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                    <input class="outline-none" id="search" name="search" type="text" placeholder="Search menu..." />
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="flex w-full flex-col p-6">
                <!-- Header -->
                <div id="head" class="flex flex-row  px-4 items-center h-[48px] font-bold text-[#272833]">
                    <div class="w-1/12"></div> <!-- Empty space for checkbox alignment -->
                    <p class="w-1/12">No</p>
                    <p class="w-4/12">Menu Name</p>
                    <p class="w-3/12">Menu Price</p>
                    <p class="w-2/12">Menu Stock</p>
                </div>
                <!-- Body -->
                <?php $no = 1; ?>
                <?php foreach ($data as $menu): ?>
                    <div id="body" class="flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833]">
                        <input type="checkbox" class="w-1/12" />
                        <p class="w-1/12"><?= $no++ ?></p>
                        <p class="w-4/12 mr-4 truncate" id="Nama_Produk" name="Nama_Produk"><?= $menu['Nama_Produk'] ?></p>
                        <p class="w-3/12 mr-4 truncate">Rp.<?= number_format($menu['Harga'], 0, ',', '.') ?></p>
                        <p class="w-2/12 mr-4 truncate"><?= $menu['Stok'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
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
});
</script>
<?= $this->endSection() ?>