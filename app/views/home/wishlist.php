<div class="bg-[#F8F9FA] min-h-screen font-sans text-black pt-10 pb-20" data-aos="fade-in">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-12 border-b-8 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none" style="-webkit-text-stroke: 2px black;">
          WISHLIST
        </h1>
        <p class="text-sm font-black mt-2 text-gray-700 uppercase tracking-[0.2em] border-l-8 border-[#FF90E8] pl-4">
          LIST PRODUK FAVORIT ANDA
        </p>
      </div>
      <div class="bg-black text-white px-6 py-2 font-black uppercase text-xl shadow-[8px_8px_0_0_#FF90E8]">
        TOTAL: <span id="wishlist-total-count"><?= count($data['wishlist']); ?></span> PRODUK
      </div>
    </div>

    <div id="wishlist-container">
      <?php if (empty($data['wishlist'])): ?>
        <div class="bg-white border-8 border-black p-12 text-center shadow-[12px_12px_0_0_#000]">
          <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
          <h2 class="text-3xl font-black uppercase mb-4">WISHLIST KOSONG</h2>
          <p class="font-bold text-gray-500 mb-8">TIDAK ADA PRODUK YANG DITAMBAHKAN KE WISHLIST.</p>
          <a href="<?= BASEURL; ?>/katalog" class="inline-block bg-[#2563EB] text-white border-4 border-black px-10 py-4 font-black uppercase tracking-widest shadow-[6px_6px_0_0_#000] hover:translate-y-1 hover:shadow-none transition-all">
            GO TO CATALOG
          </a>
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="wishlist-grid">
          <?php foreach ($data['wishlist'] as $item):
            $is_discount = !empty($item['discount_price']) && $item['discount_price'] > 0;
            $harga_tampil = $is_discount ? $item['discount_price'] : $item['price'];

            $img_src = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
            if (!empty($item['image_url'])) {
              $img_src = str_starts_with($item['image_url'], 'http') ? $item['image_url'] : BASEURL . '/img/products/' . $item['image_url'];
            }
          ?>
            <div class="wishlist-card group bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col transition-all hover:-translate-y-2 hover:shadow-[12px_12px_0_0_#FF90E8]" data-id="<?= $item['id']; ?>">
              <div class="relative aspect-square border-b-4 border-black overflow-hidden bg-gray-100">
                <img src="<?= $img_src; ?>" alt="<?= $item['name']; ?>" class="w-full h-full object-cover mix-blend-multiply">

                <button type="button" data-url="<?= BASEURL; ?>/wishlist/toggle/<?= $item['id']; ?>?ajax=1" class="btn-remove-wishlist absolute top-4 right-4 bg-[#FF5757] text-white border-2 border-black p-2 shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-none active:shadow-none transition-all cursor-pointer" title="Remove from Wishlist">
                  <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>

              <div class="p-5 flex-1 flex flex-col">
                <h3 class="font-black text-lg uppercase leading-tight mb-2 line-clamp-2">
                  <a href="<?= BASEURL; ?>/produk/detail/<?= $item['slug']; ?>"><?= $item['name']; ?></a>
                </h3>

                <div class="mt-auto pt-4 flex items-center justify-between">
                  <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">PRICE UNIT</p>
                    <p class="font-black text-xl text-[#2563EB]">Rp <?= number_format((float)$harga_tampil, 0, ',', '.'); ?></p>
                  </div>

                  <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart">
                    <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-submit bg-[#FFE600] border-2 border-black p-2 shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-none active:shadow-none transition-all">
                      <svg class="icon-cart w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>

<template id="empty-wishlist-template">
  <div class="bg-white border-8 border-black p-12 text-center shadow-[12px_12px_0_0_#000] animate-fade-in">
    <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
    <h2 class="text-3xl font-black uppercase mb-4">WISHLIST KOSONG</h2>
    <p class="font-bold text-gray-500 mb-8">TIDAK ADA PRODUK YANG DITAMBAHKAN KE WISHLIST.</p>
    <a href="<?= BASEURL; ?>/katalog" class="inline-block bg-[#2563EB] text-white border-4 border-black px-10 py-4 font-black uppercase tracking-widest shadow-[6px_6px_0_0_#000] hover:translate-y-1 hover:shadow-none transition-all">
      GO TO CATALOG
    </a>
  </div>
</template>

<script src="<?= BASEURL; ?>/js/wishlist.js?v=<?= time(); ?>"></script>