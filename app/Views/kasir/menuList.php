<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Menu list<?= $this->endSection() ?>
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
                <a href="<?= base_url('kasir/kategori') ?>">
                    <p class="w-[120px] h-[45px] items-center font-bold text-white bg-[#8C0B40] rounded-lg hover:cursor-pointer flex justify-center items-center">Kategori</p>
                </a>
                <p class="font-bold text-[36px] text-[#8C0B40] ">Menu List</p>
                <div class="flex flex-row justify-between w-[474px] h-[45px] gap-[31px]">
                    <div class="w-[323px] relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                        <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                        <input class="outline-none" id="seach" name="search" type="text" placeholder="Search menu..." />
                    </div>
                    <button id="modalAdd" class="w-[120px] h-[45px] items-center font-bold text-white bg-[#8C0B40] rounded-lg hover:cursor-pointer">Add Menu</button>
                </div>
            </div>
            <div class="w-full max-h-[758px] overflow-y-auto overflow-x-hidden bg-white">
                <div class="flex w-full flex-col">
                    <!-- Header -->
                    <div id="head" class="flex flex-row  px-4 items-center h-[48px] font-bold text-[#272833]">
                        <div class="w-1/12"></div> <!-- Empty space for checkbox alignment -->
                        <p class="w-1/12">No</p>
                        <p class="w-4/12">Menu Name</p>
                        <p class="w-3/12">Menu Price</p>
                        <p class="w-2/12">Menu Stock</p>
                        <p class="w-2/12">Action</p>
                    </div>
                    <!-- Body -->
                    <?php $no = 1; ?>
                    <?php foreach ($menus as $menu): ?>
                        <div id="body" class="flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833]">
                            <input type="checkbox" class="w-1/12" />
                            <p class="w-1/12"><?= $no++ ?></p>
                            <p class="w-4/12 mr-4 truncate" id="Nama_Produk" name="Nama_Produk"><?= $menu['Nama_Produk'] ?></p>
                            <p class="w-3/12 mr-4 truncate">Rp.<?= number_format($menu['Harga'], 0, ',', '.') ?></p>
                            <p class="w-2/12 mr-4 truncate"><?= $menu['Stok'] ?></p>
                            <div class="flex w-2/12 gap-3">
                                <button data-id="<?= $menu['Produk_id'] ?>" class="edited hover:cursor-pointer bg-[#E5EEFF] border border-[#C2E9FF] rounded-lg items-center p-1"><img src="<?= base_url('assets/material-symbols_edit.svg') ?>" alt="icon"/></button>
                                <button data-id="<?= $menu['Produk_id'] ?>" class="delete hover:cursor-pointer bg-[#FFE5E5] border border-[#FFC2C2] rounded-lg items-center p-1"><img src="<?= base_url('assets/mdi_trash.svg') ?>" alt="icon"/></button>
                                <button class="ml-4"><img src="<?= base_url('assets/three-dots.svg') ?>" alt="icon"/></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<!-- end template -->
<!-- Modal -->
<div 
    class="fixed antialiased inset-0 bg-stone-200/60 flex justify-center items-center opacity-0 pointer-events-none transition-opacity duration-300 ease-out z-[9999]" 
    id="modal" 
    aria-hidden="true"
