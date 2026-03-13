<div class="bg-[#F8F9FA] min-h-screen pt-8 pb-20 font-sans text-black" data-aos="fade-in">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8 border-b-4 border-black pb-4 flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">KATALOG PRODUK</h1>
        <p class="text-sm font-bold mt-2 text-gray-700 bg-[#FFE600] inline-block px-3 py-1 border-2 border-black shadow-[2px_2px_0_0_#000]">
          <?= isset($data['active_category']) ? 'KATEGORI: ' . strtoupper(str_replace('-', ' ', $data['active_category'])) : 'MENAMPILKAN SEMUA PRODUK'; ?>
        </p>
      </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">

      <div class="w-full lg:w-1/4 sticky top-24 z-10">
        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] flex flex-col overflow-hidden">
          <div class="bg-black text-white p-4 font-black uppercase text-sm border-b-4 border-black flex items-center justify-between">
            <span>KATEGORI</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
          </div>

          <a href="<?= BASEURL; ?>/katalog" class="<?= !isset($data['active_category']) ? 'bg-[#FFE600]' : 'bg-white hover:bg-gray-100' ?> border-b-4 border-black p-4 font-black uppercase text-xs flex items-center justify-between transition-colors">
            <span>SEMUA PRODUK</span>
          </a>

          <?php if (!empty($data['kategori'])): ?>
            <?php foreach ($data['kategori'] as $kat): ?>
              <?php $is_active = (isset($data['active_category']) && $data['active_category'] === $kat['slug']); ?>
              <a href="<?= BASEURL; ?>/katalog/kategori/<?= $kat['slug']; ?>" class="<?= $is_active ? 'bg-[#FFE600]' : 'bg-white hover:bg-gray-100' ?> border-b-4 border-black p-4 font-black uppercase text-xs flex items-center justify-between transition-colors group">
                <span><?= $kat['name']; ?></span>
                <svg class="w-4 h-4 <?= $is_active ? 'opacity-100' : 'opacity-0' ?> group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="w-full lg:w-3/4">
        <?php if (empty($data['produk'])): ?>
          <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-12 text-center">
            <h3 class="text-2xl font-black uppercase mb-2">PRODUK KOSONG</h3>
            <p class="text-gray-500 font-bold uppercase text-xs">Belum ada produk di kategori ini.</p>
            <a href="<?= BASEURL; ?>/katalog" class="mt-6 inline-block bg-black text-white px-6 py-3 font-black uppercase text-xs tracking-widest border-2 border-black hover:bg-[#FFE600] hover:text-black transition-colors">KEMBALI KE SEMUA PRODUK</a>
          </div>
        <?php else: ?>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            <?php foreach ($data['produk'] as $produk):
              $harga_asli = (float)$produk['price'];
              $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
              $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);
              $img_src = !empty($produk['image_url']) ? (str_starts_with($produk['image_url'], 'http') ? $produk['image_url'] : BASEURL . '/img/products/' . $produk['image_url']) : 'https://images.unsplash.com/photo-1505156868547-9b49f4df4e04?auto=format&fit=crop&w=400&q=80';

              // Status wishlist
              $is_fav = isset($produk['is_wishlisted']) && $produk['is_wishlisted'];
            ?>
              <div class="group relative flex flex-col h-full bg-white border-4 border-black shadow-[4px_4px_0_0_#000] hover:-translate-y-2 hover:shadow-[6px_6px_0_0_#000] transition-all duration-300">

                <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1"
                  class="btn-wishlist absolute top-2 right-2 z-20 bg-white border-2 border-black p-1.5 shadow-[2px_2px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[1px] active:translate-x-[1px] transition-all group"
                  title="Save to Wishlist">
                  <svg class="w-4 h-4 transition-colors duration-300 <?= $is_fav ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>"
                    fill="<?= $is_fav ? 'currentColor' : 'none' ?>"
                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                </a>

                <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="block aspect-square overflow-hidden relative border-b-4 border-black bg-gray-100">
                  <?php if ($ada_diskon): $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
                    <div class="absolute top-0 left-0 bg-[#FF5757] text-white text-[10px] font-black px-2 py-1 border-b-2 border-r-2 border-black z-10">-<?= $persentase; ?>%</div>
                  <?php endif; ?>
                  <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 transition-all duration-500">
                </a>

                <div class="p-4 flex-1 flex flex-col">
                  <p class="text-[9px] font-black uppercase text-gray-500 mb-1 tracking-widest"><?= $produk['category_name'] ?? 'UMUM'; ?></p>

                  <h3 class="font-black text-sm uppercase leading-snug mb-2 line-clamp-2">
                    <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="hover:text-[#2563EB] transition-colors"><?= $produk['name']; ?></a>
                  </h3>

                  <div class="mt-auto pt-2 flex flex-col gap-3">
                    <div>
                      <?php if ($ada_diskon): ?>
                        <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                        <p class="text-[#2563EB] font-black text-base">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></p>
                      <?php else: ?>
                        <p class="text-white select-none text-[10px] mb-0.5">-</p>
                        <p class="text-black font-black text-base">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                      <?php endif; ?>
                    </div>

                    <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart w-full">
                      <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="btn-submit w-full bg-white border-2 border-black shadow-[2px_2px_0_0_#000] p-2 hover:bg-[#FFE600] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all cursor-pointer flex justify-center items-center gap-2">
                        <svg class="icon-cart w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-xs font-black uppercase">ADD TO CART</span>
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
</div>

<div id="global-toast" class="fixed top-24 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-4 flex items-center max-w-sm">
  <div class="bg-[#A6FAAE] border-2 border-black p-1.5 mr-4 shadow-[2px_2px_0_0_#000]">
    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-black text-black uppercase tracking-wider">CONFIRMED</h4>
    <p class="text-xs font-bold text-gray-600 mt-0.5">Berhasil ditambahkan.</p>
  </div>
</div>

<div id="global-toast-error" class="fixed top-24 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-4 flex items-center max-w-sm">
  <div class="bg-[#FF5757] border-2 border-black p-1.5 mr-4 shadow-[2px_2px_0_0_#000]">
    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-black text-black uppercase tracking-wider">ERROR</h4>
    <p id="global-toast-error-msg" class="text-xs font-bold text-gray-600 mt-0.5">Tindakan gagal.</p>
  </div>
</div>

<script src="<?= BASEURL; ?>/js/home_cart.js?v=<?= time(); ?>"></script>
<script src="<?= BASEURL; ?>/js/wishlist.js?v=<?= time(); ?>"></script>