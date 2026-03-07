<?php
$produk = $data['produk'];
$stok = $data['stok'];
$spesifikasi = $data['spesifikasi'];
$ulasan = $data['ulasan'];
$produk_serupa = $data['produk_serupa'];

$is_discount = !empty($produk['discount_price']) && $produk['discount_price'] > 0;
$harga_tampil = $is_discount ? $produk['discount_price'] : $produk['price'];
$persen_diskon = $is_discount ? round((($produk['price'] - $produk['discount_price']) / $produk['price']) * 100) : 0;

$rata_rating = 0;
if (count($ulasan) > 0) {
  $total_bintang = array_sum(array_column($ulasan, 'rating'));
  $rata_rating = round($total_bintang / count($ulasan), 1);
} else {
  $rata_rating = 5.0;
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-aos="fade-in">
  <nav class="flex text-sm text-gray-500 mb-8 space-x-2">
    <a href="<?= BASEURL; ?>" class="hover:text-[#ef4444] transition">Beranda</a>
    <span>/</span>
    <a href="<?= BASEURL; ?>/katalog" class="hover:text-[#ef4444] transition">Produk</a>
    <span>/</span>
    <a href="<?= BASEURL; ?>/katalog/kategori/<?= strtolower($produk['category_name']) ?>" class="hover:text-[#ef4444] transition"><?= $produk['category_name']; ?></a>
    <span>/</span>
    <span class="text-gray-800 font-medium truncate"><?= $produk['name']; ?></span>
  </nav>

  <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">

    <div class="md:col-span-7 relative">
      <?php if ($is_discount): ?>
        <div class="absolute top-4 left-4 bg-[#ef4444] text-white text-xs font-bold px-3 py-1.5 rounded-full z-10 shadow-sm">
          -<?= $persen_diskon; ?>%
        </div>
      <?php endif; ?>
      <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm aspect-w-4 aspect-h-3">
        <img src="<?= !empty($produk['image_url']) ? $produk['image_url'] : 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=800&q=80'; ?>"
          alt="<?= $produk['name']; ?>"
          class="w-full h-full object-cover">
      </div>
    </div>

    <div class="md:col-span-5 flex flex-col pt-2">
      <span class="text-[#ef4444] text-xs font-bold tracking-widest uppercase mb-2"><?= $produk['category_name']; ?></span>
      <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-4"><?= $produk['name']; ?></h1>

      <div class="flex items-center space-x-3 mb-6 text-sm">
        <div class="flex items-center text-yellow-400">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <svg class="w-4 h-4 <?= $i <= round($rata_rating) ? 'text-yellow-400' : 'text-gray-300' ?>" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          <?php endfor; ?>
        </div>
        <span class="font-bold text-gray-700"><?= number_format($rata_rating, 1); ?> <span class="text-gray-400 font-normal ml-1">(<?= count($ulasan); ?> ulasan)</span></span>
        <span class="text-gray-300">|</span>
        <span class="<?= $stok > 0 ? 'text-green-600' : 'text-red-500' ?> font-semibold">Stok: <?= $stok; ?></span>
      </div>

      <div class="mb-6 flex items-end space-x-3">
        <div class="text-4xl font-bold text-[#ef4444] tracking-tight">Rp <?= number_format((float)$harga_tampil, 0, ',', '.'); ?></div>
        <?php if ($is_discount): ?>
          <span class="text-gray-400 line-through text-base mb-1">Rp <?= number_format((float)$produk['price'], 0, ',', '.'); ?></span>
          <span class="bg-red-50 text-[#ef4444] text-xs font-bold px-2 py-1 rounded mb-1.5">-<?= $persen_diskon; ?>%</span>
        <?php endif; ?>
      </div>

      <p class="text-gray-500 text-sm leading-relaxed mb-8">
        <?= !empty($produk['description']) ? $produk['description'] : 'Belum ada deskripsi untuk produk ini.'; ?>
      </p>

      <?php if ($stok > 0): ?>
        <div class="flex items-center space-x-4 mb-6">
          <span class="text-sm font-medium text-gray-700">Jumlah:</span>
          <div class="flex items-center border border-gray-300 rounded-lg">
            <button type="button" class="px-4 py-2 text-gray-500 hover:bg-gray-100 transition rounded-l-lg">-</button>
            <input type="number" value="1" min="1" max="<?= $stok; ?>" class="w-12 text-center py-2 border-none focus:ring-0 text-sm font-semibold text-gray-800 bg-transparent outline-none">
            <button type="button" class="px-4 py-2 text-gray-500 hover:bg-gray-100 transition rounded-r-lg">+</button>
          </div>
        </div>

        <div class="flex space-x-3 mb-4">
          <button class="flex-1 bg-[#ef4444] hover:bg-red-600 text-white font-bold py-3.5 px-6 rounded-lg transition flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span>Tambah ke Keranjang</span>
          </button>
          <button class="w-[52px] h-[52px] border border-gray-300 rounded-lg flex items-center justify-center text-gray-500 hover:text-[#ef4444] hover:border-[#ef4444] transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </button>
          <button class="w-[52px] h-[52px] border border-gray-300 rounded-lg flex items-center justify-center text-gray-500 hover:text-[#ef4444] hover:border-[#ef4444] transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
            </svg>
          </button>
        </div>
        <button class="w-full border-2 border-[#ef4444] text-[#ef4444] hover:bg-red-50 font-bold py-3.5 px-6 rounded-lg transition">
          Beli Sekarang
        </button>
      <?php else: ?>
        <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-500 font-semibold mb-6">
          Maaf, stok produk saat ini sedang kosong.
        </div>
      <?php endif; ?>

      <div class="grid grid-cols-3 gap-2 mt-8 pt-6 border-t border-gray-100">
        <div class="text-center flex flex-col items-center">
          <div class="text-[#ef4444] mb-1.5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
          </div>
          <span class="text-[11px] font-medium text-gray-600">Gratis Ongkir</span>
        </div>
        <div class="text-center flex flex-col items-center">
          <div class="text-[#ef4444] mb-1.5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
          <span class="text-[11px] font-medium text-gray-600">Garansi Resmi</span>
        </div>
        <div class="text-center flex flex-col items-center">
          <div class="text-[#ef4444] mb-1.5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
          </div>
          <span class="text-[11px] font-medium text-gray-600">7 Hari Return</span>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-16 overflow-hidden">
    <div class="flex border-b border-gray-100 px-6 pt-4">
      <button class="tab-btn pb-4 mr-8 relative text-sm font-semibold text-[#ef4444]" data-target="desc">
        Deskripsi
        <span class="tab-indicator absolute bottom-0 left-0 w-full h-[2px] bg-[#ef4444] transition-all"></span>
      </button>
      <button class="tab-btn pb-4 mr-8 relative text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors" data-target="specs">
        Spesifikasi
        <span class="tab-indicator absolute bottom-0 left-0 w-full h-[2px] bg-transparent transition-all"></span>
      </button>
      <button class="tab-btn pb-4 relative text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors" data-target="reviews">
        <span class="<?= count($ulasan) > 0 ? 'text-[#ef4444]' : '' ?>">Ulasan (<?= count($ulasan); ?>)</span>
        <span class="tab-indicator absolute bottom-0 left-0 w-full h-[2px] bg-transparent transition-all"></span>
      </button>
    </div>

    <div class="p-8">
      <div id="content-desc" class="tab-content text-gray-600 text-sm leading-relaxed">
        <?= nl2br(!empty($produk['description']) ? htmlspecialchars($produk['description']) : 'Deskripsi tidak tersedia untuk produk ini.'); ?>
      </div>

      <div id="content-specs" class="tab-content hidden">
        <?php if (!empty($spesifikasi)): ?>
          <div class="max-w-2xl">
            <?php foreach ($spesifikasi as $spec): ?>
              <div class="flex border-b border-gray-100 py-4 last:border-0">
                <div class="w-1/3 text-sm text-gray-500"><?= htmlspecialchars($spec['spec_name']); ?></div>
                <div class="w-2/3 text-sm font-medium text-gray-900"><?= htmlspecialchars($spec['spec_value']); ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-sm text-gray-500">Belum ada data spesifikasi terperinci.</p>
        <?php endif; ?>
      </div>

      <div id="content-reviews" class="tab-content hidden">
        <?php if (!empty($ulasan)): ?>
          <div class="space-y-8 max-w-3xl">
            <?php foreach ($ulasan as $review): ?>
              <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                <div class="flex justify-between items-start mb-3">
                  <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-[#1e293b] text-white flex items-center justify-center font-bold text-sm">
                      <?= strtoupper(substr($review['reviewer_name'], 0, 1)); ?>
                    </div>
                    <div>
                      <h4 class="text-sm font-bold text-gray-900"><?= htmlspecialchars($review['reviewer_name']); ?></h4>
                      <div class="flex text-yellow-400 mt-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <svg class="w-3.5 h-3.5 <?= $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-200' ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                          </svg>
                        <?php endfor; ?>
                      </div>
                    </div>
                  </div>
                  <span class="text-xs text-gray-400"><?= date('d M Y', strtotime($review['created_at'])); ?></span>
                </div>
                <p class="text-sm text-gray-600 pl-14 leading-relaxed"><?= htmlspecialchars($review['comment']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-sm text-gray-500">Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="mb-10" data-aos="fade-up">
    <h2 class="text-xl font-bold text-[#1e293b] mb-6">Produk Serupa</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-5">
      <?php foreach ($produk_serupa as $sim_prod): ?>
        <?php
        $sim_disc = !empty($sim_prod['discount_price']) && $sim_prod['discount_price'] > 0;
        $sim_harga = $sim_disc ? $sim_prod['discount_price'] : $sim_prod['price'];
        $sim_pct = $sim_disc ? round((($sim_prod['price'] - $sim_prod['discount_price']) / $sim_prod['price']) * 100) : 0;
        ?>
        <a href="<?= BASEURL; ?>/produk/detail/<?= $sim_prod['slug']; ?>" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col relative h-full hover:shadow-lg transition duration-300">
          <?php if ($sim_disc): ?>
            <div class="absolute top-3 left-3 bg-[#ef4444] text-white text-[10px] font-bold px-2.5 py-1 rounded-md z-10">-<?= $sim_pct; ?>%</div>
          <?php endif; ?>

          <div class="bg-gray-50 overflow-hidden relative aspect-w-1 aspect-h-1">
            <img src="<?= !empty($sim_prod['image_url']) ? $sim_prod['image_url'] : 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80'; ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
          </div>

          <div class="p-4 flex-1 flex flex-col">
            <p class="text-[10px] text-gray-500 mb-1 uppercase tracking-wider">Rekomendasi</p>
            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug mb-3"><?= $sim_prod['name']; ?></h3>

            <div class="mt-auto">
              <?php if ($sim_disc): ?>
                <div class="text-[11px] text-gray-400 line-through mb-0.5">Rp <?= number_format((float)$sim_prod['price'], 0, ',', '.'); ?></div>
              <?php endif; ?>
              <div class="text-lg font-bold text-[#ef4444]">Rp <?= number_format((float)$sim_harga, 0, ',', '.'); ?></div>
            </div>
          </div>

          <button class="absolute bottom-4 right-4 bg-[#ef4444] hover:bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center transition shadow-sm z-20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </button>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        tabBtns.forEach(b => {
          b.classList.remove('text-[#ef4444]', 'font-semibold');
          b.classList.add('text-gray-500', 'font-medium');
          b.querySelector('.tab-indicator').classList.remove('bg-[#ef4444]');
          b.querySelector('.tab-indicator').classList.add('bg-transparent');
        });

        tabContents.forEach(c => c.classList.add('hidden'));

        btn.classList.remove('text-gray-500', 'font-medium');
        btn.classList.add('text-[#ef4444]', 'font-semibold');
        btn.querySelector('.tab-indicator').classList.remove('bg-transparent');
        btn.querySelector('.tab-indicator').classList.add('bg-[#ef4444]');

        const targetId = 'content-' + btn.getAttribute('data-target');
        document.getElementById(targetId).classList.remove('hidden');
      });
    });
  });
</script>