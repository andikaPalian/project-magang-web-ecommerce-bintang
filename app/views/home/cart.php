<div class="bg-[#F8F9FA] min-h-screen pt-10 pb-20 font-sans text-black flex flex-col relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex-grow flex flex-col">

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

    <div id="ajax-error-alert" class="hidden bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider items-center transition-all duration-300">
      <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
      </svg>
      <p id="ajax-error-text"></p>
    </div>

    <?php if (empty($data['cart_items'])): ?>
      <div class="flex-grow flex flex-col items-center justify-center py-10" data-aos="zoom-in">
        <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0_0_#000] flex flex-col items-center max-w-md text-center">
          <svg class="w-24 h-24 mb-6 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <h3 class="text-3xl font-black uppercase tracking-tight mb-2">KERANJANG KOSONG</h3>
          <p class="font-bold text-gray-600 mb-8 uppercase text-sm">Yuk, mulai belanja dan temukan produk favoritmu!</p>
          <a href="<?= BASEURL; ?>/katalog" class="inline-block bg-[#2563EB] text-white border-2 border-black px-8 py-4 font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all">
            Mulai Belanja
          </a>
        </div>
      </div>

    <?php else: ?>

      <div class="mb-8 border-b-4 border-black pb-4 flex justify-between items-end" data-aos="fade-right">
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">KERANJANG</h1>
        <span id="header-item-count" class="bg-[#FFE600] text-black border-2 border-black shadow-[2px_2px_0_0_#000] text-sm font-black px-3 py-1 uppercase">
          <?= count($data['cart_items']); ?> ITEMS
        </span>
      </div>

      <div class="flex flex-col lg:flex-row gap-8 items-start">

        <div class="w-full lg:w-2/3 space-y-6" id="cart-item-container">
          <?php foreach ($data['cart_items'] as $item): ?>
            <div id="cart-card-<?= $item['cart_id']; ?>" class="cart-item-card bg-white border-4 border-black shadow-[6px_6px_0_0_#000] flex flex-col sm:flex-row group transition-all" data-aos="fade-up">

              <div class="w-full sm:w-40 h-40 flex-shrink-0 bg-gray-100 border-b-4 sm:border-b-0 sm:border-r-4 border-black relative overflow-hidden">
                <?php
                $item_img = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
                if (!empty($item['image_url'])) {
                  $item_img = str_starts_with($item['image_url'], 'http') ? $item['image_url'] : BASEURL . '/img/products/' . $item['image_url'];
                }
                ?>
                <img src="<?= $item_img; ?>" alt="<?= $item['name']; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale group-hover:grayscale-0 transition-all duration-300">
              </div>

              <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                <div class="flex justify-between items-start">
                  <div>
                    <a href="<?= BASEURL; ?>/produk/detail/<?= $item['slug']; ?>" class="text-lg font-black uppercase leading-tight hover:text-[#2563EB] transition-colors line-clamp-2">
                      <?= $item['name']; ?>
                    </a>
                    <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-widest">MASS: <?= $item['weight_grams'] ?? 0; ?>G</p>
                  </div>

                  <form action="<?= BASEURL; ?>/cart/remove/<?= $item['cart_id']; ?>" method="POST" class="ml-4 ajax-remove-form">
                    <button type="submit" class="bg-white border-2 border-black p-2 shadow-[2px_2px_0_0_#000] hover:bg-[#FF5757] hover:text-white hover:translate-y-[1px] hover:translate-x-[1px] hover:shadow-none active:shadow-none transition-all" title="Drop Item">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
                  </form>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center mt-4 sm:mt-0 gap-4">
                  <div>
                    <?php if (!empty($item['discount_price'])): ?>
                      <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format((float)$item['price'], 0, ',', '.'); ?></p>
                      <p class="text-xl font-black text-[#2563EB]">Rp <?= number_format((float)$item['discount_price'], 0, ',', '.'); ?></p>
                    <?php else: ?>
                      <p class="text-xl font-black text-black">Rp <?= number_format((float)$item['price'], 0, ',', '.'); ?></p>
                    <?php endif; ?>
                  </div>

                  <form action="<?= BASEURL; ?>/cart/update" method="POST" class="flex items-center border-2 border-black bg-white shadow-[2px_2px_0_0_#000] h-10 ajax-update-form">
                    <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                    <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                    <input type="hidden" id="current-qty-<?= $item['cart_id']; ?>" name="current_quantity" value="<?= $item['quantity']; ?>">

                    <button type="submit" name="action" value="decrement" class="w-10 h-full flex items-center justify-center font-black text-lg hover:bg-[#FF5757] hover:text-white border-r-2 border-black transition-colors disabled:opacity-50">
                      -
                    </button>
                    <div id="display-qty-<?= $item['cart_id']; ?>" class="w-12 h-full flex items-center justify-center font-black text-black text-sm bg-gray-50">
                      <?= $item['quantity']; ?>
                    </div>
                    <button type="submit" name="action" value="increment" class="w-10 h-full flex items-center justify-center font-black text-lg hover:bg-[#A6FAAE] border-l-2 border-black transition-colors disabled:opacity-50">
                      +
                    </button>
                  </form>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

        <div class="w-full lg:w-1/3 sticky top-24" data-aos="fade-left">
          <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
            <h3 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-4">RINGKASAN BELANJA</h3>

            <div class="space-y-3 mb-6 font-bold text-sm">
              <div class="flex justify-between items-end border-b-2 border-black border-dashed pb-2">
                <span class="uppercase">SUBTOTAL (<span id="summary-item-count"><?= count($data['cart_items']); ?></span>)</span>
                <span id="summary-total-harga">Rp <?= number_format((float)$data['total_harga'], 0, ',', '.'); ?></span>
              </div>

              <div id="summary-discount-container" class="flex justify-between items-end border-b-2 border-black border-dashed pb-2 text-[#FF5757] <?= ($data['total_diskon'] > 0) ? '' : 'hidden' ?>">
                <span class="uppercase">DISCOUNT</span>
                <span id="summary-total-diskon">- Rp <?= number_format((float)$data['total_diskon'], 0, ',', '.'); ?></span>
              </div>
            </div>

            <div class="bg-black text-white p-4 border-2 border-black mb-6 shadow-[4px_4px_0_0_#000]">
              <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">TOTAL ESTIMATE</p>
              <p id="summary-total-bayar" class="text-2xl font-black tracking-tight text-[#A6FAAE]">Rp <?= number_format((float)$data['total_bayar'], 0, ',', '.'); ?></p>
            </div>

            <a href="<?= BASEURL; ?>/checkout" class="w-full flex justify-center py-4 px-4 border-4 border-black shadow-[6px_6px_0_0_#000] text-sm font-black uppercase tracking-widest text-white bg-[#2563EB] hover:bg-blue-700 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:translate-y-[6px] active:translate-x-[6px] active:shadow-none transition-all">
              PROCEED TO CHECKOUT
            </a>

            <div class="mt-4 flex items-center justify-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-500">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              <span>100% ENCRYPTED LINK</span>
            </div>
          </div>
        </div>

      </div>
    <?php endif; ?>

  </div>

  <div id="custom-confirm-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-gray-900/80 backdrop-blur-sm transition-opacity opacity-0 duration-300">
    <div class="modal-box bg-white border-4 border-black p-8 w-[90%] max-w-sm shadow-[12px_12px_0_0_#000] transform translate-y-10 transition-all duration-300 flex flex-col items-center">
      <div class="flex items-center justify-center w-16 h-16 bg-[#FF5757] border-2 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
      </div>
      <h3 class="text-2xl font-black uppercase text-center mb-2">REMOVE ITEM?</h3>
      <p class="text-xs font-bold text-center text-gray-600 mb-8 uppercase">Are you sure you want to remove this item from your cart?</p>
      <div class="flex w-full space-x-4">
        <button id="btn-cancel-modal" class="flex-1 bg-white border-4 border-black hover:bg-gray-100 text-black font-black uppercase tracking-widest py-3 shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-none transition-all">CANCEL</button>
        <button id="btn-confirm-modal" class="flex-1 bg-[#FF5757] border-4 border-black hover:bg-red-700 text-white font-black uppercase tracking-widest py-3 shadow-[4px_4px_0_0_#000] active:translate-y-[2px] active:translate-x-[2px] active:shadow-none transition-all">REMOVE</button>
      </div>
    </div>
  </div>

</div>

<script src="<?= BASEURL; ?>/js/cart.js?v=<?= time(); ?>"></script>