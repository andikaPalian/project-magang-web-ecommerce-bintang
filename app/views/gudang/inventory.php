<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-6" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">INVENTORY</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola stok barang di gudang.
      </p>
    </div>

    <div class="mt-4 md:mt-0">
      <a href="<?= BASEURL; ?>/adminproduct/create" class="bg-[#FFE600] text-black px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
        </svg>
        ADD NEW PRODUCT
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-center relative">
      <h3 class="text-sm font-black border-b-4 border-black pb-2 mb-4">INFO</h3>
      <div class="flex justify-between items-center mb-4">
        <span class="text-xs font-black">TOTAL PRODUCTS</span>
        <span class="bg-black text-white px-3 py-1 font-black text-lg"><?= str_pad((string)$data['stats']['total_products'], 2, '0', STR_PAD_LEFT) ?></span>
      </div>
      <div class="flex justify-between items-center">
        <span class="text-xs font-black">ITEMS OUT OF STOCK</span>
        <span class="bg-[#FF5757] border-2 border-black text-white px-3 py-1 font-black text-lg shadow-[2px_2px_0_0_#000]"><?= str_pad((string)$data['stats']['out_of_stock'], 2, '0', STR_PAD_LEFT) ?></span>
      </div>
    </div>

    <div class="lg:col-span-2 bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex items-start gap-4">
      <div class="bg-black text-white w-12 h-12 flex items-center justify-center font-black text-2xl shrink-0 border-2 border-white shadow-[4px_4px_0_0_#000]">✓</div>
      <div>
        <h3 class="text-lg font-black tracking-tight mb-1">INVENTORY ACCESS GRANTED</h3>
        <p class="text-xs font-bold leading-relaxed text-black/80">
          Staf gudang berwenang penuh untuk <span class="bg-black text-[#A6FAAE] px-1">MENDAFTARKAN BARANG MASUK</span>, melakukan <span class="bg-black text-[#A6FAAE] px-1">SINKRONISASI STOK FISIK</span>, dan <span class="bg-black text-[#A6FAAE] px-1">MENGHAPUS</span> data barang rusak.
        </p>
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">
    <div class="bg-black text-white p-3 flex justify-between items-center border-b-4 border-black">
      <div class="text-xs font-black">PRODUCT LIST</div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-gray-100 border-b-4 border-black font-black text-[10px] text-gray-600">
          <tr>
            <th class="p-4 border-r-2 border-black w-32">PRODUCT ID</th>
            <th class="p-4 border-r-2 border-black">ITEM DESCRIPTION</th>
            <th class="p-4 border-r-2 border-black w-40 text-center">CATEGORY</th>
            <th class="p-4 border-r-2 border-black w-32 text-center">STOCK</th>
            <th class="p-4 text-center w-64">ACTIONS</th>
          </tr>
        </thead>
        <tbody class="font-bold">
          <?php if (empty($data['products'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black bg-gray-50 border-b-4 border-black uppercase">DATABASE EMPTY.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['products'] as $product):
              $img_src = !empty($product['image_url']) ? (str_starts_with($product['image_url'], 'http') ? $product['image_url'] : BASEURL . '/img/products/' . $product['image_url']) : BASEURL . '/img/products/placeholder.png';
            ?>

              <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                <td class="p-4 border-r-2 border-black"><span class="font-black text-sm text-gray-600">PRD-<?= str_pad((string)$product['id'], 4, '0', STR_PAD_LEFT) ?></span></td>
                <td class="p-4 border-r-2 border-black">
                  <div class="flex items-center">
                    <img src="<?= $img_src ?>" class="w-10 h-10 object-cover border-2 border-black mr-3 shadow-[2px_2px_0_0_#000]">
                    <div>
                      <span class="font-black text-sm block"><?= htmlspecialchars($product['name']) ?></span>
                      <span class="text-[9px] text-gray-500 font-mono"><?= number_format((float)$product['weight_grams'], 0) ?> GRAMS</span>
                    </div>
                  </div>
                </td>
                <td class="p-4 border-r-2 border-black text-center text-[10px] font-black"><?= htmlspecialchars($product['category_name'] ?? 'UNCATEGORIZED') ?></td>
                <td class="p-4 border-r-2 border-black text-center">
                  <?php if ($product['total_stock'] <= 0): ?>
                    <span class="inline-block border-2 border-black px-3 py-1 bg-[#FF5757] text-white text-[12px] font-black animate-pulse shadow-[2px_2px_0_0_#000]">00</span>
                  <?php else: ?>
                    <span class="text-xl font-black text-[#2563EB]"><?= str_pad((string)$product['total_stock'], 2, '0', STR_PAD_LEFT) ?></span>
                  <?php endif; ?>
                </td>
                <td class="p-4 text-center">
                  <div class="flex justify-center items-center gap-2 h-full">
                    <button onclick="openSyncModal('<?= $product['id'] ?>', '<?= htmlspecialchars(addslashes($product['name'])) ?>', '<?= $product['total_stock'] ?>')" class="flex-1 bg-white border-2 border-black py-2 shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 text-[9px] font-black flex justify-center items-center">UPDATE STOCK</button>
                    <button onclick="openEditModal('<?= $product['id'] ?>', '<?= htmlspecialchars(addslashes($product['name'])) ?>', '<?= $product['category_id'] ?? '' ?>', '<?= $product['weight_grams'] ?>')" class="w-8 h-8 flex items-center justify-center bg-[#2563EB] text-white border-2 border-black hover:-translate-y-0.5 shadow-[2px_2px_0_0_#000] transition-all">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                      </svg>
                    </button>
                    <button type="button" onclick="confirmDeleteProduct('<?= $product['id'] ?>')" class="w-8 h-8 flex items-center justify-center bg-[#FF5757] text-white border-2 border-black hover:-translate-y-0.5 shadow-[2px_2px_0_0_#000] transition-all">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="syncModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
      <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
        <h2 class="text-2xl font-black uppercase tracking-widest">STOCK_SYNC.EXE</h2>
        <button onclick="closeSyncModal()" class="bg-white text-black border-4 border-black w-10 h-10 font-black text-xl hover:bg-[#FF5757] hover:text-white transition-all shadow-[4px_4px_0_0_#000]">X</button>
      </div>
      <div class="p-8">
        <p class="text-sm font-bold mb-4">Pembaruan: <span id="syncProductName" class="text-[#2563EB]">...</span></p>
        <form action="<?= BASEURL; ?>/adminproduct/quickUpdateStock" method="POST">
          <input type="hidden" name="product_id" id="syncProductId">
          <div class="border-l-4 border-black pl-4 py-2 bg-gray-50 mb-6">
            <p class="text-[10px] font-black text-gray-500 uppercase">NEW PHYSICAL QTY:</p>
            <input type="number" name="total_stock" id="syncStockInput" min="0" required class="w-full text-3xl font-black bg-transparent border-b-4 border-black outline-none focus:border-[#2563EB] pb-2">
          </div>
          <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
            <button type="button" onclick="closeSyncModal()" class="flex-1 bg-white border-4 border-black py-4 font-black shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">ABORT</button>
            <button type="submit" class="flex-1 bg-[#FFE600] border-4 border-black py-4 font-black shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all uppercase">EXECUTE SYNC</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
      <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white uppercase font-black">
        <h2>EDIT_PHYSICAL_DATA.EXE</h2>
        <button onclick="closeEditModal()" class="bg-white text-black border-4 border-black w-10 h-10 shadow-[4px_4px_0_0_#000]">X</button>
      </div>
      <div class="p-8">
        <form action="<?= BASEURL; ?>/adminproduct/quickUpdateInventory" method="POST" class="space-y-4">
          <input type="hidden" name="id" id="editProductId">
          <div>
            <label class="text-[10px] font-black uppercase text-gray-500">NAMA FISIK</label>
            <input type="text" name="name" id="editProductName" required class="w-full mt-1 p-3 bg-gray-50 border-4 border-black font-black uppercase text-sm focus:bg-[#FFE600]">
          </div>
          <div class="flex gap-4">
            <div class="flex-1">
              <label class="text-[10px] font-black uppercase text-gray-500">CATEGORY</label>
              <select name="category_id" id="editProductCategory" required class="w-full mt-1 p-3 bg-gray-50 border-4 border-black font-black text-xs uppercase">
                <?php foreach ($data['categories'] as $cat): ?>
                  <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="w-1/3">
              <label class="text-[10px] font-black uppercase text-gray-500">WEIGHT (GR)</label>
              <input type="number" name="weight_grams" id="editProductWeight" required class="w-full mt-1 p-3 bg-gray-50 border-4 border-black font-black text-sm">
            </div>
          </div>
          <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
            <button type="button" onclick="closeEditModal()" class="flex-1 bg-white border-4 border-black py-4 font-black shadow-[4px_4px_0_0_#000]">ABORT</button>
            <button type="submit" class="flex-1 bg-[#2563EB] text-white border-4 border-black py-4 font-black shadow-[4px_4px_0_0_#000]">SAVE CHANGES</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="confirmDeleteProductModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
      <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
      </div>
      <h2 class="text-2xl font-black uppercase text-white mb-2">WARNING!</h2>
      <p class="text-sm font-bold text-white mb-6 uppercase">Yakin hapus produk ini secara permanen dari database?</p>
      <div class="flex gap-4">
        <button onclick="closeModal('confirmDeleteProductModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">BATAL</button>
        <button id="btnExecuteDeleteProduct" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">HAPUS</button>
      </div>
    </div>
  </div>

</div>

<script>
  function openModal(id) {
    const m = document.getElementById(id);
    m.classList.remove('hidden');
    m.classList.add('flex');
  }

  function closeModal(id) {
    const m = document.getElementById(id);
    m.classList.remove('flex');
    m.classList.add('hidden');
  }

  function openSyncModal(id, name, stock) {
    document.getElementById('syncProductId').value = id;
    document.getElementById('syncProductName').innerText = name;
    document.getElementById('syncStockInput').value = stock;
    openModal('syncModal');
    setTimeout(() => document.getElementById('syncStockInput').focus(), 100);
  }

  function closeSyncModal() {
    closeModal('syncModal');
  }

  function openEditModal(id, name, catId, weight) {
    document.getElementById('editProductId').value = id;
    document.getElementById('editProductName').value = name;
    document.getElementById('editProductCategory').value = catId;
    document.getElementById('editProductWeight').value = weight;
    openModal('editModal');
  }

  function closeEditModal() {
    closeModal('editModal');
  }

  function confirmDeleteProduct(productId) {
    const btn = document.getElementById('btnExecuteDeleteProduct');
    btn.onclick = function() {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `<?= BASEURL; ?>/adminproduct/delete/${productId}`;
      document.body.appendChild(form);
      form.submit();
    };
    openModal('confirmDeleteProductModal');
  }
</script>