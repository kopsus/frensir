<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Guest - Receipt<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative w-screen max-h-screen flex flex-col bg-[#EAE1C0] overflow-x-hidden h-screen">
  <div class="h-2/5 px-[21px] py-[25px]">
    <!-- header -->
    <div class="flex flex-row justify-between mb-[12px]">
        <button>
            <img class="w-[46px] h-[22px]" src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
        </button>
        <button>
            <img class="w-[28px] h-[28px]" src="<?= base_url('assets/mobile/order-info-button.svg') ?>" alt="logo" />
        </button>
    </div>
    <!-- content -->
    <div class="relative flex flex-col items-center">
      <!-- receipt -->
      <div class="bg-white rounded-2xl h-full w-[267px]">
        <div class="flex flex-row justify-between mx-6 top-0">
            <?php for ($i=0; $i < 6; $i++) : ?>
                <div class="bg-[#EAE1C0] w-4 rounded-b-2xl h-2"></div>
            <?php endfor; ?>
        </div>
        <!-- header receipt -->
        <div class="flex flex-col justify-center items-center mt-[15px]">
          <div class="flex flex-row gap-2 justify-center items-center">
            <img class="w-[12px] h-[12px]" src="<?= base_url('assets/mobile/pending.svg') ?>" alt="logo" />
            <p class="font-reguler text-[10px]">Pending Transaction</p>
          </div>
          <p class="font-extrabold text-[15px]"><?= $order_code; ?></p>
          <p class="font-reguler text-[8px] text-gray-400">Your order number</p>
        </div>
        <!-- mage dished line here -->
        <img class="mt-6 mb-4 w-full" src="<?= base_url('assets/mobile/dashed-line.svg') ?>" alt="logo" />
        <!-- receipt information -->
        <div class="relative flex flex-col px-8 mt-3">
            <div class="flex flex-row justify-between mb-2">
              <?php  $formatted_date = date("M d, Y | h:i:s A", strtotime($order_date)); ?>
              <p class="text-[8px] font-medium text-gray-500">Date & time</p>
              <p class="text-[8px]  font-medium"><?= $formatted_date ?></p>
            </div>
            <div class="flex flex-row justify-between">
              <p class="text-[8px] font-medium text-gray-500">QTY ITEM</p>
              <p class="text-[8px] font-medium text-gray-500">TOTAL</p>
            </div>
            <?php foreach ($details as $items): ?>
            <div class="flex flex-row justify-between pl-2 text-[9px]">
              <div class="flex flex-row gap-2">
                <p class="text-[8px] font-reguler"><?= $items['Jumlah_Produk'] ?></p>
                <p class="text-[8px] font-reguler"><?= $items['Nama_Produk'] ?></p>
              </div>
              <p class="text-[8px] font-reguler">Rp<?= number_format($items['Harga'], 0, ',', '.') ?></p>
            </div>
            <?php endforeach; ?>
            <!-- sub total -->
            <div class="flex flex-col text-[10px] mt-4">
              <div class="flex flex-row justify-between">
                <p class="text-[8px] font-medium text-gray-500">Subtotal</p>
                <p class="text-[8px] font-reguler"><span>Rp</span><?= number_format($subtotal) ?></p>
              </div>
              <div class="flex flex-row justify-between">
                <p class="text-[8px] font-medium text-gray-500">Total Sales Tax</p>
                <p class="text-[8px] font-reguler"><span>Rp</span><?= number_format($tax) ?></p>
              </div>
            </div>
        </div>
        <!-- image dished line here with side x have half round -->
         <div class="flex flex-row w-full h-[26px] mt-4 mb-2">
            <div class="absolute w-[26px] h-[26px] -left-2 rounded-full bg-[#F3EAE3] "></div>
            <img class="w-full" src="<?= base_url('assets/mobile/dashed-line.svg') ?>" alt="logo" />
            <div class="absolute w-[26px] h-[26px] -right-2 rounded-full bg-[#F3EAE3] "></div>
         </div>
        <!-- Total Amount and barcode -->
        <div class="px-8 flex flex-col gap-1 mb-5">
            <div class="flex flex-row justify-between text-[12px] font-semibold">
              <div class="flex items-center">
                  <p class="font-semibold text-[8px]">Total Amount</p>
              </div>
              <p><span class="tex-[7px] font-medium">Rp</span><span class="font-bold text-[10px]"><?= number_format($final_total) ?></span></span></p>
            </div>
            <img src="<?= base_url('assets/barcode.svg') ?>" alt="barcode">
        </div>
      </div>
      <!-- button -->
      <div class="w-full flex flex-row justify-between mt-4 font-semibold ml-4 mr-8">
        <div class="w-[100px] flex flex-row gap-1 justify-center items-center">
            <!-- <button class="text-[8px]">Download</button> -->
            <a href="<?= base_url('guest/printReceipt?order_id=' . $_GET['order_id']) ?>" target="_blank">
            Download
            </a>
            <img class="w-[8px] h-[8px]" src="<?= base_url('assets/mobile/download.svg') ?>" alt="icon" />
        </div>
        <button data-code="<?= $order_code ?>" id="check_status" class="text-[10px] items-center rounded-full bg-[#8C0B40] px-8 py-2 text-white">Check Status</button>
      </div>
    </div>
  </div>
  <div class="h-3/5 w-full bg-[#F3EAE3] rounded-t-4xl"></div>
</div>
<script>
var base_url = "<?= base_url(); ?>";
$(document).ready(function(){
    $('#check_status').on('click', function(){
      var productId = $(this).data('code');
      window.location.href = '<?= base_url("guest/status") ?>?id=' + encodeURIComponent(productId);
    });
});
</script>
<?= $this->endSection() ?>