<div class="mb-8" data-aos="fade-in">
  <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-2">PRODUCT MANAGEMENT</h1>
  <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed">
    Kelola katalog produk, harga, diskon, dan pantau ketersediaan stok di gudang.
  </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between">
    <div class="flex justify-between items-start mb-4">
      <h3 class="text-xs font-black uppercase tracking-widest text-black">TOTAL PRODUCTS</h3>
      <div class="w-6 h-6 bg-[#2563EB] text-white flex items-center justify-center border-2 border-black">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
          <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zm-6-8h4v6h-4v-6zm-6 4h4v2H7v-2zm0-4h4v2H7v-2zm0-4h10v2H7V7z" />
        </svg>
      </div>
    </div>
    <div class="text-5xl font-black tracking-tighter mb-4"><?= number_format($data['stats']['total_products'] ?? 0, 0, ',', '.'); ?></div>
    <div><span class="inline-block bg-white text-gray-500 border-2 border-black px-2 py-1 text-[9px] font-black uppercase tracking-widest">RECORDED IN DATABASE</span></div>
  </div>

  <div class="bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between">
    <div class="flex justify-between items-start mb-4">
      <h3 class="text-xs font-black uppercase tracking-widest text-black">OUT OF STOCK</h3>
      <div class="w-6 h-6 text-black flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>
    </div>
    <div class="text-5xl font-black tracking-tighter mb-4"><?= $data['stats']['out_of_stock'] ?? 0; ?></div>
    <div><span class="inline-block bg-black text-[#FFE600] border-2 border-black px-2 py-1 text-[9px] font-black uppercase tracking-widest <?= ($data['stats']['out_of_stock'] ?? 0) > 0 ? 'animate-pulse' : '' ?>">ACTION REQUIRED</span></div>
  </div>

  <div class="bg-[#2563EB] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between text-white">
    <div class="flex justify-between items-start mb-4">
      <h3 class="text-xs font-black uppercase tracking-widest">TOP CATEGORY</h3>
      <div class="w-6 h-6 bg-white text-[#2563EB] flex items-center justify-center rounded-full border-2 border-black">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
        </svg>
      </div>
    </div>
    <div class="text-3xl font-black tracking-tighter mb-4 uppercase line-clamp-2 leading-tight" style="-webkit-text-stroke: 1px black; text-shadow: 2px 2px 0 #000;"><?= htmlspecialchars($data['stats']['top_category'] ?? 'N/A'); ?></div>
    <div><span class="inline-block bg-white text-black border-2 border-black px-2 py-1 text-[9px] font-black uppercase tracking-widest">DOMINANT ENTITY</span></div>
  </div>
</div>

