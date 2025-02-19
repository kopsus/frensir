<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest - Status<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative w-screen max-h-screen flex flex-col bg-[#EAE1C0] overflow-x-hidden h-screen">
    <div class="h-3/5 flex flex-col px-[23px] py-[23px]">
        <!-- header -->
        <div class="flex flex-row justify-between mb-[12px]">
            <button>
                <img class="w-[46px] h-[22px]" src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
            </button>
            <button>
                <img onclick="window.location.href='<?= base_url('guest') ?>'" class="w-[24px] h-[24px]" src="<?= base_url('assets/mobile/close-red.svg') ?>" alt="logo" />
            </button>
        </div>
        <!-- content status -->
         <div class="flex flex-col items-center py-[17px] px-[15px] absolute bg-white w-[244px] h-fit] rounded-lg top-1/2 left-1/2 roght-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="flex justify-center items-center mb-2">
                <img class="w-[32px] h-[37px]" src="<?= $status === 'success' ? base_url('assets/mobile/success.svg') : base_url('assets/mobile/failed.svg') ?>" alt="">
            </div>
            <p class="font-reguler text-[10px]">Order <?= ucfirst($status) ?>!</p>
            <p class="font-extrabold text-[15px] mb-3">Rp<?= number_format($final_total, 0, ',', '.') ?></p>
            <img class="mb-[10px] w-full" src="<?= base_url('assets/mobile/line.svg') ?>" alt="icon">
            <div class="w-full flex flex-col gap-[12px]">
                <div class="flex flex-row justify-between items-center">
                    <p class="font-reguler text-[8px]">Order Number</p>
                    <p class="font-semibold text-[8px]"><?= $order_code ?></p>
                </div>
                <div class="flex flex-row justify-between items-center">
                    <?php  $formatted_date = date("M d, Y | h:i:s A", strtotime($order_date)); ?>
                    <p class="font-reguler text-[8px]">Payment Time</p>
                    <p class="font-semibold text-[8px]"><?= $formatted_date ?></p>
                </div>
                <div class="flex flex-row justify-between items-center">
                    <p class="font-reguler text-[8px]">Payment Method</p>
                    <p class="font-semibold text-[8px]">Payment Gateways</p>
                </div>
                <!-- <div class="flex flex-row justify-between items-center">
                    <p class="font-reguler text-[8px]">Customer Name</p>
                    <p class="font-semibold text-[8px]">#FFFF</p>
                </div> -->
            </div>
            <img class="my-[11px]" src="<?= base_url('assets/mobile/dashed-line.svg') ?>" alt="icon">
            <div class="w-full flex flex-col">
                <div class="flex flex-row justify-between items-center">
                    <p class="font-semibold text-[8px]">Total Sales Tax</p>
                    <p><span class="font-medium text-[7px] text-gray-500">Rp </span><span class="font-bold text-[10px]"><?= number_format($tax, 0, ',', '.') ?></span></p>
                </div>
                <div class="flex flex-row justify-between items-center">
                    <p class="font-semibold text-[8px]">Amount</p>
                    <p><span class="font-medium text-[7px] text-gray-500">Rp </span><span class="font-bold text-[10px]"><?= number_format($final_total, 0, ',', '.') ?></span></p>
                </div>
            </div>
         </div>
    </div>
    <div class="h-2/5 w-full bg-[#F3EAE3] rounded-t-4xl"></div>
</div>
<?= $this->endSection() ?>