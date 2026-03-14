<div class="bg-[#F8F9FA] min-h-screen font-sans text-black pb-20">

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12" data-aos="fade-in">
    <div class="relative w-full h-[500px] border-4 border-black shadow-[12px_12px_0_0_#000] bg-white overflow-hidden flex items-center group">
      <div id="hero-bg" class="absolute inset-0 bg-cover bg-center mix-blend-multiply grayscale-[20%] transition-all duration-500 ease-in-out" style="background-image: url('https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1600&q=80'); opacity: 0.8;"></div>
      <div id="hero-content" class="relative z-10 p-8 md:p-16 max-w-2xl transition-opacity duration-300 ease-in-out">
        <p id="hero-label" class="inline-block bg-[#FFE600] text-black text-xs font-black tracking-widest uppercase border-2 border-black px-3 py-1 mb-4 shadow-[2px_2px_0_0_#000]">
          ALASKA ELECTRONICS
        </p>
        <h1 id="hero-title" class="text-5xl md:text-7xl font-black uppercase leading-[1] tracking-tight mb-4 text-white" style="-webkit-text-stroke: 2px black;">
          SUPER SALE ELEKTRONIK
        </h1>
        <p id="hero-subtitle" class="text-lg md:text-xl font-bold mb-8 text-black bg-white inline-block px-3 py-1 border-2 border-black">
          Diskon Hingga 40% untuk Semua Kategori
        </p>
        <br>
        <a id="hero-btn" href="<?= BASEURL; ?>/katalog" class="inline-flex items-center bg-[#2563EB] text-white text-sm font-black uppercase tracking-widest border-2 border-black px-8 py-4 shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all">
          BELANJA SEKARANG
          <svg class="w-5 h-5 ml-3 border-l-2 border-black pl-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </a>
      </div>

      <button id="btn-prev" class="absolute left-4 w-12 h-12 bg-white border-2 border-black shadow-[4px_4px_0_0_#000] hover:bg-[#FFE600] flex items-center justify-center text-black hover:-translate-y-1 transition-all z-20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      <button id="btn-next" class="absolute right-4 w-12 h-12 bg-white border-2 border-black shadow-[4px_4px_0_0_#000] hover:bg-[#FFE600] flex items-center justify-center text-black hover:-translate-y-1 transition-all z-20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20" id="slide-dots">
        <button class="dot-btn w-8 h-3 bg-[#2563EB] border-2 border-black transition-all duration-300"></button>
        <button class="dot-btn w-3 h-3 bg-white border-2 border-black transition-all duration-300"></button>
        <button class="dot-btn w-3 h-3 bg-white border-2 border-black transition-all duration-300"></button>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-aos="fade-up">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <div class="bg-white border-4 border-black shadow-[4px_4px_0_0_#000] p-4 flex items-center space-x-4">
        <div class="bg-[#A6FAAE] border-2 border-black p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
          </svg></div>
        <div>
          <h4 class="font-black text-black text-xs uppercase">GRATIS ONGKIR</h4>
          <p class="text-[10px] font-bold text-gray-600">Min. Rp 500.000</p>
        </div>
      </div>
      <div class="bg-white border-4 border-black shadow-[4px_4px_0_0_#000] p-4 flex items-center space-x-4">
        <div class="bg-[#90E0FF] border-2 border-black p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
          </svg></div>
        <div>
          <h4 class="font-black text-black text-xs uppercase">GARANSI RESMI</h4>
          <p class="text-[10px] font-bold text-gray-600">Produk 100% Ori</p>
        </div>
      </div>
      <div class="bg-white border-4 border-black shadow-[4px_4px_0_0_#000] p-4 flex items-center space-x-4">
        <div class="bg-[#FFE600] border-2 border-black p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg></div>
        <div>
          <h4 class="font-black text-black text-xs uppercase">FAST DEPLOY</h4>
          <p class="text-[10px] font-bold text-gray-600">Same day delivery</p>
        </div>
      </div>
      <div class="bg-white border-4 border-black shadow-[4px_4px_0_0_#000] p-4 flex items-center space-x-4">
        <div class="bg-[#FF5757] border-2 border-black p-2 text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg></div>
        <div>
          <h4 class="font-black text-black text-xs uppercase">CS 24/7</h4>
          <p class="text-[10px] font-bold text-gray-600">Siap membantu</p>
        </div>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
    <div class="flex justify-between items-end mb-6 border-b-4 border-black pb-2">
      <h2 class="italic text-2xl font-black text-black uppercase tracking-tight">KATEGORI PRODUK</h2>
      <a href="<?= BASEURL; ?>/katalog" class="text-xs font-black uppercase border-b-2 border-black pb-0.5 hover:text-[#2563EB] hover:border-[#2563EB] transition-colors">LIHAT SEMUA</a>
    </div>

    <div class="grid grid-cols-4 md:grid-cols-8 gap-4">
      <?php foreach ($data['kategori'] as $kat): ?>
        <a href="<?= BASEURL; ?>/katalog/kategori/<?= $kat['slug']; ?>" class="flex flex-col items-center group">
          <div class="w-full aspect-square bg-white border-2 border-black shadow-[4px_4px_0_0_#000] flex items-center justify-center text-3xl text-black group-hover:bg-[#2563EB] group-hover:text-white group-hover:-translate-y-1 transition-all mb-3">
            <span class="text-2xl font-black uppercase"><?= substr($kat['name'], 0, 1); ?></span>
          </div>
          <span class="text-[10px] font-black text-black uppercase text-center group-hover:text-[#2563EB]"><?= $kat['name']; ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="w-full bg-[#E2E8F0] border-y-4 border-black py-12 my-8" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
          <h2 class="text-3xl font-black uppercase tracking-tight flex items-center">
            <svg class="w-8 h-8 mr-2 text-[#FF5757]" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
            </svg>
            FLASH SALE
          </h2>
          <div class="flex items-center space-x-2 mt-3">
            <div class="bg-black text-white px-2 py-1 border-2 border-black font-black text-lg shadow-[2px_2px_0_0_#000]">05</div> <span class="font-black">:</span>
            <div class="bg-black text-white px-2 py-1 border-2 border-black font-black text-lg shadow-[2px_2px_0_0_#000]">23</div> <span class="font-black">:</span>
            <div class="bg-[#FF5757] text-white px-2 py-1 border-2 border-black font-black text-lg shadow-[2px_2px_0_0_#000]">38</div>
          </div>
        </div>
        <a href="<?= BASEURL; ?>/katalog/flashsale" class="bg-white text-black border-2 border-black shadow-[4px_4px_0_0_#000] px-6 py-2.5 font-black uppercase text-xs hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">LIHAT SEMUA</a>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <?php foreach ($data['flash_sale'] as $produk):
          $harga_asli = (float)$produk['price'];
          $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
          $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);
          $img_src = !empty($produk['image_url']) ? (str_starts_with($produk['image_url'], 'http') ? $produk['image_url'] : BASEURL . '/img/products/' . $produk['image_url']) : 'https://images.unsplash.com/photo-1505156868547-9b49f4df4e04?auto=format&fit=crop&w=400&q=80';
          $is_fav = isset($produk['is_wishlisted']) && $produk['is_wishlisted'];
        ?>
          <div class="group relative flex flex-col h-full">

            <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1"
              class="btn-wishlist absolute top-2 right-2 z-20 bg-white border-2 border-black p-1.5 shadow-[2px_2px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[1px] active:translate-x-[1px] transition-all group"
              title="Save to Wishlist">
              <svg class="w-4 h-4 transition-colors duration-300 <?= $is_fav ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>"
                fill="<?= $is_fav ? 'currentColor' : 'none' ?>"
                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </a>

            <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="block border-4 border-black shadow-[6px_6px_0_0_#000] bg-white aspect-square mb-4 overflow-hidden group-hover:-translate-y-1 group-hover:shadow-[8px_8px_0_0_#000] transition-all relative">
              <?php if ($ada_diskon): $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
                <div class="absolute top-0 left-0 bg-[#FF5757] text-white text-[10px] font-black px-2 py-1 border-b-2 border-r-2 border-black z-10">-<?= $persentase; ?>%</div>
              <?php endif; ?>
              <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 transition-all">
            </a>
            <div class="flex-1 flex flex-col">
              <p class="text-[9px] font-black uppercase text-gray-500 mb-1 tracking-widest">FLASH SALE</p>
              <h3 class="font-black text-sm uppercase leading-snug mb-2 line-clamp-2"><a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="hover:text-[#2563EB] transition-colors"><?= $produk['name']; ?></a></h3>
              <div class="mt-auto flex items-end justify-between pt-2">
                <div>
                  <?php if ($ada_diskon): ?>
                    <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                    <p class="text-[#FF5757] font-black text-sm border-b-2 border-black inline-block">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></p>
                  <?php else: ?>
                    <p class="text-black font-black text-sm">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                  <?php endif; ?>
                </div>
                <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart">
                  <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn-submit bg-white border-2 border-black shadow-[2px_2px_0_0_#000] p-1.5 hover:bg-[#FFE600] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all cursor-pointer">
                    <svg class="icon-cart w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
    <div class="flex justify-between items-end mb-6 border-b-4 border-black pb-2">
      <h2 class="italic text-2xl font-black text-black uppercase tracking-tight">PRODUK TERLARIS</h2>
      <a href="<?= BASEURL; ?>/katalog/terlaris" class="text-xs font-black uppercase border-b-2 border-black pb-0.5 hover:text-[#2563EB] hover:border-[#2563EB] transition-colors">LIHAT SEMUA</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 gap-y-10">
      <?php foreach (array_slice($data['terlaris'] ?? [], 0, 5) as $produk):
        $harga_asli = (float)$produk['price'];
        $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
        $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);
        $img_src = !empty($produk['image_url']) ? (str_starts_with($produk['image_url'], 'http') ? $produk['image_url'] : BASEURL . '/img/products/' . $produk['image_url']) : 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=400&q=80';
        $is_fav = isset($produk['is_wishlisted']) && $produk['is_wishlisted'];
      ?>
        <div class="group relative flex flex-col h-full">

          <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1"
            class="btn-wishlist absolute top-2 right-2 z-20 bg-white border-2 border-black p-1.5 shadow-[2px_2px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[1px] active:translate-x-[1px] transition-all group"
            title="Save to Wishlist">
            <svg class="w-4 h-4 transition-colors duration-300 <?= $is_fav ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>"
              fill="<?= $is_fav ? 'currentColor' : 'none' ?>"
              stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </a>

          <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="block border-4 border-black shadow-[6px_6px_0_0_#000] bg-white aspect-square mb-4 overflow-hidden group-hover:-translate-y-1 group-hover:shadow-[8px_8px_0_0_#000] transition-all relative">
            <?php if ($ada_diskon): $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
              <div class="absolute top-0 left-0 bg-[#2563EB] text-white text-[10px] font-black px-2 py-1 border-b-2 border-r-2 border-black z-10">-<?= $persentase; ?>%</div>
            <?php endif; ?>
            <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 transition-all">
          </a>
          <div class="flex-1 flex flex-col">
            <h3 class="font-black text-sm uppercase leading-snug mb-1 line-clamp-2"><a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="hover:text-[#2563EB] transition-colors"><?= $produk['name']; ?></a></h3>
            <div class="mt-auto flex items-end justify-between pt-2">
              <div>
                <?php if ($ada_diskon): ?>
                  <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                  <p class="text-[#2563EB] font-black text-sm">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></p>
                <?php else: ?>
                  <p class="text-black font-black text-sm">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                <?php endif; ?>
              </div>
              <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart">
                <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-submit bg-white border-2 border-black shadow-[2px_2px_0_0_#000] p-1.5 hover:bg-[#A6FAAE] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all cursor-pointer">
                  <svg class="icon-cart w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                  </svg>
                  <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="h-[250px] p-8 flex flex-col justify-center border-4 border-black shadow-[8px_8px_0_0_#000] bg-[#FFE600] relative overflow-hidden group">
        <div class="relative z-10">
          <span class="text-[10px] font-black tracking-widest uppercase mb-2 bg-white border-2 border-black px-2 py-1 inline-block">AUDIO GEAR</span>
          <h3 class="text-4xl font-black mb-2 uppercase tracking-tighter">DISCOUNT 40%</h3>
          <p class="text-xs font-bold mb-4 bg-black text-white inline-block px-2 py-0.5">Headphones & Speakers</p><br>
          <a href="<?= BASEURL; ?>/katalog" class="inline-block text-xs font-black uppercase border-b-2 border-black hover:text-[#2563EB] hover:border-[#2563EB] transition-colors">INITIATE SCAN</a>
        </div>
        <img src="https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=400&q=80" class="absolute right-0 bottom-0 h-full object-cover mix-blend-multiply opacity-50 group-hover:scale-110 transition-transform">
      </div>

      <div class="h-[250px] p-8 flex flex-col justify-center border-4 border-black shadow-[8px_8px_0_0_#000] bg-[#90E0FF] relative overflow-hidden group">
        <div class="relative z-10">
          <span class="text-[10px] font-black tracking-widest uppercase mb-2 bg-white border-2 border-black px-2 py-1 inline-block">GAMING SECTOR</span>
          <h3 class="text-4xl font-black mb-2 uppercase tracking-tighter">PS5 SETUP</h3>
          <p class="text-xs font-bold mb-4 bg-black text-white inline-block px-2 py-0.5">Bundle under 6M</p><br>
          <a href="<?= BASEURL; ?>/katalog" class="inline-block text-xs font-black uppercase border-b-2 border-black hover:text-[#2563EB] hover:border-[#2563EB] transition-colors">VIEW LOADOUT</a>
        </div>
        <img src="https://images.unsplash.com/photo-1605901309584-818e25960b8f?auto=format&fit=crop&w=400&q=80" class="absolute right-0 bottom-0 w-1/2 h-full object-cover mix-blend-multiply opacity-60 group-hover:scale-110 transition-transform">
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 border-t-4 border-black" data-aos="fade-up">
    <div class="flex justify-between items-end mb-6 border-b-4 border-black pb-2">
      <h2 class="italic text-2xl font-black text-black uppercase tracking-tight">REKOMENDASI UNTUK ANDA</h2>
      <a href="<?= BASEURL; ?>/katalog" class="text-xs font-black uppercase border-b-2 border-black pb-0.5 hover:text-[#2563EB] hover:border-[#2563EB] transition-colors">LIHAT SEMUA</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-6 gap-y-10">
      <?php foreach (array_slice($data['rekomendasi'] ?? [], 0, 5) as $produk):
        $harga_asli = (float)$produk['price'];
        $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
        $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);
        $img_src = !empty($produk['image_url']) ? (str_starts_with($produk['image_url'], 'http') ? $produk['image_url'] : BASEURL . '/img/products/' . $produk['image_url']) : 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
        $is_fav = isset($produk['is_wishlisted']) && $produk['is_wishlisted'];
      ?>
        <div class="group relative flex flex-col h-full">

          <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1"
            class="btn-wishlist absolute top-10 right-2 z-20 bg-white border-2 border-black p-1.5 shadow-[2px_2px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[1px] active:translate-x-[1px] transition-all group"
            title="Save to Wishlist">
            <svg class="w-4 h-4 transition-colors duration-300 <?= $is_fav ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>"
              fill="<?= $is_fav ? 'currentColor' : 'none' ?>"
              stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </a>

          <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="block border-4 border-black shadow-[6px_6px_0_0_#000] bg-white aspect-square mb-4 overflow-hidden group-hover:-translate-y-1 group-hover:shadow-[8px_8px_0_0_#000] transition-all relative">
            <div class="absolute top-0 right-0 bg-[#FFE600] text-black text-[10px] font-black px-2 py-1 border-b-2 border-l-2 border-black z-10">FOR YOU</div>
            <?php if ($ada_diskon): $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
              <div class="absolute top-0 left-0 bg-[#90E0FF] text-black text-[10px] font-black px-2 py-1 border-b-2 border-r-2 border-black z-10">-<?= $persentase; ?>%</div>
            <?php endif; ?>
            <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 transition-all">
          </a>
          <div class="flex-1 flex flex-col">
            <h3 class="font-black text-sm uppercase leading-snug mb-1 line-clamp-2"><a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="hover:text-[#2563EB] transition-colors"><?= $produk['name']; ?></a></h3>
            <div class="mt-auto flex items-end justify-between pt-2">
              <div>
                <?php if ($ada_diskon): ?>
                  <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                  <p class="text-[#2563EB] font-black text-sm">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></p>
                <?php else: ?>
                  <p class="text-black font-black text-sm">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></p>
                <?php endif; ?>
              </div>
              <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart">
                <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-submit bg-white border-2 border-black shadow-[2px_2px_0_0_#000] p-1.5 hover:bg-[#A6FAAE] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all cursor-pointer">
                  <svg class="icon-cart w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                  </svg>
                  <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
    <div class="flex justify-between items-end mb-6 border-b-4 border-black pb-2">
      <h2 class="italic text-2xl font-black text-black uppercase tracking-tight">BLOG & ARTICLES</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php foreach (array_slice($data['articles'] ?? [], 0, 3) as $article):
        $img_src = !empty($article['image_url']) ? $article['image_url'] : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=600&q=80';
        $tanggal = date('d M Y', strtotime($article['created_at']));
      ?>
        <a href="<?= BASEURL; ?>/article/read/<?= $article['slug']; ?>" class="border-4 border-black shadow-[6px_6px_0_0_#000] bg-white group hover:-translate-y-2 hover:shadow-[8px_8px_0_0_#000] transition-all flex flex-col">
          <div class="h-48 border-b-4 border-black overflow-hidden relative">
            <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[30%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
            <div class="absolute top-2 left-2 bg-[#FFE600] border-2 border-black px-2 py-1 text-[10px] font-black uppercase">NEWS</div>
          </div>
          <div class="p-5 flex-1 flex flex-col">
            <h3 class="text-lg font-black uppercase leading-tight mb-3 group-hover:text-[#2563EB] transition-colors"><?= $article['title']; ?></h3>
            <p class="text-xs font-bold text-gray-500 uppercase mt-auto flex items-center justify-between">
              <span><?= $tanggal; ?></span>
              <span class="text-black bg-[#FFE600] px-2 py-0.5 border border-black shadow-[1px_1px_0_0_#000]">READ</span>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

</div>

<div id="global-toast" class="fixed top-24 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-4 flex items-center max-w-sm">
  <div class="bg-[#A6FAAE] border-2 border-black p-1.5 mr-4 shadow-[2px_2px_0_0_#000]">
    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-black text-black uppercase tracking-wider">CONFIRMED</h4>
    <p class="text-xs font-bold text-gray-600 mt-0.5">Gear added to loadout.</p>
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
    <p id="global-toast-error-msg" class="text-xs font-bold text-gray-600 mt-0.5">Action failed.</p>
  </div>
</div>

<script src="<?= BASEURL; ?>/js/home_cart.js?v=<?= time(); ?>"></script>
<script src="<?= BASEURL; ?>/js/carousel.js?v=<?= time(); ?>"></script>
<script src="<?= BASEURL; ?>/js/wishlist.js?v=<?= time(); ?>"></script>