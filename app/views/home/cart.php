<div class="bg-white min-h-screen pt-24 pb-12 flex flex-col relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex-grow flex flex-col">

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm" data-aos="fade-down">
        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p class="font-medium"><?= $_SESSION['flash_success']; ?></p>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
      <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm" data-aos="fade-down">
        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <p class="font-medium"><?= $_SESSION['flash_error']; ?></p>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div id="ajax-error-alert" class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 items-center shadow-sm transition-all duration-300">
      <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
      </svg>
      <p id="ajax-error-text" class="font-medium"></p>
    </div>

    <?php if (empty($data['cart_items'])): ?>
      <div class="flex-grow flex flex-col items-center justify-center py-10" data-aos="zoom-in">
        <div class="mb-5 text-[#cbd5e1]">
          <svg class="w-28 h-28 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
        </div>
        <h3 class="text-[26px] font-bold text-[#1e293b] mb-2 tracking-tight">Keranjang Kosong</h3>
        <p class="text-[#64748b] mb-8 font-medium">Yuk, mulai belanja dan temukan produk favoritmu!</p>
        <a href="<?= BASEURL; ?>/katalog" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold rounded-lg text-white bg-[#ef4444] hover:bg-red-600 transition-colors">
          Mulai Belanja
        </a>
      </div>

    <?php else: ?>

      <div class="flex items-center space-x-3 mb-8" data-aos="fade-right">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Keranjang Belanja</h1>
        <span id="header-item-count" class="bg-[#ef4444] text-white text-sm font-bold px-3 py-1 rounded-full">
          <?= count($data['cart_items']); ?> Item
        </span>
      </div>

      <div class="flex flex-col lg:flex-row gap-8 items-start">
        <div class="w-full lg:w-2/3 space-y-4" id="cart-item-container">
          <?php foreach ($data['cart_items'] as $item): ?>
            <div id="cart-card-<?= $item['cart_id']; ?>" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col sm:flex-row gap-6 transition-all hover:shadow-md" data-aos="fade-up">

              <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 relative">
                <?php
                $item_img = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
                if (!empty($item['image_url'])) {
                  $item_img = str_starts_with($item['image_url'], 'http') ? $item['image_url'] : BASEURL . '/img/products/' . $item['image_url'];
                }
                ?>
                <img src="<?= $item_img; ?>" alt="<?= $item['name']; ?>" class="w-full h-full object-cover">
              </div>

              <div class="flex-1 flex flex-col justify-between">
                <div class="flex justify-between items-start">
                  <div>
                    <a href="<?= BASEURL; ?>/produk/detail/<?= $item['slug']; ?>" class="text-lg font-bold text-gray-900 hover:text-[#ef4444] transition-colors line-clamp-2">
                      <?= $item['name']; ?>
                    </a>
                    <p class="text-sm font-medium text-gray-500 mt-1">Berat: <?= $item['weight_grams'] ?? 0; ?> gr</p>
                  </div>

                  <form action="<?= BASEURL; ?>/cart/remove/<?= $item['cart_id']; ?>" method="POST" class="ml-4 ajax-remove-form">
                    <button type="submit" class="text-gray-400 hover:text-red-500 p-2 rounded-lg hover:bg-red-50 transition-colors" title="Hapus Barang">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </form>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center mt-4 sm:mt-0 gap-4">
                  <div>
                    <?php if (!empty($item['discount_price'])): ?>
                      <p class="text-xs text-gray-400 line-through mb-0.5">Rp <?= number_format((float)$item['price'], 0, ',', '.'); ?></p>
                      <p class="text-lg font-extrabold text-[#ef4444]">Rp <?= number_format((float)$item['discount_price'], 0, ',', '.'); ?></p>
                    <?php else: ?>
                      <p class="text-lg font-extrabold text-gray-900">Rp <?= number_format((float)$item['price'], 0, ',', '.'); ?></p>
                    <?php endif; ?>
                  </div>

                  <form action="<?= BASEURL; ?>/cart/update" method="POST" class="flex items-center bg-gray-50 border border-gray-200 rounded-lg h-10 ajax-update-form">
                    <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                    <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                    <input type="hidden" id="current-qty-<?= $item['cart_id']; ?>" name="current_quantity" value="<?= $item['quantity']; ?>">

                    <button type="submit" name="action" value="decrement" class="w-10 h-full flex items-center justify-center text-gray-500 hover:text-[#ef4444] hover:bg-gray-100 rounded-l-lg transition-colors focus:outline-none disabled:opacity-50">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                      </svg>
                    </button>

                    <div id="display-qty-<?= $item['cart_id']; ?>" class="w-12 h-full flex items-center justify-center font-bold text-gray-900 bg-white border-x border-gray-200 text-sm">
                      <?= $item['quantity']; ?>
                    </div>

                    <button type="submit" name="action" value="increment" class="w-10 h-full flex items-center justify-center text-gray-500 hover:text-green-600 hover:bg-gray-100 rounded-r-lg transition-colors focus:outline-none disabled:opacity-50">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="w-full lg:w-1/3 sticky top-24" data-aos="fade-left">
          <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">Ringkasan Belanja</h3>

            <div class="space-y-4 mb-6">
              <div class="flex justify-between text-sm font-medium text-gray-500">
                <span id="summary-total-item">Total Harga (<span id="summary-item-count"><?= count($data['cart_items']); ?></span> barang)</span>
                <span id="summary-total-harga">Rp <?= number_format((float)$data['total_harga'], 0, ',', '.'); ?></span>
              </div>

              <div id="summary-discount-container" class="flex justify-between text-sm font-bold text-green-500 bg-green-100 p-3 rounded-lg <?= ($data['total_diskon'] > 0) ? '' : 'hidden' ?>">
                <span>Total Diskon</span>
                <span id="summary-total-diskon">- Rp <?= number_format((float)$data['total_diskon'], 0, ',', '.'); ?></span>
              </div>
            </div>

            <div class="border-t border-gray-200 pt-4 mb-8">
              <div class="flex justify-between items-end">
                <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                <span id="summary-total-bayar" class="text-2xl font-extrabold text-[#ef4444]">Rp <?= number_format((float)$data['total_bayar'], 0, ',', '.'); ?></span>
              </div>
            </div>

            <a href="<?= BASEURL; ?>/checkout" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-red-500/30 text-sm font-bold text-white bg-[#ef4444] hover:bg-red-600 hover:shadow-red-600/40 focus:outline-none transition-all active:scale-[0.98]">
              Beli Sekarang
            </a>

            <div class="mt-6 flex items-center justify-center space-x-2 text-xs font-medium text-gray-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              <span>Pembayaran 100% Aman & Terenkripsi</span>
            </div>
          </div>
        </div>

      </div>
    <?php endif; ?>

  </div>

  <div id="custom-confirm-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0 duration-300">
    <div class="bg-white rounded-2xl p-6 w-[90%] max-w-sm shadow-2xl transform scale-95 transition-transform duration-300 flex flex-col items-center">
      <div class="flex items-center justify-center w-14 h-14 rounded-full bg-red-100 mb-5">
        <svg class="w-7 h-7 text-[#ef4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
      </div>
      <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Produk?</h3>
      <p class="text-sm text-center text-gray-500 mb-6">Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?</p>
      <div class="flex w-full space-x-3">
        <button id="btn-cancel-modal" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition-colors">Batal</button>
        <button id="btn-confirm-modal" class="flex-1 bg-[#ef4444] hover:bg-red-600 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-red-500/30">Ya, Hapus</button>
      </div>
    </div>
  </div>

</div>

<script src="<?= BASEURL; ?>/js/cart.js"></script>