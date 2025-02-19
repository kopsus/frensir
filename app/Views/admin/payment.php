<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Payment<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-white px-[46px] pt-[53px] flex flex-row gap-[49px] flex-1 h-[96vh]">
    <?= view('templates/sidenav', ['activePage' => $activePage]) ?>
    <div id="content" class="flex flex-col gap-[25px] mt-[70px] w-full">
        <div id="headers" class="flex flex-row justify-between items-center w-full">
            <p class="font-bold text-[36px] text-[#8C0B40] ">Payment List</p>
            <div class="flex flex-row justify-between w-[474px] h-[45px] gap-[31px]">
                <div class="w-full mr-6 relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                    <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                    <input class="outline-none" id="search" name="search" type="text" placeholder="Search Transaksi..." />
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="flex w-full flex-col p-6">
                <!-- Header -->
                <div id="head" class="flex flex-row  px-4 items-center h-[48px] font-bold text-[#272833]">
                    <div class="w-1/12"></div> <!-- Empty space for checkbox alignment -->
                    <p class="w-1/12">No</p>
                    <p class="w-4/12">Order Code</p>
                    <p class="w-3/12">Date</p>
                    <p class="w-2/12">Status</p>
                </div>
                <!-- Body -->
                <?php $no=1 ?>
                <?php foreach ($data as $item): ?>
                    <div id="body" class="order-row mb-2">
                        <!-- Baris summary order -->
                        <div class="order-summary flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833] cursor-pointer" data-order-code="<?= esc($item['Order_Code']) ?>">
                            <input type="checkbox" class="w-1/12" />
                            <p class="w-1/12"><?= $no++ ?></p>
                            <p id="order_code" class="w-4/12 mr-4 truncate"><?= esc($item['Order_Code']) ?></p>
                            <?php $formatted_date = date("M d, Y | h:i:s A", strtotime($item['Order_Date'])); ?>
                            <p class="w-3/12 mr-4 truncate"><?= $formatted_date ?></p>
                            <p class="w-2/12 mr-4 truncate"><?= esc($item['Status']) ?></p>
                        </div>
                        <!-- Tempat detail order akan ditampilkan -->
                        <div class="order-detail hidden border rounded-xl p-4 mt-1" data-order-code="<?= esc($item['Order_Code']) ?>">
                        </div>
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
            var namaProduk = $(this).find('p#order_code').text().toLowerCase();
            if(namaProduk.indexOf(searchTerm) !== -1){
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

$(document).ready(function(){
    $('.order-summary').on('click', function(){
        var orderCode = $(this).data('order-code').replace(/\s+/g, '-');
        var detailDiv = $('.order-detail[data-order-code="'+orderCode+'"]');

        if(detailDiv.is(':visible')){
            detailDiv.slideUp();
            return;
        }
        
        if($.trim(detailDiv.html()) === ''){
            $.ajax({
                url: "payment", // Pastikan URL endpoint benar
                type: "POST",
                dataType: "json",
                data: { order_code: orderCode },
                success: function(response) {
                    console.log("response ajax: ", response);
                    
                    var html = '<div class="order-details">';
                    html += '<table class="w-full text-sm text-left">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th class="px-2 py-1">Menu</th>';
                    html += '<th class="px-2 py-1">Harga</th>';
                    html += '<th class="px-2 py-1">Jumlah</th>';
                    html += '<th class="px-2 py-1">Total</th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';
                    
                    $.each(response.details, function(index, detail) {
                        html += '<tr>';
                        html += '<td class="px-2 py-1">' + detail.namaProduk + '</td>';
                        html += '<td class="px-2 py-1">Rp' + parseFloat(detail.harga).toLocaleString('id-ID') + '</td>';
                        html += '<td class="px-2 py-1">' + detail.jumlah + '</td>';
                        html += '<td class="px-2 py-1">Rp' + parseFloat(detail.total).toLocaleString('id-ID') + '</td>';
                        html += '</tr>';
                    });

                    html += '</tbody>';
                    html += '</table>';

                    html += '<div class="mt-4 p-4 border-t">';
                    html += '<p class="text-right">Subtotal: Rp' + parseFloat(response.subtotal).toLocaleString('id-ID') + '</p>';
                    html += '<p class="text-right">Tax: Rp' + parseFloat(response.tax).toLocaleString('id-ID') + '</p>';
                    html += '<p class="text-right font-bold">Total: Rp' + parseFloat(response.total).toLocaleString('id-ID') + '</p>';
                    html += '</div>';

                    html += '</div>';
                    
                    detailDiv.removeClass('hidden').hide().html(html).slideDown(400);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        } else {
            detailDiv.slideDown();
        }
    });
});
</script>
<?= $this->endSection() ?>