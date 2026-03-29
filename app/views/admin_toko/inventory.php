<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-2">INVENTORY</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Pantau stok barang secara real-time. Lihat jumlah stok yang tersedia, produk yang hampir habis, dan status ketersediaan untuk setiap item di cabang Anda.
      </p>
    </div>

    <div class="mt-4 md:mt-0 w-full md:w-80">
      <div class="flex w-full bg-white border-4 border-black shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 transition-transform">
        <div class="p-2 border-r-4 border-black bg-gray-50 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" id="searchInventory" placeholder="CARI BARANG..." class="w-full px-3 py-2 font-black text-xs uppercase outline-none placeholder-gray-400">
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-hidden flex flex-col">

    <div class="bg-black text-white grid grid-cols-12 gap-4 p-4 border-b-4 border-black text-[10px] font-black tracking-widest">
      <div class="col-span-1 text-center">ID</div>
      <div class="col-span-2">GAMBAR</div>
      <div class="col-span-4">NAMA PRODUK</div>
      <div class="col-span-2 text-center">KATEGORI</div>
      <div class="col-span-1 text-center">STATUS</div>
      <div class="col-span-2 text-center">SISA STOK</div>
    </div>

    <div class="flex-1 overflow-y-auto max-h-[60vh] bg-white">
      <?php if (empty($data['inventory'])): ?>
        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
          <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          <h2 class="font-black text-xl text-black">KOSONG</h2>
          <p class="text-[10px] font-bold uppercase tracking-widest mt-2">Belum ada suplai logistik di cabang ini.</p>
        </div>
      <?php else: ?>

        <?php foreach ($data['inventory'] as $item): ?>
          <?php
          $stock = (int)$item['stock_quantity'];
          $rowClass = 'bg-white';
          $stockBadge = 'bg-[#4ADE80] text-black';

          if ($stock === 0) {
            $rowClass = 'bg-red-50';
            $stockBadge = 'bg-[#FF5757] text-white animate-pulse';
          } elseif ($stock <= 5) {
            $rowClass = 'bg-yellow-50';
            $stockBadge = 'bg-[#FFE600] text-black';
          }

          $imgUrl = !empty($item['image_url'])
            ? (str_starts_with($item['image_url'], 'http')
              ? $item['image_url']
              : BASEURL . '/img/products/' . $item['image_url'])
            : BASEURL . '/img/products/placeholder.png';
          ?>

          <div class="grid grid-cols-12 gap-4 p-4 border-b-2 border-dashed border-gray-300 items-center <?= $rowClass ?> hover:bg-gray-100 transition-colors inventory-row">

            <div class="col-span-1 text-center font-mono text-[10px] font-black text-gray-500">
              #<?= $item['id'] ?>
            </div>

            <div class="col-span-2 flex justify-start">
              <div class="w-16 h-16 border-2 border-black bg-white overflow-hidden shadow-[2px_2px_0_0_#000]">
                <img src="<?= $imgUrl ?>" alt="Product" class="w-full h-full object-cover">
              </div>
            </div>

            <div class="col-span-4">
              <p class="font-black text-xs leading-tight mb-1 item-name"><?= htmlspecialchars($item['name']) ?></p>
              <p class="text-[9px] font-bold text-[#2563EB]">Rp <?= number_format((float)$item['price'], 0, ',', '.') ?></p>
            </div>

            <div class="col-span-2 text-center">
              <span class="inline-block border-2 border-black px-2 py-0.5 text-[8px] font-black bg-white shadow-[2px_2px_0_0_#000]">
                <?= htmlspecialchars($item['category_name'] ?? 'UMUM') ?>
              </span>
            </div>

            <div class="col-span-1 text-center">
              <?php if ($item['is_active']): ?>
                <span class="text-[10px] font-black text-[#2563EB]">ONLINE</span>
              <?php else: ?>
                <span class="text-[10px] font-black text-[#FF5757] line-through">OFFLINE</span>
              <?php endif; ?>
            </div>

            <div class="col-span-2 flex justify-center">
              <div class="border-4 border-black px-4 py-2 font-black text-lg shadow-[4px_4px_0_0_#000] <?= $stockBadge ?>">
                <?= $stock ?>
              </div>
            </div>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>

    <div class="bg-gray-100 p-4 border-t-4 border-black flex justify-between items-center shrink-0">
      <p class="text-[9px] font-black text-gray-500">
        TOTAL ITEM TYPES: <?= count($data['inventory']) ?>
      </p>
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInventory');
    const rows = document.querySelectorAll('.inventory-row');

    searchInput.addEventListener('keyup', function(e) {
      const keyword = e.target.value.toLowerCase();

      rows.forEach(row => {
        const itemName = row.querySelector('.item-name').innerText.toLowerCase();

        if (itemName.includes(keyword)) {
          row.style.display = 'grid';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });
</script>