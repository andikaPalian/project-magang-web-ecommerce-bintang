<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end pb-4 gap-4" data-aos="fade-in">
  <div>
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-2">CATEGORY MGT.</h1>
    <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed">
      Kelola daftar kategori produk, unggah ikon visual, dan pantau jumlah produk di setiap klasifikasi.
    </p>
  </div>

  <button onclick="openModal('addCategoryModal')" class="bg-[#FFE600] text-black px-6 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center shrink-0">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
      <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
    </svg>
    ADD CATEGORY
  </button>
</div>

<?php if (isset($_SESSION['flash_success'])): ?>
  <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center" data-aos="fade-down">
    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>
    <p><?= $_SESSION['flash_success']; ?></p>
  </div>
  <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
  <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center" data-aos="fade-down">
    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
    <p><?= $_SESSION['flash_error']; ?></p>
  </div>
  <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>
<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-10" data-aos="fade-up" data-aos-delay="100">
  <table class="w-full text-left border-collapse min-w-[700px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest">
        <th class="p-5 border-r-2 border-black w-24 text-center">ICON</th>
        <th class="p-5 border-r-2 border-black">CATEGORY INFO</th>
        <th class="p-5 border-r-2 border-black text-center">TOTAL PRODUCTS</th>
        <th class="p-5 text-center w-32">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white">

      <?php if (empty($data['categories'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="4" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            <div class="flex flex-col items-center justify-center">
              <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              BELUM ADA KATEGORI TERDAFTAR.
            </div>
          </td>
        </tr>
      <?php else : ?>

        <?php foreach ($data['categories'] as $cat): ?>
          <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">

            <td class="p-4 border-r-2 border-black text-center">
              <div class="w-12 h-12 border-2 border-black bg-gray-100 mx-auto overflow-hidden shadow-[2px_2px_0_0_#000] flex items-center justify-center">
                <?php if (!empty($cat['icon'])): ?>
                  <img src="<?= BASEURL; ?>/img/categories/<?= $cat['icon']; ?>" class="w-full h-full object-cover" alt="Icon">
                <?php else: ?>
                  <span class="text-[10px] text-gray-400 font-black">N/A</span>
                <?php endif; ?>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-black text-base block uppercase leading-tight"><?= htmlspecialchars($cat['name']); ?></span>
              <span class="text-[10px] font-black text-gray-500 tracking-widest block mt-1 bg-gray-200 inline-block px-2 py-0.5">/<?= htmlspecialchars($cat['slug']); ?></span>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <span class="text-2xl font-black <?= ($cat['product_count'] > 0) ? 'text-[#2563EB]' : 'text-gray-400' ?>">
                <?= $cat['product_count']; ?>
              </span>
              <span class="text-[9px] block uppercase tracking-widest text-gray-500">ITEMS</span>
            </td>

            <td class="p-4 flex items-center justify-center space-x-3 h-full pt-6">
              <button onclick="openEditModal(<?= htmlspecialchars(json_encode($cat)); ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="EDIT">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>

              <a href="<?= BASEURL; ?>/admincategory/delete/<?= $cat['id']; ?>" onclick="return confirm('Hapus kategori ini? Produk di dalamnya tidak akan terhapus, tapi status kategorinya akan menjadi Kosong (Uncategorized).');" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="DELETE">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </a>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

    </tbody>
  </table>
</div>

<div id="addCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative" data-aos="zoom-in" data-aos-duration="300">
    <button onclick="closeModal('addCategoryModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">X</button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">ADD CATEGORY</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">BUAT KLASIFIKASI PRODUK BARU</p>

      <form action="<?= BASEURL; ?>/admincategory/store" method="POST" enctype="multipart/form-data" class="space-y-5">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">NAMA KATEGORI</label>
          <input type="text" name="name" required placeholder="Contoh: Laptop Gaming" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">IKON / GAMBAR (OPSIONAL)</label>
          <input type="file" name="icon" accept="image/png, image/jpeg, image/jpg" class="w-full p-2 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:text-xs file:font-black file:bg-[#A6FAAE] hover:file:bg-[#2563EB] hover:file:text-white cursor-pointer">
          <p class="text-[9px] font-bold text-gray-500 mt-1 uppercase">Maksimal 5MB. Format: JPG, JPEG, PNG.</p>
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('addCategoryModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">BATAL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">SIMPAN</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative" data-aos="zoom-in" data-aos-duration="300">
    <button onclick="closeModal('editCategoryModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">X</button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">EDIT CATEGORY</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">PERBARUI DATA KLASIFIKASI</p>

      <form action="<?= BASEURL; ?>/admincategory/update" method="POST" enctype="multipart/form-data" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">NAMA KATEGORI</label>
          <input type="text" name="name" id="edit_name" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">GANTI IKON (BIARKAN KOSONG JIKA TIDAK INGIN GANTI)</label>
          <input type="file" name="icon" accept="image/png, image/jpeg, image/jpg" class="w-full p-2 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:text-xs file:font-black file:bg-[#A6FAAE] hover:file:bg-[#2563EB] hover:file:text-white cursor-pointer">
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('editCategoryModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">BATAL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal(modalId) {
    document.getElementById(modalId).classList.remove("hidden");
    document.getElementById(modalId).classList.add("flex");
    document.body.style.overflow = "hidden";
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
    document.getElementById(modalId).classList.remove("flex");
    document.body.style.overflow = "auto";
  }

  function openEditModal(categoryData) {
    document.getElementById("edit_id").value = categoryData.id;
    document.getElementById("edit_name").value = categoryData.name;

    openModal("editCategoryModal");
  }
</script>