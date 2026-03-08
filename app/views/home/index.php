<section class="w-full relative bg-gray-900 h-[450px] flex items-center justify-center overflow-hidden" data-aos="fade-in">
  <div id="hero-bg" class="absolute inset-0 bg-cover bg-center opacity-50 transition-all duration-700 ease-in-out" style="background-image: url('https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1600&q=80');"></div>
  <div class="absolute inset-0 bg-[#1e293b] mix-blend-multiply opacity-60"></div>

  <div id="hero-content" class="relative z-10 text-center text-white px-4 max-w-4xl transition-opacity duration-300 ease-in-out">
    <p id="hero-label" class="text-sm font-semibold tracking-widest uppercase mb-3 text-gray-300">ALASKA ELECTRONICS</p>
    <h1 id="hero-title" class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight">Super Sale Elektronik</h1>
    <p id="hero-subtitle" class="text-lg md:text-xl font-light mb-8 text-gray-200">Diskon Hingga 40% untuk Semua Kategori</p>
    <a id="hero-btn" href="<?= BASEURL; ?>/katalog" class="inline-flex items-center bg-white text-gray-900 font-semibold px-8 py-3.5 rounded-md hover:bg-gray-100 transition shadow-lg">
      Belanja Sekarang <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
      </svg>
    </a>
  </div>

  <button id="btn-prev" class="absolute left-4 w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition z-20">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
  </button>
  <button id="btn-next" class="absolute right-4 w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white backdrop-blur-sm transition z-20">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
  </button>

  <div class="absolute bottom-6 flex space-x-2 z-20" id="slide-dots">
    <button class="dot-btn w-8 h-1.5 bg-white rounded-full transition-all duration-300"></button>
    <button class="dot-btn w-2 h-1.5 bg-white/50 rounded-full transition-all duration-300"></button>
    <button class="dot-btn w-2 h-1.5 bg-white/50 rounded-full transition-all duration-300"></button>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-b border-gray-100" data-aos="fade-up">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    <div class="flex items-center space-x-4">
      <div class="text-[#ef4444]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
        </svg></div>
      <div>
        <h4 class="font-bold text-gray-800 text-sm">Gratis Ongkir</h4>
        <p class="text-xs text-gray-500">Min. belanja Rp 500.000</p>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <div class="text-[#ef4444]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
        </svg></div>
      <div>
        <h4 class="font-bold text-gray-800 text-sm">Garansi Resmi</h4>
        <p class="text-xs text-gray-500">Produk 100% original</p>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <div class="text-[#ef4444]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
        </svg></div>
      <div>
        <h4 class="font-bold text-gray-800 text-sm">Pengiriman Cepat</h4>
        <p class="text-xs text-gray-500">Same day delivery</p>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <div class="text-[#ef4444]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg></div>
      <div>
        <h4 class="font-bold text-gray-800 text-sm">CS 24/7</h4>
        <p class="text-xs text-gray-500">Siap membantu Anda</p>
      </div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-900">Kategori Produk</h2>
    <a href="<?= BASEURL; ?>/katalog" class="text-sm font-medium text-[#ef4444] hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
      </svg></a>
  </div>

  <div class="grid grid-cols-4 md:grid-cols-8 gap-4">
    <?php foreach ($data['kategori'] as $kat): ?>
      <a href="<?= BASEURL; ?>/katalog/kategori/<?= $kat['slug']; ?>" class="flex flex-col items-center group">
        <div class="w-20 h-20 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-3xl text-[#ef4444] group-hover:border-[#ef4444] group-hover:shadow-md transition mb-3">
          <span class="text-xl font-bold"><?= strtoupper(substr($kat['name'], 0, 1)); ?></span>
        </div>
        <span class="text-xs font-medium text-gray-600 text-center group-hover:text-[#ef4444]"><?= $kat['name']; ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<section class="w-full bg-gradient-to-r from-[#ef4444] to-orange-400 py-12" data-aos="fade-up">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-4 text-white">
        <h2 class="text-2xl font-bold flex items-center">
          <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
          </svg> Flash Sale
        </h2>
        <div class="flex items-center space-x-1 font-mono font-bold text-sm">
          <div class="bg-white text-[#ef4444] px-2 py-1 rounded">05</div> <span class="px-1">:</span>
          <div class="bg-white text-[#ef4444] px-2 py-1 rounded">23</div> <span class="px-1">:</span>
          <div class="bg-white text-[#ef4444] px-2 py-1 rounded">38</div>
        </div>
      </div>
      <a href="<?= BASEURL; ?>/katalog/flashsale" class="text-white text-sm font-medium hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg></a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
      <?php foreach ($data['flash_sale'] as $produk): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col relative h-full hover:shadow-md transition">

          <?php
          $harga_asli = (float)$produk['price'];
          $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
          $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);

          // LOGIKA CERDAS UNTUK GAMBAR
          $img_src = 'https://images.unsplash.com/photo-1505156868547-9b49f4df4e04?auto=format&fit=crop&w=400&q=80';
          if (!empty($produk['image_url'])) {
            if (str_starts_with($produk['image_url'], 'http')) {
              $img_src = $produk['image_url'];
            } else {
              $img_src = BASEURL . '/img/products/' . $produk['image_url'];
            }
          }
          ?>

          <?php if ($ada_diskon): ?>
            <?php $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
            <div class="absolute top-3 left-3 bg-[#ef4444] text-white text-[10px] font-bold px-2 py-1 rounded z-10">-<?= $persentase; ?>%</div>
          <?php endif; ?>

          <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="flex-1 flex flex-col">
            <div class="aspect-w-1 aspect-h-1 bg-gray-50 overflow-hidden relative">
              <img src="<?= $img_src; ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
            </div>
            <div class="p-4 flex-1 flex flex-col">
              <p class="text-[11px] text-gray-500 mb-1">Flash Sale</p>
              <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-2"><?= $produk['name']; ?></h3>
              <div class="flex items-center mb-3">
                <span class="text-yellow-400 text-xs mr-1">★</span><span class="text-xs font-bold text-gray-700">4.8</span><span class="text-[10px] text-gray-400 ml-1">(234)</span>
              </div>
              <div class="mt-auto">
                <?php if ($ada_diskon): ?>
                  <div class="text-[11px] text-gray-400 line-through mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
                  <div class="text-lg font-bold text-[#ef4444]">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></div>
                <?php else: ?>
                  <div class="text-[11px] opacity-0 mb-0.5">-</div>
                  <div class="text-lg font-bold text-gray-900">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
                <?php endif; ?>
              </div>
            </div>
          </a>

          <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="absolute bottom-4 right-4 z-20 ajax-add-cart">
            <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="btn-submit bg-[#ef4444] hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm cursor-pointer flex items-center justify-center w-9 h-9">
              <svg class="icon-cart w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
              <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
              </svg>
            </button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-900">Produk Terlaris</h2>
    <a href="<?= BASEURL; ?>/katalog/terlaris" class="text-sm font-medium text-[#ef4444] hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
      </svg></a>
  </div>

  <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <?php foreach ($data['terlaris'] as $produk): ?>
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col relative h-full hover:shadow-md transition">

        <?php
        $harga_asli = (float)$produk['price'];
        $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
        $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);

        // LOGIKA CERDAS UNTUK GAMBAR
        $img_src = 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=400&q=80';
        if (!empty($produk['image_url'])) {
          if (str_starts_with($produk['image_url'], 'http')) {
            $img_src = $produk['image_url'];
          } else {
            $img_src = BASEURL . '/img/products/' . $produk['image_url'];
          }
        }
        ?>

        <?php if ($ada_diskon): ?>
          <?php $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
          <div class="absolute top-3 left-3 bg-[#ef4444] text-white text-[10px] font-bold px-2 py-1 rounded z-10">-<?= $persentase; ?>%</div>
        <?php endif; ?>

        <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="flex-1 flex flex-col">
          <div class="bg-gray-50 overflow-hidden relative">
            <img src="<?= $img_src; ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <p class="text-[11px] text-gray-500 mb-1">Terlaris</p>
            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-2"><?= $produk['name']; ?></h3>
            <div class="flex items-center mb-3">
              <span class="text-yellow-400 text-xs mr-1">★</span><span class="text-xs font-bold text-gray-700">4.9</span><span class="text-[10px] text-gray-400 ml-1">(189)</span>
            </div>
            <div class="mt-auto">
              <?php if ($ada_diskon): ?>
                <div class="text-[11px] text-gray-400 line-through mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
                <div class="text-lg font-bold text-[#ef4444]">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></div>
              <?php else: ?>
                <div class="text-[11px] opacity-0 mb-0.5">-</div>
                <div class="text-lg font-bold text-gray-900">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
              <?php endif; ?>
            </div>
          </div>
        </a>

        <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="absolute bottom-4 right-4 z-20 ajax-add-cart">
          <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
          <input type="hidden" name="quantity" value="1">
          <button type="submit" class="btn-submit bg-[#ef4444] hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm cursor-pointer flex items-center justify-center w-9 h-9">
            <svg class="icon-cart w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
          </button>
        </form>

      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4" data-aos="fade-up">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="rounded-2xl h-[220px] p-8 flex flex-col justify-center bg-cover bg-center text-white relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=800&q=80');">
      <div class="absolute inset-0 bg-[#1e293b] opacity-70"></div>
      <div class="relative z-10">
        <span class="text-xs font-bold tracking-widest uppercase mb-1 block opacity-80">Promo Audio</span>
        <h3 class="text-3xl font-bold mb-2">Diskon 40%</h3>
        <p class="text-sm mb-4 opacity-90">Headphone & Speaker Premium</p>
        <a href="<?= BASEURL; ?>/katalog" class="inline-block text-sm font-semibold underline underline-offset-4">Belanja Sekarang</a>
      </div>
    </div>
    <div class="rounded-2xl h-[220px] p-8 flex flex-col justify-center bg-cover bg-center text-white relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1605901309584-818e25960b8f?auto=format&fit=crop&w=800&q=80');">
      <div class="absolute inset-0 bg-[#ef4444] opacity-80 mix-blend-multiply"></div>
      <div class="relative z-10">
        <span class="text-xs font-bold tracking-widest uppercase mb-1 block opacity-80">Gaming Zone</span>
        <h3 class="text-3xl font-bold mb-2">PS5 & Aksesoris</h3>
        <p class="text-sm mb-4 opacity-90">Bundle hemat mulai 6 jutaan</p>
        <a href="<?= BASEURL; ?>/katalog" class="inline-block text-sm font-semibold underline underline-offset-4">Lihat Penawaran</a>
      </div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-900">Rekomendasi Untuk Anda</h2>
    <a href="<?= BASEURL; ?>/katalog" class="text-sm font-medium text-[#ef4444] hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
      </svg></a>
  </div>

  <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <?php foreach ($data['rekomendasi'] as $produk): ?>
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col relative h-full hover:shadow-md transition">

        <?php
        $harga_asli = (float)$produk['price'];
        $harga_diskon = !empty($produk['discount_price']) ? (float)$produk['discount_price'] : 0;
        $ada_diskon = ($harga_diskon > 0 && $harga_diskon < $harga_asli);

        // LOGIKA CERDAS UNTUK GAMBAR
        $img_src = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
        if (!empty($produk['image_url'])) {
          if (str_starts_with($produk['image_url'], 'http')) {
            $img_src = $produk['image_url'];
          } else {
            $img_src = BASEURL . '/img/products/' . $produk['image_url'];
          }
        }
        ?>

        <?php if ($ada_diskon): ?>
          <?php $persentase = round((($harga_asli - $harga_diskon) / $harga_asli) * 100); ?>
          <div class="absolute top-3 left-3 bg-[#ef4444] text-white text-[10px] font-bold px-2 py-1 rounded z-10">-<?= $persentase; ?>%</div>
        <?php endif; ?>

        <a href="<?= BASEURL; ?>/produk/detail/<?= $produk['slug']; ?>" class="flex-1 flex flex-col">
          <div class="bg-gray-50 overflow-hidden relative">
            <img src="<?= $img_src; ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <p class="text-[11px] text-gray-500 mb-1">Rekomendasi</p>
            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-2"><?= $produk['name']; ?></h3>
            <div class="flex items-center mb-3">
              <span class="text-yellow-400 text-xs mr-1">★</span><span class="text-xs font-bold text-gray-700">4.9</span><span class="text-[10px] text-gray-400 ml-1">(210)</span>
            </div>
            <div class="mt-auto">
              <?php if ($ada_diskon): ?>
                <div class="text-[11px] text-gray-400 line-through mb-0.5">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
                <div class="text-lg font-bold text-[#ef4444]">Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></div>
              <?php else: ?>
                <div class="text-[11px] opacity-0 mb-0.5">-</div>
                <div class="text-lg font-bold text-gray-900">Rp <?= number_format($harga_asli, 0, ',', '.'); ?></div>
              <?php endif; ?>
            </div>
          </div>
        </a>

        <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="absolute bottom-4 right-4 z-20 ajax-add-cart">
          <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
          <input type="hidden" name="quantity" value="1">
          <button type="submit" class="btn-submit bg-[#ef4444] hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm cursor-pointer flex items-center justify-center w-9 h-9">
            <svg class="icon-cart w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <svg class="icon-success w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
          </button>
        </form>

      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" data-aos="fade-up">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-900">Blog & Promo</h2>
    <a href="#" class="text-sm font-medium text-[#ef4444] hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
      </svg></a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php for ($i = 1; $i <= 3; $i++): ?>
      <a href="#" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
        <div class="h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </div>
        <div class="p-5">
          <span class="bg-red-50 text-[#ef4444] text-[10px] font-bold px-2 py-1 rounded inline-block mb-3">Tips & Trik</span>
          <h3 class="text-base font-bold text-gray-800 leading-snug mb-3 group-hover:text-[#ef4444] transition">Tips Memilih Laptop Terbaik untuk Kerja & Gaming 2026</h3>
          <p class="text-xs text-gray-500">28 Feb 2026</p>
        </div>
      </a>
    <?php endfor; ?>
  </div>
</section>

<div id="global-toast" class="fixed top-24 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-l-4 border-[#10b981] shadow-lg rounded-lg p-4 flex items-center max-w-sm">
  <div class="bg-green-100 rounded-full p-1 mr-3">
    <svg class="w-5 h-5 text-[#10b981]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-bold text-gray-800">Berhasil!</h4>
    <p class="text-xs text-gray-500">Produk ditambahkan ke keranjang.</p>
  </div>
</div>

<div id="global-toast-error" class="fixed top-24 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-l-4 border-[#ef4444] shadow-lg rounded-lg p-4 flex items-center max-w-sm">
  <div class="bg-red-100 rounded-full p-1 mr-3">
    <svg class="w-5 h-5 text-[#ef4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-bold text-gray-800">Gagal!</h4>
    <p id="global-toast-error-msg" class="text-xs text-gray-500">Terjadi kesalahan.</p>
  </div>
</div>

<script src="<?= BASEURL; ?>/js/home_cart.js"></script>
<script src="<?= BASEURL; ?>/js/carousel.js"></script>