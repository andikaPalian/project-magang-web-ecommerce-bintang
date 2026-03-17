<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end pb-4 gap-4" data-aos="fade-in">
  <div>
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-2">PRODUCT MANAGEMENT</h1>
    <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed">
      Kelola katalog produk, harga, diskon, dan pantau ketersediaan stok di gudang.
    </p>
  </div>

  <button onclick="openModal('addProductModal')" class="bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center shrink-0">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
    </svg>
    ADD NEW PRODUCT
  </button>
</div>

<div class="flex flex-wrap gap-4 mb-6" data-aos="fade-up">
  <div class="relative inline-block">
    <select id="categoryFilter" onchange="filterTable()" class="appearance-none bg-black text-white px-4 py-3 pr-10 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] hover:bg-gray-800 cursor-pointer outline-none transition-all">
      <option value="ALL">ALL CATEGORIES</option>
      <?php foreach ($data['categories'] as $cat) : ?>
        <option value="<?= strtoupper($cat['name']) ?>"><?= strtoupper($cat['name']) ?></option>
      <?php endforeach; ?>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </div>

  <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH PRODUCT NAME..." class="bg-white text-black px-4 py-3 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] focus:outline-none focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all w-72">

  <div class="flex-1"></div>

  <button onclick="resetFilter()" class="bg-white text-black px-6 py-3 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-[#FF5757] hover:text-white transition-all">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
    </svg>
    RESET
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-6" data-aos="fade-up" data-aos-delay="100">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest">
        <th class="p-5 border-r-2 border-black w-2/5">PRODUCT DETAILS</th>
        <th class="p-5 border-r-2 border-black">PRICING</th>
        <th class="p-5 border-r-2 border-black text-center">STOCK & WGT</th>
        <th class="p-5 border-r-2 border-black text-center">STATUS</th>
        <th class="p-5 text-center">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white" id="tableBody">

      <?php if (empty($data['products'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="5" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            <div class="flex flex-col items-center justify-center">
              <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
              BELUM ADA PRODUK DI KATALOG.
            </div>
          </td>
        </tr>
      <?php else : ?>

        <?php foreach ($data['products'] as $product):
          // Logika Path Gambar (Bisa URL http atau path lokal)
          $imgSrc = str_starts_with($product['image_url'] ?? '', 'http') ? $product['image_url'] : BASEURL . '/img/products/' . ($product['image_url'] ?? 'placeholder.png');

          // Format Rupiah
          $price = 'Rp ' . number_format((float)$product['price'], 0, ',', '.');
          $discountPrice = $product['discount_price'] > 0 ? 'Rp ' . number_format((float)$product['discount_price'], 0, ',', '.') : null;
        ?>
          <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors product-row">

            <td class="p-4 border-r-2 border-black">
              <div class="flex items-center">
                <img src="<?= $imgSrc ?>" alt="Product" class="w-14 h-14 object-cover border-2 border-black mr-4 shadow-[3px_3px_0_0_#000] shrink-0 bg-gray-100">
                <div>
                  <span class="font-black text-sm block leading-tight truncate max-w-xs"><?= htmlspecialchars($product['name']) ?></span>
                  <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mt-1 product-category">
                    <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
                  </span>
                </div>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black">
              <?php if ($discountPrice) : ?>
                <span class="text-xs text-gray-400 line-through block"><?= $price ?></span>
                <span class="font-black text-[#FF5757] text-sm block"><?= $discountPrice ?></span>
              <?php else : ?>
                <span class="font-black text-sm block"><?= $price ?></span>
              <?php endif; ?>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <div class="font-black text-sm"><?= $product['total_stock'] ?> Pcs</div>
              <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-0.5"><?= number_format($product['weight_grams']) ?>g</div>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <?php if ($product['is_active']) : ?>
                <span class="inline-block border-2 border-[#00C853] text-[#00C853] px-2 py-1 text-[9px] font-black uppercase tracking-widest bg-green-50">ACTIVE</span>
              <?php else : ?>
                <span class="inline-block border-2 border-gray-500 text-gray-500 px-2 py-1 text-[9px] font-black uppercase tracking-widest bg-gray-100">DRAFT</span>
              <?php endif; ?>
            </td>

            <td class="p-4 flex items-center justify-center space-x-3">
              <button onclick="openEditModal(<?= htmlspecialchars(json_encode($product)) ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="EDIT PRODUCT">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>

              <a href="<?= BASEURL; ?>/adminproduct/deleteProduct/<?= $product['id'] ?>" onclick="return confirm('Hapus produk ini dari katalog?');" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="DELETE PRODUCT">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="5" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">
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

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper" data-aos="fade-up" data-aos-delay="200">
  <div class="text-xs font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">
    SHOWING 0 OF 0 PRODUCTS
  </div>
  <div class="flex items-center gap-2" id="paginationControls">
  </div>
</div>


<div id="addProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-3xl relative my-auto" data-aos="zoom-in" data-aos-duration="300">

    <button onclick="closeModal('addProductModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors z-10">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">ADD NEW PRODUCT</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">PRODUCT CATALOG ENTRY FORM</p>

      <form action="<?= BASEURL; ?>/adminproduct/storeProduct" method="POST" enctype="multipart/form-data" class="space-y-5">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">PRODUCT NAME</label>
          <input type="text" name="name" required placeholder="e.g. Laptop ASUS ROG..." class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">CATEGORY</label>
            <div class="relative">
              <select name="category_id" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
                <option value="" disabled selected>-- Select Category --</option>
                <?php foreach ($data['categories'] as $cat) : ?>
                  <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">WEIGHT (GRAMS)</label>
            <input type="number" name="weight_grams" required placeholder="e.g. 1500" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">NORMAL PRICE (Rp)</label>
            <input type="number" name="price" required placeholder="e.g. 15000000" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">DISCOUNT PRICE (OPTIONAL)</label>
            <input type="number" name="discount_price" placeholder="Leave empty if no discount" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">PRODUCT IMAGE (JPG/PNG/WEBP)</label>
            <input type="file" name="image" accept="image/*" class="w-full p-2.5 bg-white border-2 border-black text-black font-bold cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all file:mr-4 file:py-1 file:px-4 file:border-2 file:border-black file:text-xs file:font-black file:bg-black file:text-white hover:file:bg-gray-800">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">STATUS</label>
            <div class="relative">
              <select name="is_active" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
                <option value="1">ACTIVE (Published)</option>
                <option value="0">DRAFT (Hidden)</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">PRODUCT DESCRIPTION</label>
          <textarea name="description" rows="4" required placeholder="Describe the product details here..." class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all"></textarea>
        </div>

        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="button" onclick="closeModal('addProductModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">SAVE PRODUCT</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-3xl relative my-auto" data-aos="zoom-in" data-aos-duration="300">

    <button onclick="closeModal('editProductModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors z-10">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">EDIT PRODUCT</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">UPDATE PRODUCT INFORMATION</p>

      <form action="<?= BASEURL; ?>/adminproduct/updateProduct" method="POST" enctype="multipart/form-data" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">PRODUCT NAME</label>
          <input type="text" name="name" id="edit_name" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">CATEGORY</label>
            <div class="relative">
              <select name="category_id" id="edit_category_id" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
                <?php foreach ($data['categories'] as $cat) : ?>
                  <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">WEIGHT (GRAMS)</label>
            <input type="number" name="weight_grams" id="edit_weight" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">NORMAL PRICE (Rp)</label>
            <input type="number" name="price" id="edit_price" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">DISCOUNT PRICE (OPTIONAL)</label>
            <input type="number" name="discount_price" id="edit_discount" placeholder="Empty = No discount" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">UPDATE IMAGE (OPTIONAL)</label>
            <input type="file" name="image" accept="image/*" class="w-full p-2.5 bg-white border-2 border-black text-black font-bold cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all file:mr-4 file:py-1 file:px-4 file:border-2 file:border-black file:text-xs file:font-black file:bg-black file:text-white hover:file:bg-gray-800">
            <span class="text-[9px] text-gray-500 font-bold block mt-1">*Abaikan jika tidak ingin ganti foto</span>
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">STATUS</label>
            <div class="relative">
              <select name="is_active" id="edit_status" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
                <option value="1">ACTIVE (Published)</option>
                <option value="0">DRAFT (Hidden)</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">PRODUCT DESCRIPTION</label>
          <textarea name="description" id="edit_description" rows="4" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all"></textarea>
        </div>

        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="button" onclick="closeModal('editProductModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE PRODUCT</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['products']) ? 'false' : 'true'; ?>;
</script>
<script src="<?= BASEURL; ?>/js/admin_products.js"></script>