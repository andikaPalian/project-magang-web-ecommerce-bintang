<div class="bg-[#F8F9FA] min-h-screen pb-20 font-sans text-black" data-aos="fade-in">

  <div class="relative w-full h-[350px] border-b-4 border-black px-4 text-center flex flex-col items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center grayscale-[40%]" style="background-image: url('https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1600&q=80');"></div>

    <div class="absolute inset-0 bg-black opacity-80"></div>

    <div class="relative z-10">
      <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tight text-white mb-6" style="-webkit-text-stroke: 2px black; text-shadow: 4px 4px 0 #000;">
        BLOG & ARTICLE
      </h1>
      <p class="text-sm md:text-base font-bold bg-[#FFE600] text-black inline-block px-6 py-3 border-4 border-black shadow-[6px_6px_0_0_#000] uppercase tracking-widest">
        Artikel dan Promo Terbaru
      </p>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">

    <?php if (isset($_SESSION['flash_error'])): ?>
      <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-8 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center" data-aos="fade-down">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <p><?= $_SESSION['flash_error']; ?></p>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>
    <?php if (empty($data['articles'])): ?>
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-12 text-center">
        <h3 class="text-2xl font-black uppercase mb-2">TIDAK ADA TRANSMISI</h3>
        <p class="text-gray-500 font-bold uppercase text-xs">Belum ada artikel atau promo yang dipublikasikan.</p>
      </div>
    <?php else: ?>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($data['articles'] as $article):
          $img_src = !empty($article['image_url']) ? $article['image_url'] : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=600&q=80';
          $tanggal = date('d M Y', strtotime($article['created_at']));
        ?>
          <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col group hover:-translate-y-2 hover:shadow-[12px_12px_0_0_#000] transition-all duration-300">
            <a href="<?= BASEURL; ?>/article/read/<?= $article['slug']; ?>" class="h-56 border-b-4 border-black overflow-hidden relative block">
              <img src="<?= $img_src; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale-[20%] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
              <div class="absolute top-3 left-3 bg-[#FFE600] border-2 border-black px-3 py-1 text-xs font-black uppercase shadow-[2px_2px_0_0_#000]">
                <?= $tanggal; ?>
              </div>
            </a>

            <div class="p-6 flex-1 flex flex-col">
              <p class="text-[10px] font-black uppercase text-[#2563EB] mb-2 tracking-widest border-b-2 border-black inline-block self-start pb-0.5">Oleh: <?= $article['author_name']; ?></p>

              <h3 class="text-xl font-black uppercase leading-tight mb-3">
                <a href="<?= BASEURL; ?>/article/read/<?= $article['slug']; ?>" class="hover:text-[#FF5757] transition-colors line-clamp-2">
                  <?= $article['title']; ?>
                </a>
              </h3>

              <p class="text-sm font-bold text-gray-600 mb-6 line-clamp-3">
                <?= $article['excerpt']; ?>
              </p>

              <a href="<?= BASEURL; ?>/article/read/<?= $article['slug']; ?>" class="mt-auto bg-black text-white text-xs font-black uppercase tracking-widest px-4 py-3 text-center border-2 border-black hover:bg-[#A6FAAE] hover:text-black transition-colors w-full flex justify-between items-center">
                <span>BACA SELENGKAPNYA</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

  </div>
</div>