>
    <div class="bg-white rounded-lg w-9/12 sm:w-7/12 md:w-5/12 lg:w-3/8 scale-95 transition-transform duration-300 ease-out">
      <!-- Modal Header -->
      <div class="border-b border-stone-200 p-4 flex justify-between items-start">
        <div class="flex flex-col">
          <!-- Judul modal akan berubah antara "Tambah Menu" dan "Ubah Menu" -->
          <h1 class="text-lg text-stone-800 font-semibold">Tambah Menu</h1>
          <p class="font-sans text-base text-stone-500"></p>
        </div>
        <button 
          type="button" 
          id="closemodaladd" 
          aria-label="Close" 
          class="text-stone-500 hover:text-stone-800"
        >
          &times;
        </button>
      </div>
      <!-- Modal Body -->
      <form enctype="multipart/form-data">
        <!-- Hidden input untuk Produk_id (digunakan pada mode edit) -->
        <input type="hidden" name="Produk_id" value="">
        <div class="p-4 text-stone-500">
            <div class="grid grid-cols-1 gap-4">
                <!-- Field: Nama_Produk -->
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-stone-700">Nama Produk</label>
                    <input 
                      type="text" 
                      id="nama_produk" 
                      name="Nama_Produk" 
                      placeholder="Nama Produk" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <!-- Field: Rasa -->
                <div>
                    <label for="rasa" class="block text-sm font-medium text-stone-700">Rasa</label>
                    <input 
                      type="text" 
                      id="rasa" 
                      name="Rasa" 
                      placeholder="Rasa" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <!-- Field: Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-stone-700">Harga</label>
                    <input 
                      type="number" 
                      id="harga" 
                      name="Harga" 
                      placeholder="Harga" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <!-- Field: Star -->
                <div>
                    <label for="star" class="block text-sm font-medium text-stone-700">Star</label>
                    <input 
                      type="number" 
                      id="star" 
                      name="Star" 
                      placeholder="Star" 
                      min="1" max="5" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <!-- Field: Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-stone-700">Deskripsi</label>
                    <textarea 
                      id="deskripsi" 
                      name="Deskripsi" 
                      rows="3" 
                      placeholder="Deskripsi" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    ></textarea>
                </div>
                <!-- Field: Waktu (disini berupa input number, sesuaikan jika diperlukan) -->
                <div>
                    <label for="waktu" class="block text-sm font-medium text-stone-700">Waktu</label>
                    <input 
                      type="number" 
                      id="waktu" 
                      name="Waktu" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <!-- Field: Gambar Produk -->
                <div>
                    <label for="gambar_produk" class="block text-sm font-medium text-stone-700">Gambar Produk</label>
                    <input 
                    type="file" 
                    id="gambar_produk" 
                    name="Gambar_Produk" 
                    accept="image/*"
                    class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>

                <div id="preview_container" class="mt-2">
                    <img id="preview_image" src="" alt="Preview Gambar" class="max-w-xs hidden">
                </div>
                <!-- Field: Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-stone-700">Kategori</label>
                    <select 
                    id="category" 
                    name="Category_id" 
                    required
                    class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                        <option value="" selected disabled>Pilih Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['Category_id']; ?>">
                                <?= $category['Category_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Field: Stok -->
                <div>
                    <label for="stok" class="block text-sm font-medium text-stone-700">Stok</label>
                    <input 
                      type="number" 
                      id="stok" 
                      name="Stok" 
                      placeholder="Stok" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="border-t border-stone-200 p-4 flex flex-col items-center gap-2">
          <div class="flex justify-end gap-4 w-full">
              <a id="cancelmodaladd" class="hover:cursor-pointer px-8 py-2 bg-red-800 text-white rounded-lg">Cancel</a>
              <!-- Tombol submit yang teksnya akan berubah antara Tambah dan Ubah -->
              <button type="submit" class="hover:cursor-pointer px-8 py-2 bg-green-800 text-white rounded-lg">Tambah</button>
          </div>
        </div>
      </form>
    </div>
</div>
<script>
    // Buka modal dengan tombol pemicu add (pastikan elemen dengan id "modalAdd" ada)
    const modal = document.getElementById("modal");
    const openModalAdd = document.getElementById("modalAdd");

    openModalAdd.addEventListener("click", () => {
      // Reset form dan set mode add
      $('#modal form')[0].reset();
      $("input[name='Produk_id']").val('');
      $('#modal h1').text("Tambah Menu");
      $('#modal button[type="submit"]').text("Tambah");

      modal.classList.remove("opacity-0", "pointer-events-none");
      modal.classList.add("opacity-100");
    });

    document.querySelectorAll("#closemodaladd, #cancelmodaladd").forEach(btn => {
        btn.addEventListener("click", () => {
            modal.classList.add("opacity-0", "pointer-events-none");
            modal.classList.remove("opacity-100");
        });
    });

    // Submit form untuk Add atau Edit
    $('#modal form').on('submit', function(e) {
        e.preventDefault();
        // Jika Produk_id ada isinya, berarti mode edit
        let productId = $("input[name='Produk_id']").val();
        let endpoint = (productId === '' || productId === null) ? 'addMenu' : 'updateProduk';

        var formData = new FormData(this);

        $.ajax({
            url: endpoint,
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                console.log('Sukses:', data);
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
                let msg = (productId === '' || productId === null) ? 'Menu berhasil ditambahkan' : 'Menu berhasil diubah';
                alert(msg);
                // Reset form setelah submit
                $('#modal form')[0].reset();
                $("input[name='Produk_id']").val('');
                // Kembalikan mode ke Add (default)
                $('#modal h1').text("Tambah Menu");
                $('#modal button[type="submit"]').text("Tambah");
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
                alert('Menu gagal diproses');
            }
        });
    });

    // Event handler untuk tombol edit (dengan class .edited)
    $('.edited').on('click', function(e) {
        e.preventDefault();
        let productId = $(this).data('id');

        // Ambil data detail produk dengan endpoint getDetails
        $.ajax({
            url: 'getDetails',
            type: 'POST',
            data: { id: productId },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success'){
                    const data = response.data[0];
                    // Isi form dengan data yang diambil
                    $('#nama_produk').val(data.Nama_Produk);
                    $('#rasa').val(data.Rasa);
                    $('#harga').val(data.Harga);
                    $('#star').val(data.Star);
                    $('#deskripsi').val(data.Deskripsi);
                    $('#waktu').val(data.Waktu);
                    $("#category").val(data.Category_id);
                    $('#stok').val(data.Stok);
                    $("input[name='Produk_id']").val(data.Produk_id);
                    // Ubah judul modal dan teks tombol submit ke mode edit
                    $('#modal h1').text("Ubah Menu");
                    $('#modal button[type="submit"]').text("Ubah");
                    // Tampilkan modal
                    $('#modal').removeClass('opacity-0 pointer-events-none').addClass('opacity-100');
                } else {
                    alert("Data tidak ditemukan");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    // delete items
    $('.delete').on('click', function(e) {
        e.preventDefault();
        let productId = $(this).data('id');
        
        // Konfirmasi sebelum menghapus
        if(confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
            $.ajax({
                url: 'deleteProduk/' + productId,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if(response.status === "failed"){
                        console.error(response.message);
                        alert('terjadi kesalahan dengan data');
                    }
                    alert('data berhasil dihapus..');
                    console.log("Berhasil menghapus produk:", response);
                    $(this).closest('div').fadeOut('slow', function() { $(this).remove(); });
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Gagal menghapus produk:", error);
                }
            });
        }
    });
    // filtering search
    $(document).ready(function(){
        $('#seach').on('keyup', function(){
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

    document.getElementById('gambar_produk').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_image').src = e.target.result;
                document.getElementById('preview_image').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<?= $this->endSection() ?>