<div class="flex flex-col xl:flex-row justify-between items-start gap-6 mb-8 relative z-20" data-aos="fade-up" data-aos-delay="100">

  <div class="w-full xl:flex-1 flex flex-col md:flex-row items-start gap-4">
    <div class="w-full md:flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
      <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH BY NAME..." class="w-full py-3 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
    </div>

    <div class="w-full md:w-64 relative" id="filterCategoryDropdown">
      <input type="hidden" id="categoryFilter" value="ALL">
      <button type="button" onclick="toggleFilterCategory()" class="w-full py-3 px-4 bg-white border-4 border-black font-black text-xs uppercase flex justify-between items-center shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] focus:outline-none transition-all cursor-pointer">
        <span id="filterCategoryText" class="truncate">ALL CATEGORIES</span>
        <svg class="w-4 h-4 text-black transition-transform shrink-0 ml-2" id="filterCategoryIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>

      <div id="filterCategoryMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-60 overflow-y-auto text-left">
        <div onclick="selectFilterCategory('ALL', 'ALL CATEGORIES')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
          ALL CATEGORIES
        </div>
        <?php foreach ($data['categories'] as $cat) : ?>
          <div onclick="selectFilterCategory('<?= strtoupper($cat['name']) ?>', '<?= strtoupper(addslashes(htmlspecialchars($cat['name']))) ?>')" class="p-3 font-black text-xs uppercase border-b-2 border-black last:border-b-0 hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
            <?= htmlspecialchars($cat['name']) ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <button onclick="resetFilter()" class="w-full md:w-auto bg-white text-black px-8 py-3 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:bg-[#FF5757] hover:text-white hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center justify-center shrink-0">
      RESET
    </button>
  </div>

  <a href="<?= BASEURL; ?>/adminproduct/create" class="w-full xl:w-auto bg-[#2563EB] text-white px-8 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center justify-center shrink-0">
    + TAMBAH PRODUK
  </a>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-6 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest">
        <th class="p-4 border-r-2 border-black w-20 text-center">IMG</th>
        <th class="p-4 border-r-2 border-black">PRODUCT NAME</th>
        <th class="p-4 border-r-2 border-black">CATEGORY_REF</th>
        <th class="p-4 border-r-2 border-black">PRICE</th>
        <th class="p-4 border-r-2 border-black text-center">STOCK_STATUS</th>
        <th class="p-4 text-center w-40">OPS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white" id="tableBody">
      <?php if (empty($data['products'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="6" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            DATABASE KOSONG.
          </td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['products'] as $product):
          $img_src = !empty($product['image_url']) ? (str_starts_with($product['image_url'], 'http') ? $product['image_url'] : BASEURL . '/img/products/' . $product['image_url']) : BASEURL . '/img/products/placeholder.png';

          $stock = (int)$product['total_stock'];
          if ($stock <= 0) {
            $badgeColor = 'bg-[#FF5757] text-white';
            $badgeText = 'OUT OF STOCK';
          } elseif ($stock < 5) {
            $badgeColor = 'bg-[#FFE600] text-black';
            $badgeText = "CRITICAL ($stock)";
          } else {
            $badgeColor = 'bg-[#A6FAAE] text-black';
            $badgeText = "IN STOCK ($stock)";
          }
          $sku = 'PRD-' . str_pad((string)$product['id'], 4, '0', STR_PAD_LEFT);
        ?>
          <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors product-row">
            <td class="p-4 border-r-2 border-black">
              <div class="w-12 h-12 border-2 border-black bg-gray-200 shadow-[2px_2px_0_0_#000] overflow-hidden">
                <img src="<?= $img_src ?>" class="w-full h-full object-cover grayscale-[30%]">
              </div>
            </td>
            <td class="p-4 border-r-2 border-black">
              <span class="product-name-text font-black text-[#2563EB] text-sm block uppercase leading-tight line-clamp-1"><?= htmlspecialchars($product['name']); ?></span>
              <span class="text-[9px] font-black text-gray-500 tracking-widest block mt-0.5">ID: <?= $sku ?> | WGT: <?= $product['weight_grams'] ?>g</span>
            </td>
            <td class="product-category-text p-4 border-r-2 border-black text-xs font-black uppercase">
              <?= htmlspecialchars($product['category_name'] ?? 'UNCATEGORIZED'); ?>
            </td>
            <td class="p-4 border-r-2 border-black font-black text-sm">
              <span class="mr-1">Rp</span><?= number_format((float)$product['price'], 0, ',', '.'); ?>
              <?php if (!empty($product['discount_price'])): ?>
                <div class="text-[9px] text-[#FF5757] line-through mt-0.5">Rp <?= number_format((float)$product['discount_price'], 0, ',', '.'); ?></div>
              <?php endif; ?>
            </td>
            <td class="p-4 border-r-2 border-black text-center">
              <span class="inline-block border-2 border-black px-2 py-1 text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000] <?= $badgeColor ?>">
                <?= $badgeText ?>
              </span>
            </td>
            <td class="p-4 flex items-center justify-center space-x-2 h-full pt-5">

              <button onclick="openSpecModal(<?= $product['id'] ?>, '<?= htmlspecialchars(addslashes($product['name'])) ?>')" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="SPECS">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </button>

              <button data-product='<?= htmlspecialchars(json_encode($product, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), ENT_QUOTES, 'UTF-8') ?>' onclick="openEditModal(this)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="EDIT">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
              </button>

              <button onclick="deleteProduct(<?= $product['id']; ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="DELETE">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </button>

            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="6" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">
          <div class="flex flex-col items-center justify-center">
            <svg class="w-16 h-16 mb-4 text-[#FF5757]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            PRODUK TIDAK DITEMUKAN.
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper">
  <div class="text-xs font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">SHOWING 0 OF 0 ENTRIES</div>
  <div class="flex items-center gap-2" id="paginationControls"></div>
</div>

<div id="editProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-5xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <div>
        <h2 class="text-2xl font-black uppercase tracking-widest">EDIT_PRODUCT.SYS</h2>
        <p class="text-[10px] font-bold uppercase tracking-widest opacity-80">System.Products.Update()</p>
      </div>
      <button onclick="closeModal('editProductModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="editForm" action="<?= BASEURL; ?>/adminproduct/updateProduct" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="edit_id">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

          <div class="lg:col-span-7 space-y-5">
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest text-black">NAMA PRODUK</label>
              <input type="text" name="name" id="edit_name" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-black">HARGA (Rp)</label>
                <input type="number" name="price" id="edit_price" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
              </div>
              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-black">HARGA DISKON (OPTIONAL)</label>
                <input type="number" name="discount_price" id="edit_discount" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-black">KATEGORI PRODUK</label>
                <div class="relative" id="editCustomCategoryDropdown">
                  <input type="hidden" name="category_id" id="edit_hiddenCategoryInput" required>
                  <button type="button" onclick="toggleEditCategory()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
                    <span id="editCategorySelectedText" class="text-black line-clamp-1">-- SELECT CATEGORY --</span>
                    <svg class="w-4 h-4 text-black transition-transform shrink-0" id="editCategoryIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </button>
                  <div id="editCategoryMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-40 overflow-y-auto">
                    <?php foreach ($data['categories'] as $cat) : ?>
                      <div onclick="selectEditCategory('<?= $cat['id'] ?>', '<?= addslashes(htmlspecialchars($cat['name'])) ?>')" class="p-4 font-black uppercase border-b-2 border-black last:border-b-0 hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                        <?= htmlspecialchars($cat['name']) ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-black">BERAT (GRAMS)</label>
                <input type="number" name="weight_grams" id="edit_weight" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
              </div>
            </div>

            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest text-black">STATUS PRODUK</label>
              <div class="relative" id="editCustomStatusDropdown">
                <input type="hidden" name="is_active" id="edit_hiddenStatusInput" required>
                <button type="button" onclick="toggleEditStatus()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
                  <span id="editStatusSelectedText" class="text-black">ACTIVE / PUBLISHED</span>
                  <svg class="w-4 h-4 text-black transition-transform shrink-0" id="editStatusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>
                <div id="editStatusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-40 overflow-y-auto">
                  <div onclick="selectEditStatus('1', 'ACTIVE / PUBLISHED')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                    ACTIVE / PUBLISHED
                  </div>
                  <div onclick="selectEditStatus('0', 'DRAFT / HIDDEN')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                    DRAFT / HIDDEN
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="lg:col-span-5 space-y-5">
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest text-black">UBAH FOTO (OPTIONAL)</label>
              <div class="border-4 border-dashed border-black bg-[#F8F9FA] p-6 text-center hover:bg-[#FFE600] transition-colors relative cursor-pointer group focus-within:bg-white focus-within:shadow-[4px_4px_0_0_#2563EB] focus-within:-translate-y-1">
                <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <svg class="w-8 h-8 mx-auto mb-2 text-black group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                </svg>
                <h4 class="font-black uppercase text-[10px] mb-1">UPLOAD NEW IMAGE</h4>
              </div>
            </div>

            <div class="space-y-2 h-full pb-4">
              <label class="text-[10px] font-black uppercase tracking-widest text-black">DESKRIPSI PRODUK</label>
              <textarea name="description" id="edit_description" rows="7" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all resize-y"></textarea>
            </div>
          </div>

        </div>

        <div class="flex gap-4 pt-4 mt-4 border-t-4 border-black">
          <button type="button" onclick="closeModal('editProductModal')" class="flex-1 bg-white border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all py-4">ABORT</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all py-4">UPDATE RECORD</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="specModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-3xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-black text-white">
      <div>
        <h2 class="text-2xl font-black uppercase tracking-widest">SPESIFIKASI</h2>
        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400" id="specProductName">MANAGE PRODUCT SPECS</p>
      </div>
      <button onclick="closeModal('specModal')" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>
    <div class="p-8">

      <form id="addSpecForm" action="<?= BASEURL; ?>/adminproduct/storeSpecs" method="POST" class="flex flex-col md:flex-row gap-4 mb-8 bg-[#F8F9FA] p-6 border-4 border-black">
        <input type="hidden" name="product_id" id="spec_product_id">
        <input type="text" name="spec_name" placeholder="Nama (Cth: RAM)" required class="flex-1 p-4 bg-white border-4 border-black font-bold uppercase focus:outline-none focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
        <input type="text" name="spec_value" placeholder="Nilai (Cth: 16GB)" required class="flex-1 p-4 bg-white border-4 border-black font-bold focus:outline-none focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
        <button type="submit" class="bg-black text-white px-8 font-black uppercase text-xl border-4 border-black hover:-translate-y-1 shadow-[4px_4px_0_0_#000] hover:shadow-[6px_6px_0_0_#000] transition-all">+</button>
      </form>

      <div class="border-4 border-black bg-white overflow-hidden max-h-64 overflow-y-auto shadow-[4px_4px_0_0_#000]">
        <table class="w-full text-left border-collapse">
          <tbody id="specTableBody" class="text-sm font-bold text-black"></tbody>
        </table>
      </div>

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
    <p class="text-sm font-bold text-white mb-6">Yakin hapus data ini secara permanen?</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">BATAL</button>
      <button onclick="executeDeleteSpec()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">HAPUS</button>
    </div>
  </div>
</div>

<div id="confirmDeleteProductModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">WARNING!</h2>
    <p class="text-sm font-bold text-white mb-6">Yakin hapus produk ini secara permanen dari database?</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteProductModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">BATAL</button>
      <button onclick="executeDeleteProduct()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">HAPUS</button>
    </div>
  </div>
</div>

<div id="successModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-black mb-2">SUCCESS!</h2>
    <p id="successMessage" class="text-sm font-bold text-black mb-6">Operasi berhasil dilakukan.</p>
    <button onclick="reloadPage()" class="w-full bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">OK, LANJUTKAN</button>
  </div>
</div>

<div id="errorModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">ERROR!</h2>
    <p id="errorMessage" class="text-sm font-bold text-white mb-6">Terjadi kesalahan.</p>
    <button onclick="closeModal('errorModal')" class="w-full bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">TUTUP</button>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['products']) ? 'false' : 'true'; ?>;
  const BASEURL = '<?= BASEURL; ?>';
</script>
<script src="<?= BASEURL; ?>/js/admin_products.js?v=<?= time(); ?>"></script>