<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - History<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
    <div class="relative flex flex-row max-h-screen">
        <div class="flex flex-col gap-[15px] justify-center items-center h-screen bg-[#FFFBF0]">
            <button type="button" onclick="history.back()" class="cursor-pointer">
                <div class="relative w-[49px] h-[54px] bg-[#8C0B40] rounded-b-md"
                    style="clip-path: polygon(
                        0% 40%,   /* Titik kiri atas */
                        50% 0%,   /* Atap tengah */
                        100% 40%, /* Titik kanan atas */
                        100% 100%,/* Sudut kanan bawah */
                        0% 100%   /* Sudut kiri bawah */
                    );">
                <img
                    src="<?= base_url('assets/mobile/back.svg') ?>"
                    alt="Back Arrow"
                    class="absolute w-6 h-6 top-8 left-1/2 -translate-x-1/2 -translate-y-1/2"
                />
                </div>
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
        <div class="w-full bg-[#FFFBF0] flex flex-col gap-[25px] py-[133px] pl-[30px]">
            <!-- header -->
            <div class="relative flex flex-row justify-between items-center w-full pr-[70px]">
                <p class="font-bold text-[36px] text-[#8C0B40] ">History</p>
            </div>
            <div class="w-full max-h-[758px] overflow-y-auto overflow-x-hidden bg-white">
                <div class="flex w-full flex-col">
                    <!-- Header -->
                    <div id="head" class="flex flex-row  px-4 items-center h-[48px] font-bold text-[#272833]">
                        <div class="w-1/12"></div> <!-- Empty space for checkbox alignment -->
                        <p class="w-1/12">No</p>
                        <p class="w-4/12">Order Code</p>
                        <p class="w-3/12">Order Date</p>
                    </div>
                    <!-- Body -->
                    <?php $no = 1; ?>
                    <?php foreach ($orders as $order): ?>
                        <div id="body" class="flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833]">
                            <input type="checkbox" class="w-1/12" />
                            <p class="w-1/12"><?= $no++ ?></p>
                            <p class="w-4/12" id="Order_Code" name="Order_Code"><?= $order['Order_Code'] ?></p>
                            <?php $formatted_date = date("M d, Y | h:i:s A", strtotime($order['Order_Date'])); ?>
                            <p class="w-3/12 mr-4 truncate"><?= $formatted_date ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<!-- end template -->
<?= $this->endSection() ?>