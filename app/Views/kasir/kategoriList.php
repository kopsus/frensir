<?= $this->extend('templates/index') ?>
<?= $this->section('title') ?>Kategori List<?= $this->endSection() ?>
<?= $this->section('main-content') ?>

<div class="container mx-auto p-6">
    <a href="<?= base_url('kasir/menu-list') ?>">
        <h5 class="text-2xl font-bold text-gray-800 mb-4">⬅️ Kembali</h5>
    </a>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kategori List</h2>

    <!-- Button tambah kategori -->
    <button id="modalAdd" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Kategori</button>

    <!-- Table Kategori -->
    <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">No</th>
                <th class="py-2 px-4 border">Kategori</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($categories as $category): ?>
            <tr class="border">
                <td class="py-2 px-4 border"><?= $no++ ?></td>
                <td class="py-2 px-4 border"><?= $category['Category_name'] ?></td>
                <td class="py-2 px-4 border">
                    <button class="edit px-2 py-1 bg-yellow-500 text-white rounded" data-id="<?= $category['Category_id'] ?>" data-name="<?= $category['Category_name'] ?>">Edit</button>
                    <button class="delete px-2 py-1 bg-red-500 text-white rounded" data-id="<?= $category['Category_id'] ?>">Hapus</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-md w-96">
        <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
        <form id="kategoriForm">
            <input type="hidden" id="category_id" name="Category_id">
            <div class="mb-4">
                <label class="block">Nama Kategori</label>
                <input type="text" id="category_name" name="Category_name" class="w-full border px-2 py-1" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("modalAdd").addEventListener("click", function() {
    document.getElementById("modal").classList.remove("hidden");
    document.getElementById("kategoriForm").reset();
    document.getElementById("category_id").value = "";
});

document.getElementById("closeModal").addEventListener("click", function() {
    document.getElementById("modal").classList.add("hidden");
});

document.getElementById("kategoriForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let id = document.getElementById("category_id").value;
    let formData = new FormData(this);
    let url = id ? "<?= base_url('kasir/kategori/update') ?>" : "<?= base_url('kasir/kategori/add') ?>";

    fetch(url, {
        method: "POST",
        body: formData
    }).then(res => res.json()).then(data => {
        alert(data.message);
        location.reload();
    });
});

document.querySelectorAll(".edit").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById("modal").classList.remove("hidden");
        document.getElementById("category_id").value = this.dataset.id;
        document.getElementById("category_name").value = this.dataset.name;
    });
});

document.querySelectorAll(".delete").forEach(button => {
    button.addEventListener("click", function() {
        if (confirm("Yakin ingin menghapus kategori ini?")) {
            fetch("<?= base_url('kasir/kategori/delete/') ?>" + this.dataset.id, {
                method: "DELETE"
            }).then(res => res.json()).then(data => {
                alert(data.message);
                location.reload();
            });
        }
    });
});
</script>

<?= $this->endSection() ?>