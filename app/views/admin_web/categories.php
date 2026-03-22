<div class="mb-8" data-aos="fade-in">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">CATEGORIES MANAGEMENT</h1>


    <div class="flex gap-4">
      <button onclick="reloadPage()" class="bg-white text-black px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        REFRESH
      </button>
      <button onclick="openModal('addCategoryModal')" class="bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        + ADD NEW CATEGORY
      </button>
    </div>
  </div>
  <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
    Kelola daftar kategori produk, unggah ikon visual, dan pantau jumlah produk di setiap klasifikasi.
  </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">TOTAL CATEGORIES</h3>
    <div class="text-5xl font-black tracking-tighter text-black mb-2"><?= str_pad((string)($data['stats']['total_categories'] ?? 0), 2, '0', STR_PAD_LEFT) ?></div>
    <div class="text-[10px] font-black text-[#2563EB] uppercase tracking-widest flex items-center">
      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
      </svg>
      CREATED
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">ACTIVE CATEGORIES</h3>
    <div class="text-5xl font-black tracking-tighter text-black mb-2"><?= str_pad((string)($data['stats']['active_categories'] ?? 0), 2, '0', STR_PAD_LEFT) ?></div>
    <div class="text-[10px] font-black text-[#00C853] uppercase tracking-widest flex items-center">
      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
      </svg>
      ACTIVE
    </div>
  </div>

  <div class="bg-[#2563EB] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 text-white">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-blue-200 mb-4">TOTAL PRODUCTS INDEXED</h3>
    <div class="text-5xl font-black tracking-tighter mb-2"><?= str_pad((string)($data['stats']['total_products_indexed'] ?? 0), 2, '0', STR_PAD_LEFT) ?></div>
    <div class="text-[10px] font-black text-white uppercase tracking-widest flex items-center">
      <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
      </svg>
      ITEMS
    </div>
  </div>

</div>

<div class="flex flex-col md:flex-row gap-4 mb-6 relative z-20" data-aos="fade-up" data-aos-delay="100">
  <div class="flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
    <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH CATEGORY NAME OR SLUG..." class="w-full py-4 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
  </div>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-6 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[900px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest border-b-4 border-black">
        <th class="p-5 border-r-2 border-black w-24 text-center">ICON</th>
        <th class="p-5 border-r-2 border-black">CATEGORY_NAME</th>
        <th class="p-5 border-r-2 border-black">SLUG_ID</th>
        <th class="p-5 border-r-2 border-black text-center">PRODUCT_COUNT</th>
        <th class="p-5 border-r-2 border-black text-center">STATUS</th>
        <th class="p-5 text-center w-32">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black" id="tableBody">

      <?php if (empty($data['categories'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="6" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            NO CATEGORIES FOUND IN DATABASE.
          </td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['categories'] as $cat):
          // Icon handling
          $icon_src = !empty($cat['icon']) ? BASEURL . '/img/categories/' . $cat['icon'] : '';

          // Status Handling (Jika product count > 0 maka active)
          $isActive = ($cat['product_count'] ?? 0) > 0;
          $statusColor = $isActive ? 'bg-[#A6FAAE]' : 'bg-[#FF5757]';
          $statusText = $isActive ? 'ACTIVE' : 'INACTIVE';
        ?>
          <tr class="border-b-2 border-black hover:bg-[#F8F9FA] transition-colors category-row">

            <td class="p-4 border-r-2 border-black flex justify-center">
              <div class="w-10 h-10 border-2 border-black bg-gray-100 flex items-center justify-center shadow-[2px_2px_0_0_#000]">
                <?php if ($icon_src): ?>
                  <img src="<?= $icon_src ?>" class="w-6 h-6 object-contain grayscale-[50%]">
                <?php else: ?>
                  <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4"></path>
                  </svg>
                <?php endif; ?>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-black text-sm block uppercase leading-tight category-name-text"><?= htmlspecialchars($cat['name']) ?></span>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-mono text-xs text-gray-500">/<?= htmlspecialchars($cat['slug']) ?></span>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <span class="inline-block bg-black text-white px-3 py-1 text-xs font-black shadow-[2px_2px_0_0_#A6FAAE]">
                <?= number_format($cat['product_count'] ?? 0) ?>
              </span>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <span class="inline-block border-2 border-black px-2 py-1 <?= $statusColor ?> text-black text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">
                <?= $statusText ?>
              </span>
            </td>

            <td class="p-4">
              <div class="flex items-center justify-center space-x-2">
                <button data-cat='<?= htmlspecialchars(json_encode($cat, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), ENT_QUOTES, 'UTF-8') ?>' onclick="openEditModal(this)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                  </svg>
                </button>
                <button onclick="deleteCategory(<?= $cat['id']; ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="6" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">
          SYSTEM ERROR: CATEGORY_NOT_FOUND.
        </td>
      </tr>

    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper">
  <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">SHOWING 0 OF 0 CATEGORIES</div>
  <div class="flex items-center gap-2 text-black" id="paginationControls"></div>
</div>

<div id="addCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
      <h2 class="text-2xl font-black uppercase tracking-widest">ADD CATEGORY</h2>
      <button onclick="closeModal('addCategoryModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="addForm" action="<?= BASEURL; ?>/admincategory/store" method="POST" enctype="multipart/form-data" class="space-y-5">
        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">CATEGORY NAME</label>
          <input type="text" name="name" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
        </div>
        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">ICON (OPTIONAL)</label>
          <input type="file" name="icon" accept="image/*" class="w-full p-3 bg-[#F8F9FA] border-4 border-dashed border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
        </div>
        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('addCategoryModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">ADD</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <h2 class="text-2xl font-black uppercase tracking-widest">EDIT CATEGORY</h2>
      <button onclick="closeModal('editCategoryModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="editForm" action="<?= BASEURL; ?>/admincategory/update" method="POST" enctype="multipart/form-data" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">
        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">CATEGORY NAME</label>
          <input type="text" name="name" id="edit_name" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
        </div>
        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">UPDATE ICON (OPTIONAL)</label>
          <input type="file" name="icon" accept="image/*" class="w-full p-3 bg-[#F8F9FA] border-4 border-dashed border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
        </div>
        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('editCategoryModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="confirmDeleteModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">WARNING!</h2>
    <p class="text-sm font-bold text-white mb-6">Hapus kategori ini? Produk yang terkait akan menjadi "Tanpa Kategori".</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
      <button onclick="executeDeleteCategory()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">DELETE</button>
    </div>
  </div>
</div>

<div id="successModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-black mb-2">SUCCESS!</h2>
    <p id="successMessage" class="text-sm font-bold text-black mb-6">Operasi berhasil dilakukan.</p>
    <button onclick="reloadPage()" class="w-full bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">OK</button>
  </div>
</div>

<div id="errorModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-white mb-2">ERROR!</h2>
    <p id="errorMessage" class="text-sm font-bold text-white mb-6">Terjadi kesalahan.</p>
    <button onclick="closeModal('errorModal')" class="w-full bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">TUTUP</button>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['categories']) ? 'false' : 'true'; ?>;
  const BASEURL = '<?= BASEURL; ?>';
</script>
<script src="<?= BASEURL; ?>/js/admin_categories.js?v=<?= time(); ?>"></script>