<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Receipt<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="overflow-hidden relative flex flex-col h-screen bg-[#F3EAE3]">
    <!-- header -->
    <img class="w-[118px] h-[56px] ml-[121px] mt-[63px] mb-[35px]" src="<?= base_url('assets/FrensirLogo.svg') ?>" alt="logo" />
    <!-- content -->
    <div class="z-10 h-1/2 flex flex-col gap-[35px] items-center">
        <p class="font-bold text-[43px]">Receipt Preview</p>
        <!-- receipt -->
        <div class="bg-white rounded-2xl h-full w-[352px] pb-10">
            <div class="flex flex-row justify-between mx-6 top-0">
                <?php for ($i=0; $i < 6; $i++) : ?>
                    <div class="bg-[#EAE1C0] w-4 rounded-b-2xl h-2"></div>
                <?php endfor; ?>
            </div>
            <!-- header receipt -->
            <div class="flex flex-col justify-center items-center mt-[15px]">
                <p class="font-extrabold text-[30px]"><?= $order_code; ?></p>
                <p class="font-reguler text-[16px] text-gray-400">Your order number</p>
            </div>
            <!-- mage dished line here -->
            <img class="mt-6 mb-4 w-full" src="<?= base_url('assets/mobile/dashed-line.svg') ?>" alt="logo" />
            <!-- receipt information -->
            <div class="relative flex flex-col px-8 mt-3">
                <?php  $formatted_date = date("M d, Y | h:i:s A", strtotime($order_date)); ?>
                <div class="flex flex-row justify-between mb-[31px]">
                    <p class="text-[12px] font-medium text-gray-500">Date & time</p>
                    <p class="text-[12px]  font-medium"><?= $formatted_date ?></p>
                </div>
                <div class="flex flex-row justify-between">
                    <p class="text-[12px] font-medium text-gray-500">QTY ITEM</p>
                    <p class="text-[12px] font-medium text-gray-500">TOTAL</p>
                </div>
                <?php foreach ($details as $items): ?>
                <div class="flex flex-row justify-between pl-2 text-[9px]">
                    <div class="flex flex-row gap-2">
                        <p class="text-[10px] font-reguler"><?= $items['Jumlah_Produk'] ?></p>
                        <p class="text-[10px] font-reguler"><?= $items['Nama_Produk'] ?></p>
                    </div>
                <p class="text-[8px] font-reguler">Rp<?= number_format($items['Harga'], 0, ',', '.') ?></p>
                </div>
                <?php endforeach; ?>
                <!-- sub total -->
                <div class="flex flex-col text-[10px] mt-4">
                    <div class="flex flex-row justify-between">
                        <p class="text-[10px] font-medium text-gray-500">Subtotal</p>
                        <p class="text-[10px] font-reguler"><span>Rp</span><?= number_format($subtotal) ?></p>
                    </div>
                    <div class="flex flex-row justify-between">
                        <p class="text-[10px] font-medium text-gray-500">Total Sales Tax</p>
                        <p class="text-[10px] font-reguler"><span>Rp</span><?= number_format($tax) ?></p>
                    </div>
                </div>
            </div>
            <!-- image dished line here with side x have half round -->
            <div class="relative flex flex-row w-full h-[26px] mt-4 mb-2">
                <div class="absolute w-[26px] h-[26px] -left-4 rounded-full bg-[#EAE1C0]"></div>
                <img class="w-full" src="<?= base_url('assets/mobile/dashed-line.svg') ?>" alt="logo" />
                <div class="absolute w-[26px] h-[26px] -right-4 rounded-full bg-[#EAE1C0]"></div>
            </div>
            <!-- Total Amount and barcode -->
            <div class="px-8 flex flex-col gap-[28px]">
                <div class="flex flex-row justify-between text-[12px] font-semibold">
                    <div class="flex items-center">
                        <p class="font-semibold text-[10px]">Total Amount</p>
                    </div>
                    <p><span class="tex-[10px] font-medium text-gray-400">Rp </span><span class="font-bold text-[14px]"><?= number_format($final_total) ?></span></p>
                </div>
                <img src="<?= base_url('assets/barcode.svg') ?>" alt="barcode">
            </div>
      </div>
      <flex class="flex flex-row gap-4">
        <div id="payment" class="hover:cursor-pointer bg-[#8C0B40] px-[51px] py-[13px] text-[14px] font-bold text-white rounded-2xl">
            <button class="hover:cursor-pointer">Payment</button>
        </div>
        <div class="hover:cursor-pointer bg-[#8C0B40] px-[51px] py-[13px] text-[14px] font-bold text-white rounded-2xl">
            <!-- <button class="hover:cursor-pointer">Print Receipt</button> -->
            <a href="<?= base_url('kasir/printReceipt?order_id=' . $_GET['order_id']) ?>" target="_blank">
                Print Receipt
            </a>
        </div>
      </flex>
    </div>
    <div class="h-1/2 flex justify-center items-center w-full">
        <div class="rounded-full bg-[#EAE1C0] w-[870px] h-[870px]"></div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key='<?php getenv('ServerKey')?>'></script>
<script>
function getQueryParam(param) {
  const params = new URLSearchParams(window.location.search);
  return params.get(param);
}
$(document).ready(function(){
    function updateDataAfterMidtransActions(type, data){
        $.ajax({
            url: '<?= base_url('midtrans/finishTransaction') ?>',
            type: "POST",
            data: { 
                order_id: data, 
                status: type
            },
            cache: false,
            success: function(response) { 
                alert("pembayaran sudah diterima.");
                window.location.href = '<?= base_url("kasir") ?>';
            }
        })
    }

  $('#payment').on('click', function() {
    var orderId = getQueryParam('order_id');

    if (!orderId) {
      alert("Order ID tidak ditemukan di URL.");
      return;
    }

    $.ajax({
      url: '<?= base_url('midtrans/getToken') ?>',
      type: 'POST',
      data: { order_id: orderId },
      cache: false,
      success: function(response) {
        snap.pay(response, {
            onSuccess: function(result) {
                // do somethink
                updateDataAfterMidtransActions('success', orderId)
            },
            onPending: function(result) {
                updateDataAfterMidtransActions('pending', orderId);
            },
            onError: function(result) {
                updateDataAfterMidtransActions('rejected', orderId)
            }
        });
      },
      error: function(xhr, status, error) {
        alert('Terjadi kesalahan saat menghubungi Midtrans payment. Silakan coba lagi.');
        console.error('Payment error:', error);
        window.location.href = '<?= base_url("kasir") ?>';
      }
    });
  });
});

</script>
<?= $this->endSection() ?>