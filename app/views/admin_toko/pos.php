<div class="flex h-[calc(100vh-80px)] w-full bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative overflow-hidden">

  <div class="flex-1 flex flex-col h-full overflow-hidden border-r-4 border-black">

    <div class="p-4 border-b-4 border-black bg-white flex gap-4 shrink-0 z-10">
      <div class="flex-1 flex border-4 border-black shadow-[4px_4px_0_0_#000] bg-white">
        <div class="p-3 border-r-4 border-black flex items-center justify-center bg-gray-50">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" id="searchInput" placeholder="SEARCH PRODUCT NAME..." class="w-full px-4 py-2 font-black text-xs uppercase outline-none placeholder-gray-400">
      </div>
      <button class="w-12 border-4 border-black shadow-[4px_4px_0_0_#000] flex items-center justify-center bg-white hover:bg-[#FFE600] active:translate-y-1 active:shadow-none transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
        </svg>
      </button>
      <button class="w-12 border-4 border-black shadow-[4px_4px_0_0_#000] flex items-center justify-center bg-white hover:bg-[#2563EB] hover:text-white active:translate-y-1 active:shadow-none transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
        </svg>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-6 bg-[#F8F9FA]">
      <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productGrid">

        <?php if (empty($data['products'])): ?>
          <div class="col-span-full text-center py-10 font-black text-gray-400">TIDAK ADA BARANG DENGAN STOK TERSEDIA</div>
        <?php else: ?>
          <?php foreach ($data['products'] as $product): ?>
            <?php
            $activePrice = $product['discount_price'] ?? $product['price'];

            $imgUrl = !empty($product['image_url']) ? (str_starts_with($product['image_url'], 'http') ? $product['image_url'] : BASEURL . '/img/products/' . $product['image_url']) : BASEURL . '/img/products/placeholder.png';
            ?>
            <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] flex flex-col product-card" data-name="<?= strtolower($product['name']) ?>">
              <div class="h-40 border-b-4 border-black bg-gray-100 relative overflow-hidden group">
                <img src="<?= $imgUrl ?>" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute top-2 right-2 bg-[#FFE600] border-2 border-black px-2 py-1 text-[9px] font-black shadow-[2px_2px_0_0_#000]">
                  STOK: <?= $product['stock_quantity'] ?>
                </div>
              </div>
              <div class="p-4 flex flex-col flex-1">
                <span class="text-[8px] font-mono font-black text-white bg-black px-2 py-1 self-start mb-2 border border-black shadow-[2px_2px_0_0_#000]">ID: #PRD-<?= $product['id'] ?></span>
                <h3 class="text-[10px] font-black leading-tight line-clamp-2 mb-2 flex-1"><?= htmlspecialchars($product['name']) ?></h3>

                <?php if ($product['discount_price']): ?>
                  <p class="text-[9px] line-through text-gray-400 font-bold mb-0.5">Rp <?= number_format((float)$product['price'], 0, ',', '.') ?></p>
                <?php endif; ?>

                <p class="text-sm font-black text-[#2563EB] mb-4">Rp <?= number_format((float)$activePrice, 0, ',', '.') ?></p>

                <button onclick="addToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', <?= $activePrice ?>, <?= $product['stock_quantity'] ?>)"
                  class="w-full bg-white border-4 border-black py-2 text-[10px] font-black hover:bg-black hover:text-white transition-colors shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none">
                  ADD TO CART
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <div class="w-96 flex flex-col bg-white shrink-0 z-20 shadow-[-4px_0_0_0_#000]">

    <div class="h-20 border-b-4 border-black flex items-center justify-between px-6 shrink-0 bg-white">
      <div>
        <h2 class="font-black text-lg">CURRENT CART</h2>
      </div>
      <button onclick="clearCart()" class="text-[9px] font-black text-[#FF5757] border-2 border-[#FF5757] px-3 py-1 hover:bg-[#FF5757] hover:text-white transition-colors shadow-[2px_2px_0_0_#FF5757] active:translate-y-1 active:shadow-none">
        CLEAR ALL
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-4 flex flex-col gap-4 bg-[#F8F9FA]" id="cartContainer">
      <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-50">
        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        <p class="font-black text-[10px]">CART IS EMPTY</p>
      </div>
    </div>

    <div class="border-t-4 border-black bg-white p-6 shrink-0 flex flex-col gap-4">

      <div class="flex justify-between items-end border-b-2 border-dashed border-gray-300 pb-4">
        <span class="text-[10px] font-black text-gray-500">TOTAL BAYAR:</span>
        <span class="text-3xl font-black text-black leading-none" id="totalPayable">Rp 0</span>
      </div>

      <div>
        <p class="text-[8px] font-mono font-black text-gray-400 mb-2">PAYMENT METHOD</p>
        <div class="grid grid-cols-3 gap-2">
          <button onclick="setPaymentMethod('CASH')" id="btn-CASH" class="border-4 border-black py-2 flex flex-col items-center justify-center bg-black text-white transition-colors shadow-[2px_2px_0_0_#000]">
            <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-[9px] font-black">CASH</span>
          </button>
          <button onclick="setPaymentMethod('QRIS')" id="btn-QRIS" class="border-4 border-black py-2 flex flex-col items-center justify-center bg-white text-black hover:bg-gray-100 transition-colors shadow-[2px_2px_0_0_#000]">
            <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            <span class="text-[9px] font-black">QRIS</span>
          </button>
          <button onclick="setPaymentMethod('DEBIT')" id="btn-DEBIT" class="border-4 border-black py-2 flex flex-col items-center justify-center bg-white text-black hover:bg-gray-100 transition-colors shadow-[2px_2px_0_0_#000]">
            <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span class="text-[9px] font-black">DEBIT</span>
          </button>
        </div>
      </div>

      <button onclick="processCheckout()" id="btnCheckout" class="w-full bg-[#2563EB] text-white border-4 border-black py-4 font-black text-sm flex items-center justify-center shadow-[6px_6px_0_0_#000] hover:bg-[#1D4ED8] active:translate-y-1 active:shadow-none transition-all mt-2">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
        </svg>
        PROCESS PAYMENT
      </button>

    </div>
  </div>
</div>

<div id="paymentModalOverlay" class="fixed inset-0 bg-black/80 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm">
  <div id="paymentModalBox" class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-md flex flex-col transform scale-95 transition-transform duration-100">

    <div class="border-b-4 border-black p-4 flex justify-between items-center bg-[#FFE600]" id="modalHeader">
      <button onclick="closeModal()" class="font-black text-3xl leading-none hover:text-[#FF5757]">&times;</button>
    </div>

    <div id="modalContent" class="p-6 bg-[#F8F9FA]">
    </div>

    <div class="border-t-4 border-black p-4 bg-white" id="modalFooter">
      <button id="btnConfirmPayment" onclick="executePayment()" class="w-full bg-[#2563EB] text-white border-4 border-black py-4 font-black text-lg shadow-[6px_6px_0_0_#000] hover:bg-[#1D4ED8] active:translate-y-1 active:shadow-none transition-all disabled:opacity-50 disabled:cursor-not-allowed">
        CONFIRM PAYMENT
      </button>
    </div>
  </div>
</div>

<script>
  const APP_BASE_URL = '<?= BASEURL; ?>';
</script>

<script src="<?= BASEURL; ?>/js/pos.js"></script>