<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Menu list<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
    <div class="relative flex flex-row max-h-screen">
        <div class="flex flex-col gap-[15px] justify-center items-center h-screen bg-[#FFFBF0]">
            <button type="button" onclick="history.back()" class="cursor-pointer ml-3">
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
        </div>
        <div class="w-full bg-[#FFFBF0] flex flex-col gap-[25px] py-[133px] pl-[30px]">
            <!-- header -->
            <div class="relative flex flex-row justify-between items-center w-full pr-[70px]">
                <p class="font-bold text-[36px] text-[#8C0B40] ">Kategori List</p>
                <div class="flex flex-row justify-between w-[474px] h-[45px] gap-[31px]">
                    <div class="w-[323px] relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                        <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                        <input class="outline-none" id="seach" name="search" type="text" placeholder="Search kategori..." />
                    </div>
                    <button id="modalAdd" class="w-[120px] h-[45px] items-center font-bold text-white bg-[#8C0B40] rounded-lg hover:cursor-pointer">Add Kategori</button>
                </div>
            </div>
            <div class="w-full max-h-[758px] overflow-y-auto overflow-x-hidden bg-white">
                <div class="flex w-full flex-col">
                    <!-- Header -->
                    <div id="head" class="flex flex-row  px-4 items-center h-[48px] font-bold text-[#272833]">
                        <div class="w-1/12"></div> <!-- Empty space for checkbox alignment -->
                        <p class="w-1/12">No</p>
                        <p class="w-4/12">Kategori</p>
                        <p class="w-2/12">Action</p>
                    </div>
                    <!-- Body -->
                    <?php $no = 1; ?>
                    <?php foreach ($categories as $category): ?>
                        <div id="body" class="flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833]">
                            <input type="checkbox" class="w-1/12" />
                            <p class="w-1/12"><?= $no++ ?></p>
                            <p class="w-4/12 mr-4 truncate" id="Category_name" name="Category_name"><?= $category['Category_name'] ?></p>
                            <div class="flex w-2/12 gap-3">
                                <button data-id="<?= $category['Category_id'] ?>" class="edited hover:cursor-pointer bg-[#E5EEFF] border border-[#C2E9FF] rounded-lg items-center p-1"><img src="<?= base_url('assets/material-symbols_edit.svg') ?>" alt="icon"/></button>
                                <button data-id="<?= $category['Category_id'] ?>" class="delete hover:cursor-pointer bg-[#FFE5E5] border border-[#FFC2C2] rounded-lg items-center p-1"><img src="<?= base_url('assets/mdi_trash.svg') ?>" alt="icon"/></button>
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
          <h1 class="text-lg text-stone-800 font-semibold">Tambah Kategori</h1>
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
        <input type="hidden" id="category_id" name="Category_id" value="">
        <div class="p-4 text-stone-500">
            <div class="grid grid-cols-1 gap-4">
                <!-- Field: Nama_Produk -->
                <div>
                    <label for="nama_kategori" class="block text-sm font-medium text-stone-700">Nama Kategori</label>
                    <input 
                      type="text" 
                      id="nama_kategori" 
                      name="Category_name" 
                      placeholder="Nama Kategori" 
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

    $('#modal form').on('submit', function(e) {
        e.preventDefault();
        
        let id = $("#category_id").val();
        let formData = new FormData(this);
        let url = id ? "<?= base_url('kasir/kategori/update') ?>" : "<?= base_url('kasir/kategori/add') ?>";

        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error("Error:", error));
    });

    $('.edited').on('click', function(e) {
        e.preventDefault();
        
        let categoryId = $(this).data('id');

        fetch("<?= base_url('kasir/kategori/get/') ?>" + categoryId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#category_id').val(data.category.Category_id);
                    $('#nama_kategori').val(data.category.Category_name);

                    $('#modal h1').text("Edit Kategori");
                    $('#modal button[type="submit"]').text("Update");

                    modal.classList.remove("opacity-0", "pointer-events-none");
                    modal.classList.add("opacity-100");
                } else {
                    alert("Kategori tidak ditemukan.");
                }
            })
            .catch(error => console.error("Error fetching data:", error));
    });

    $('.delete').on('click', function(e) {
        e.preventDefault();
        
        if(confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
            fetch("<?= base_url('kasir/kategori/delete/') ?>" + this.dataset.id, {
                method: "DELETE"
            }).then(res => res.json()).then(data => {
                alert(data.message);
                location.reload();
            });
        }
    });

    // filtering search
    $(document).ready(function(){
        $('#seach').on('keyup', function(){
            var searchTerm = $(this).val().toLowerCase();
            $('div#body').each(function(){
                var namaProduk = $(this).find('p#Category_name').text().toLowerCase();
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