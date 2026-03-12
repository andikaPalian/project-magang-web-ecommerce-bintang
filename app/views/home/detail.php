<?php
$produk = $data['produk'];
$stok = $data['stok'];
$spesifikasi = $data['spesifikasi'];
$ulasan = $data['ulasan'];
$produk_serupa = $data['produk_serupa'] ?? [];

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

$img_src = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=800&q=80';
if (!empty($produk['image_url'])) {
  if (str_starts_with($produk['image_url'], 'http')) {
    $img_src = $produk['image_url'];
  } else {
    $img_src = BASEURL . '/img/products/' . $produk['image_url'];
  }
}

$is_wishlisted = isset($data['is_wishlisted']) && $data['is_wishlisted'];
?>

<div class="bg-[#F8F9FA] min-h-screen font-sans text-black pt-8 pb-20" data-aos="fade-in">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <nav class="flex items-center text-[10px] font-black uppercase tracking-widest mb-8 space-x-3 bg-white border-2 border-black p-3 shadow-[4px_4px_0_0_#000] w-max">
      <a href="<?= BASEURL; ?>" class="hover:text-[#2563EB] hover:underline transition">BASE</a>
      <span>/</span>
      <a href="<?= BASEURL; ?>/katalog" class="hover:text-[#2563EB] hover:underline transition">CATALOG</a>
      <span>/</span>
      <a href="<?= BASEURL; ?>/katalog/kategori/<?= strtolower($produk['category_name']) ?>" class="hover:text-[#2563EB] hover:underline transition"><?= $produk['category_name']; ?></a>
      <span>/</span>
      <span class="text-[#2563EB] truncate max-w-[150px] sm:max-w-xs"><?= $produk['name']; ?></span>
    </nav>

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <p><?= $_SESSION['flash_success']; ?></p>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <div id="ajax-alert" class="hidden bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider items-center transition-all duration-300">
      <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
      </svg>
      <p id="ajax-alert-text"></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 mb-16">

      <div class="md:col-span-6 relative">
        <?php if ($is_discount): ?>
          <div class="absolute top-4 left-4 bg-[#FF5757] text-white text-xs font-black px-3 py-1.5 border-2 border-black shadow-[2px_2px_0_0_#000] z-10 rotate-[-3deg]">
            -<?= $persen_diskon; ?>% OFF
          </div>
        <?php endif; ?>
        <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] aspect-w-4 aspect-h-4 md:aspect-h-3 overflow-hidden relative">
          <div class="absolute inset-0 bg-[#E2E8F0] mix-blend-multiply"></div>
          <img src="<?= $img_src; ?>" alt="<?= $produk['name']; ?>" class="w-full h-full object-cover mix-blend-multiply hover:scale-105 transition-transform duration-500">
        </div>
      </div>

      <div class="md:col-span-6 flex flex-col justify-center">
        <span class="inline-block bg-black text-white text-[10px] font-black tracking-widest uppercase mb-4 px-2 py-1 w-max border-2 border-black">
          <?= $produk['category_name']; ?>
        </span>

        <h1 class="text-4xl md:text-5xl font-black text-black uppercase leading-[1.1] tracking-tight mb-4" style="-webkit-text-stroke: 1px black;">
          <?= $produk['name']; ?>
        </h1>

        <div class="flex flex-wrap items-center gap-4 mb-6 text-sm">
          <div class="flex items-center bg-white border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">
            <span class="font-black text-black mr-2"><?= number_format($rata_rating, 1); ?></span>
            <div class="flex text-[#FFE600]">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <svg class="w-4 h-4 <?= $i <= round($rata_rating) ? 'text-[#FF5757]' : 'text-gray-300' ?>" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              <?php endfor; ?>
            </div>
            <span class="text-[10px] font-bold text-gray-500 ml-2">(<?= count($ulasan); ?> LOGS)</span>
          </div>

          <div class="<?= $stok > 0 ? 'bg-[#A6FAAE]' : 'bg-[#FF5757] text-white' ?> border-2 border-black px-3 py-1 font-black text-xs uppercase shadow-[2px_2px_0_0_#000]">
            STOCK: <?= $stok; ?> UNITS
          </div>
        </div>

        <div class="mb-8 p-4 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] inline-block w-full">
          <?php if ($is_discount): ?>
            <span class="text-gray-500 line-through text-sm font-bold mb-1 block">Rp <?= number_format((float)$produk['price'], 0, ',', '.'); ?></span>
          <?php endif; ?>
          <div class="text-4xl md:text-5xl font-black text-[#2563EB] tracking-tighter">
            Rp <?= number_format((float)$harga_tampil, 0, ',', '.'); ?>
          </div>
        </div>

        <p class="text-gray-800 text-sm font-medium leading-relaxed mb-8 border-l-4 border-[#FFE600] pl-4">
          <?= !empty($produk['description']) ? $produk['description'] : 'NO DATA AVAILABLE FOR THIS GEAR.'; ?>
        </p>

        <?php if ($stok > 0): ?>
          <form id="form-add-cart" action="<?= BASEURL; ?>/cart/add" method="POST">
            <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">

            <div class="flex items-center space-x-4 mb-6">
              <span class="text-xs font-black uppercase tracking-widest">QTY:</span>
              <div class="flex items-center border-4 border-black bg-white shadow-[4px_4px_0_0_#000]">
                <button type="button" onclick="decrementQty()" class="px-4 py-2 font-black text-lg hover:bg-[#FF5757] hover:text-white transition-colors border-r-4 border-black">-</button>
                <input type="number" id="qty-input" name="quantity" value="1" min="1" max="<?= $stok; ?>" readonly class="w-14 text-center font-black text-lg bg-transparent outline-none cursor-default">
                <button type="button" onclick="incrementQty(<?= $stok; ?>)" class="px-4 py-2 font-black text-lg hover:bg-[#A6FAAE] transition-colors border-l-4 border-black">+</button>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mb-4">

              <button type="button" id="btn-add-cart" class="flex-1 bg-[#FFE600] text-black border-4 border-black shadow-[6px_6px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none font-black uppercase tracking-widest py-4 px-6 transition-all flex items-center justify-center space-x-3">
                <svg id="icon-cart-default" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <svg id="icon-cart-success" class="w-5 h-5 hidden text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
                <span id="text-add-cart">Add to Cart</span>
              </button>

              <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1" class="btn-wishlist w-16 sm:w-20 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all flex items-center justify-center group" title="Add to Wishlist">
                <svg class="w-7 h-7 transition-colors duration-300 <?= $is_wishlisted ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>" fill="<?= $is_wishlisted ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </a>

              <button type="button" id="btn-buy-now" class="flex-1 bg-black text-white border-4 border-black shadow-[6px_6px_0_0_#000] hover:bg-[#2563EB] hover:border-[#2563EB] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none font-black uppercase tracking-widest py-4 px-6 transition-all flex items-center justify-center text-center cursor-pointer">
                Beli Sekarang
              </button>
            </div>
          </form>

        <?php else: ?>
          <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <div class="flex-1 bg-gray-200 border-4 border-black py-4 px-6 flex items-center justify-center text-center font-black uppercase text-gray-500 shadow-[6px_6px_0_0_#000]">
              OUT OF STOCK / UNAVAILABLE
            </div>
            <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $produk['id']; ?>?ajax=1" class="btn-wishlist w-full sm:w-20 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] transition-all flex items-center justify-center group py-4" title="Save for Later">
              <svg class="w-8 h-8 transition-colors duration-300 <?= $is_wishlisted ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>" fill="<?= $is_wishlisted ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </a>
          </div>
        <?php endif; ?>

      </div>
    </div>

    <div class="mb-16">
      <div class="flex flex-wrap border-b-4 border-black mb-6 gap-2 pt-2 pl-1">
        <button class="tab-btn px-6 py-3 bg-[#FFE600] border-4 border-black border-b-0 text-sm font-black uppercase tracking-widest shadow-[4px_-4px_0_0_#000] translate-y-1 relative z-10" data-target="desc">
          DESKRIPSI
        </button>
        <button class="tab-btn px-6 py-3 bg-white border-4 border-black border-b-0 text-sm font-black uppercase tracking-widest hover:bg-gray-100 transition-colors" data-target="specs">
          SPESIFIKASI
        </button>
        <button class="tab-btn px-6 py-3 bg-white border-4 border-black border-b-0 text-sm font-black uppercase tracking-widest hover:bg-gray-100 transition-colors" data-target="reviews">
          ULASAN (<?= count($ulasan); ?>)
        </button>
      </div>

      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-10">
        <div id="content-desc" class="tab-content text-black font-medium leading-relaxed">
          <?= nl2br(!empty($produk['description']) ? htmlspecialchars($produk['description']) : 'NO DATA.'); ?>
        </div>
        <div id="content-specs" class="tab-content hidden">
          <?php if (!empty($spesifikasi)): ?>
            <div class="w-full md:w-2/3 border-4 border-black">
              <?php foreach ($spesifikasi as $spec): ?>
                <div class="flex border-b-4 border-black last:border-b-0">
                  <div class="w-1/3 bg-gray-100 p-4 border-r-4 border-black font-black uppercase text-xs"><?= htmlspecialchars($spec['spec_name']); ?></div>
                  <div class="w-2/3 p-4 font-bold text-sm bg-white"><?= htmlspecialchars($spec['spec_value']); ?></div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="font-bold text-gray-500 uppercase">CLASSIFIED. NO SPECS FOUND.</p>
          <?php endif; ?>
        </div>
        <div id="content-reviews" class="tab-content hidden">
          <?php if (!empty($ulasan)): ?>
            <div class="space-y-6 max-w-3xl">
              <?php foreach ($ulasan as $review): ?>
                <div class="border-4 border-black p-5 shadow-[4px_4px_0_0_#000] bg-gray-50 relative">
                  <div class="absolute top-0 right-0 bg-black text-white px-2 py-1 border-l-4 border-b-4 border-black text-[9px] font-black uppercase">
                    <?= date('d M Y', strtotime($review['created_at'])); ?>
                  </div>
                  <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-[#2563EB] border-2 border-black shadow-[2px_2px_0_0_#000] text-white flex items-center justify-center font-black text-xl uppercase">
                      <?= substr($review['reviewer_name'], 0, 1); ?>
                    </div>
                    <div>
                      <h4 class="text-sm font-black uppercase text-black"><?= htmlspecialchars($review['reviewer_name']); ?></h4>
                      <div class="flex text-[#FF5757] mt-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <svg class="w-4 h-4 <?= $i <= $review['rating'] ? 'text-[#FF5757]' : 'text-gray-300' ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                          </svg>
                        <?php endfor; ?>
                      </div>
                    </div>
                  </div>
                  <p class="text-sm font-medium text-black bg-white border-2 border-black p-3"><?= htmlspecialchars($review['comment']); ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="font-bold text-gray-500 uppercase">NO FIELD REPORTS FILED YET. BE THE FIRST TO DEPLOY.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if (!empty($produk_serupa)): ?>
      <div class="mb-10" data-aos="fade-up">
        <h2 class="italic text-2xl font-black text-black uppercase tracking-tight mb-6 border-b-4 border-black pb-2">PRODUK SERUPA</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 gap-y-10">
          <?php foreach ($produk_serupa as $sim_prod):
            $sim_disc = !empty($sim_prod['discount_price']) && $sim_prod['discount_price'] > 0;
            $sim_harga = $sim_disc ? $sim_prod['discount_price'] : $sim_prod['price'];
            $sim_pct = $sim_disc ? round((($sim_prod['price'] - $sim_prod['discount_price']) / $sim_prod['price']) * 100) : 0;
            $sim_img = 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
            if (!empty($sim_prod['image_url'])) {
              $sim_img = str_starts_with($sim_prod['image_url'], 'http') ? $sim_prod['image_url'] : BASEURL . '/img/products/' . $sim_prod['image_url'];
            }
            $is_sim_fav = isset($sim_prod['is_wishlisted']) && $sim_prod['is_wishlisted'] === true;
          ?>
            <div class="group relative flex flex-col h-full">
              <a href="<?= BASEURL; ?>/wishlist/toggle/<?= $sim_prod['id']; ?>?ajax=1" class="btn-wishlist absolute top-2 right-2 z-20 bg-white border-2 border-black p-1.5 shadow-[2px_2px_0_0_#000] hover:bg-[#FF90E8] active:shadow-none active:translate-y-[1px] active:translate-x-[1px] transition-all group" title="Save to Wishlist">
                <svg class="w-4 h-4 transition-colors duration-300 <?= $is_sim_fav ? 'fill-[#FF5757] text-[#FF5757]' : 'text-black' ?>" fill="<?= $is_sim_fav ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </a>
              <a href="<?= BASEURL; ?>/produk/detail/<?= $sim_prod['slug']; ?>" class="block border-4 border-black shadow-[6px_6px_0_0_#000] bg-white aspect-square mb-4 overflow-hidden group-hover:-translate-y-1 group-hover:shadow-[8px_8px_0_0_#000] transition-all relative">
                <?php if ($sim_disc): ?>
                  <div class="absolute top-0 left-0 bg-[#FF5757] text-white text-[10px] font-black px-2 py-1 border-b-2 border-r-2 border-black z-10">-<?= $sim_pct; ?>%</div>
                <?php endif; ?>
                <img src="<?= $sim_img; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 transition-all">
              </a>
              <div class="flex-1 flex flex-col">
                <h3 class="font-black text-sm uppercase leading-snug mb-1 line-clamp-2"><a href="<?= BASEURL; ?>/produk/detail/<?= $sim_prod['slug']; ?>" class="hover:text-[#2563EB] transition-colors"><?= $sim_prod['name']; ?></a></h3>
                <div class="mt-auto flex items-end justify-between pt-2">
                  <div>
                    <?php if ($sim_disc): ?>
                      <p class="text-[10px] text-gray-500 line-through font-bold mb-0.5">Rp <?= number_format((float)$sim_prod['price'], 0, ',', '.'); ?></p>
                      <p class="text-[#2563EB] font-black text-sm">Rp <?= number_format((float)$sim_harga, 0, ',', '.'); ?></p>
                    <?php else: ?>
                      <p class="text-black font-black text-sm">Rp <?= number_format((float)$sim_prod['price'], 0, ',', '.'); ?></p>
                    <?php endif; ?>
                  </div>
                  <form action="<?= BASEURL; ?>/cart/add?ajax=1" method="POST" class="ajax-add-cart">
                    <input type="hidden" name="product_id" value="<?= $sim_prod['id']; ?>">
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
      </div>
    <?php endif; ?>

  </div>
</div>

<script src="<?= BASEURL; ?>/js/detail.js?v=<?= time(); ?>"></script>
<script src="<?= BASEURL; ?>/js/wishlist.js?v=<?= time(); ?>"></script>