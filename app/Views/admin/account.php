<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Frensir - Dashboard<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="relative bg-white px-[46px] pt-[53px] flex flex-row gap-[49px] flex-1 h-[96vh]">
    <?= view('templates/sidenav', ['activePage' => $activePage]) ?>
    <div id="content" class="flex flex-col gap-[25px] mt-[70px] w-full">
        <div id="headers" class="flex flex-row justify-between items-center w-full">
            <p class="font-bold text-[36px] text-[#8C0B40] ">Account List</p>
            <div class="flex flex-row justify-between w-[474px] h-[45px] gap-[31px]">
                <div class="w-[323px] relative gap-2 rounded-lg flex flex-row px-[22px] items-center shadow-[0_0_15px_4px_rgba(255,192,203,1)] ">
                    <img class="w-[12px] h-[12px]" src="<?= base_url('assets/magnifiers.svg') ?>" alt="icon" />
                    <input class="outline-none" id="search" name="search" type="text" placeholder="Search Account..." />
                </div>
                <button id="addUser" class="hover:cursor-pointer w-[120px] h-[45px] items-center font-bold text-white bg-[#8C0B40] rounded-lg">Add Account</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <div class="flex w-full flex-col p-6">
                <!-- Header -->
                <div id="head" class="flex flex-row px-4 items-center h-[48px] font-bold text-[#272833]">
                    <div class="w-1/12"></div>
                    <p class="w-1/12">No</p>
                    <p class="w-4/12">Username</p>
                    <p class="w-3/12">Email</p>
                    <p class="w-3/12">Role</p>
                    <p class="w-2/12">Action</p>
                </div>
                <!-- Body -->
                <?php foreach ($data as $items): ?>
                    <div id="body" class="flex flex-row items-center h-[64px] border rounded-xl border-gray-300 px-4 text-[#272833]">
                        <input type="checkbox" class="w-1/12" />
                        <p class="w-1/12"><?= $items['User_id'] ?></p>
                        <p id="username" class="w-4/12 truncate"><?= $items['Username'] ?></p>
                        <p class="w-3/12 truncate"><?= $items['Email'] ?></p>
                        <p class="w-3/12 truncate"><?= $items['Role'] ?></p>
                        <div class="flex w-2/12 gap-3">
                        <button data-id="<?= $items['User_id'] ?>" class="edit hover:cursor-pointer bg-[#E5EEFF] border border-[#C2E9FF] rounded-lg items-center p-1">
                            <img src="<?= base_url('assets/material-symbols_edit.svg') ?>" alt="icon"/>
                        </button>
                        <button data-id="<?= $items['User_id'] ?>"  class="delete hover:cursor-pointer bg-[#FFE5E5] border border-[#FFC2C2] rounded-lg items-center p-1">
                            <img src="<?= base_url('assets/mdi_trash.svg') ?>" alt="icon"/>
                        </button>
                        <button class="ml-4">
                            <img src="<?= base_url('assets/three-dots.svg') ?>" alt="icon"/>
                        </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

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
      <form>
        <!-- Hidden input untuk Produk_id (digunakan pada mode edit) -->
        <input type="hidden" name="user_id" value="">
        <div class="p-4 text-stone-500">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-stone-700">Username</label>
                    <input 
                      type="text" 
                      id="username_account" 
                      name="username" 
                      placeholder="username" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <div>
                    <label for="rasa" class="block text-sm font-medium text-stone-700">Email</label>
                    <input 
                      type="text" 
                      id="email" 
                      name="email" 
                      placeholder="xxxx@xxxx.com" 
                      required
                      class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-stone-700">Role</label>
                    <select 
                    id="role" 
                    name="role" 
                    required
                    class="mt-1 block w-full rounded-md border border-stone-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-2"
                    >
                        <option value="" selected disabled>Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>
                <div>
                    <label for="rasa" class="block text-sm font-medium text-stone-700">Password</label>
                    <input 
                      type="password" 
                      id="password" 
                      name="password" 
                      placeholder="Password" 
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
<!-- EndModal -->

<script>
    $(document).ready(function(){
        $('#search').on('keyup', function(){
            var searchTerm = $(this).val().toLowerCase();
            $('div#body').each(function(){
                var namaProduk = $(this).find('p#username').text().toLowerCase();
                if(namaProduk.indexOf(searchTerm) !== -1){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

    const modal = document.getElementById("modal");
    const openModalAdd = document.getElementById("addUser");
    openModalAdd.addEventListener("click", () => {
      // Reset form dan set mode add
      $('#modal form')[0].reset();
      $("input[name='user_id']").val('');
      $('#modal h1').text("Create Akun");
      $('#modal button[type="submit"]').text("Create");

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
        let user_id = $("input[name='user_id']").val();
        let endpoint = (user_id === '' || user_id === null) ? 'account' : 'accountUpdate';

        $.ajax({
            url: endpoint,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log('Sukses:', data);
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
                let msg = (user_id === '' || user_id === null) ? 'Account berhasil ditambahkan' : 'Account berhasil diubah';
                alert(msg);
                // Reset form setelah submit
                $('#modal form')[0].reset();
                $("input[name='user_id']").val('');
                // Kembalikan mode ke Add (default)
                $('#modal h1').text("Tambah Menu");
                $('#modal button[type="submit"]').text("Tambah");
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
                alert('Account gagal diproses');
            }
        });
    });

    // Event handler untuk tombol edit (dengan class .edited)
    $('.edit').on('click', function(e) {
        e.preventDefault();
        let user_id = $(this).data('id');

        // Ambil data detail produk dengan endpoint getDetails
        $.ajax({
            url: 'account/get',
            type: 'POST',
            data: { id: user_id },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success'){
                    const data = response.data[0];
                    // Isi form dengan data yang diambil
                    $("input[name='user_id']").val(data.User_id);
                    $('#username_account').val(data.Username);
                    $('#email').val(data.Email);
                    $('#role').val(data.Role).trigger('change');
                    $('#password').val(data.Password);
                    // Ubah judul modal dan teks tombol submit ke mode edit
                    $('#modal h1').text("Ubah Account");
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
        if(confirm("Apakah Anda yakin ingin menghapus account ini?")) {
            $.ajax({
                url: 'account/' + productId,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alert("Berhasil menghapus Account");
                    $(this).closest('div').fadeOut('slow', function() { $(this).remove(); });
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Gagal menghapus Account:", error);
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>