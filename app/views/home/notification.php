<div class="bg-[#F8F9FA] min-h-screen font-sans text-black pt-10 pb-20" data-aos="fade-in">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-10 border-b-8 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none" style="-webkit-text-stroke: 2px black;">
          SISTEM <br> NOTIFIKASI
        </h1>
        <p class="text-sm font-black mt-4 text-gray-700 uppercase tracking-[0.2em] border-l-8 border-[#2563EB] pl-4">
          LOG AKTIVITAS DAN PEMBARUAN STATUS GEAR ANDA
        </p>
      </div>

      <?php if (!empty($data['notifications'])): ?>
        <form action="<?= BASEURL; ?>/notification/readAll" method="POST">
          <button type="submit" class="bg-white text-black border-4 border-black px-6 py-3 font-black uppercase tracking-widest shadow-[6px_6px_0_0_#000] hover:bg-[#A6FAAE] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
            TANDAI SEMUA DIBACA
          </button>
        </form>
      <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-8 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <p><?= $_SESSION['flash_success']; ?></p>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (empty($data['notifications'])): ?>

      <div class="bg-white border-8 border-black p-12 text-center shadow-[12px_12px_0_0_#000]">
        <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        <h2 class="text-3xl font-black uppercase mb-4">TIDAK ADA TRANSMISI</h2>
        <p class="font-bold text-gray-500 mb-8">BELUM ADA NOTIFIKASI BARU UNTUK SAAT INI.</p>
        <a href="<?= BASEURL; ?>/katalog" class="inline-block bg-[#FFE600] text-black border-4 border-black px-10 py-4 font-black uppercase tracking-widest shadow-[6px_6px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] transition-all">
          KEMBALI KE BASE
        </a>
      </div>

    <?php else: ?>

      <div class="space-y-4">
        <?php foreach ($data['notifications'] as $notif):
          $is_read = (bool)$notif['is_read'];
        ?>
          <div class="relative bg-white border-4 border-black p-5 md:p-6 transition-all <?= $is_read ? 'opacity-70' : 'shadow-[8px_8px_0_0_#000] hover:-translate-y-1' ?>">

            <?php if (!$is_read): ?>
              <div class="absolute -top-3 -left-3 bg-[#FF5757] text-white border-2 border-black px-2 py-1 text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000] animate-pulse">
                BARU
              </div>
            <?php endif; ?>

            <div class="flex items-start justify-between gap-4">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="text-lg md:text-xl font-black uppercase leading-tight <?= !$is_read ? 'text-[#2563EB]' : 'text-black' ?>">
                    <?= htmlspecialchars($notif['title']); ?>
                  </h3>
                </div>
                <p class="text-sm font-medium text-gray-700 leading-relaxed mb-4">
                  <?= nl2br(htmlspecialchars($notif['message'])); ?>
                </p>
                <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <?= date('d M Y - H:i', strtotime($notif['created_at'])); ?>
                </div>
              </div>

              <?php if (!$is_read): ?>
                <a href="<?= BASEURL; ?>/notification/read/<?= $notif['id']; ?>" class="flex-shrink-0 bg-[#FFE600] border-2 border-black p-2 shadow-[2px_2px_0_0_#000] hover:bg-[#A6FAAE] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-none transition-all" title="Tandai Dibaca">
                  <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </a>
              <?php else: ?>
                <div class="flex-shrink-0 p-2 text-gray-300" title="Sudah Dibaca">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
              <?php endif; ?>
            </div>

          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

  </div>
</div>