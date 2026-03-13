<div class="bg-[#F8F9FA] min-h-screen pt-10 pb-20 font-sans text-black" data-aos="fade-in">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8 border-b-4 border-black pb-4">
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">PROFIL SAYA</h1>
      <p class="text-sm font-bold mt-2 text-gray-700 bg-[#FFE600] inline-block px-3 py-1 border-2 border-black shadow-[2px_2px_0_0_#000]">PENGATURAN IDENTITAS & OPERASIONAL</p>
    </div>

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <p><?= $_SESSION['flash_success']; ?></p>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <div class="flex flex-col md:flex-row gap-8 items-start">

      <div class="w-full md:w-1/3 lg:w-1/4 space-y-6">

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 text-center">
          <div class="w-20 h-20 mx-auto bg-[#2563EB] border-4 border-black shadow-[4px_4px_0_0_#000] flex items-center justify-center mb-4">
            <span class="text-3xl font-black text-white uppercase"><?= substr($data['user']['name'], 0, 1); ?></span>
          </div>
          <h3 class="font-black text-lg uppercase truncate"><?= htmlspecialchars($data['user']['name']); ?></h3>
          <p class="text-xs font-bold text-gray-500 uppercase"><?= htmlspecialchars($data['user']['role']); ?></p>
        </div>

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] flex flex-col">
          <a href="<?= BASEURL; ?>/profile" class="bg-[#FFE600] border-b-4 border-black p-4 font-black uppercase text-sm flex items-center justify-between group">
            <span>INFORMASI PROFIL</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="<?= BASEURL; ?>/order" class="bg-white hover:bg-gray-100 border-b-4 border-black p-4 font-black uppercase text-sm flex items-center justify-between group transition-colors">
            <span>RIWAYAT PESANAN</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="<?= BASEURL; ?>/auth/logout" class="bg-white hover:bg-[#FF5757] hover:text-white p-4 font-black uppercase text-sm flex items-center justify-between group transition-colors text-[#FF5757]">
            <span>LOGOUT</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
          </a>
        </div>

      </div>

      <div class="w-full md:w-2/3 lg:w-3/4">
        <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-8">
          <h2 class="text-2xl font-black uppercase mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-[#2563EB]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            UPDATE DATA IDENTITAS
          </h2>

          <form id="form-profile" action="<?= BASEURL; ?>/profile/update" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

              <div>
                <label class="block text-xs font-black uppercase tracking-widest mb-2">NAMA LENGKAP</label>
                <input type="text" name="name" value="<?= htmlspecialchars($data['user']['name'] ?? ''); ?>" required class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all">
              </div>

              <div>
                <label class="block text-xs font-black uppercase tracking-widest mb-2">ALAMAT EMAIL <span class="text-gray-500">(READ ONLY)</span></label>
                <input type="email" name="email" value="<?= htmlspecialchars($data['user']['email'] ?? ''); ?>" readonly class="w-full bg-gray-200 border-2 border-black px-4 py-3 font-bold text-sm outline-none text-gray-500 cursor-not-allowed">
              </div>

              <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest mb-2">NOMOR TELEPON / WHATSAPP</label>
                <input type="tel" name="phone" value="<?= htmlspecialchars($data['user']['phone'] ?? ''); ?>" placeholder="Contoh: 081234567890" class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all">
              </div>
            </div>

            <div>
              <label class="block text-xs font-black uppercase tracking-widest mb-2">ALAMAT PENGIRIMAN UTAMA</label>
              <textarea name="address" rows="4" placeholder="Tuliskan alamat lengkap beserta RT/RW, Kelurahan, Kecamatan, dan Kode Pos." class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all"><?= htmlspecialchars($data['user']['address'] ?? ''); ?></textarea>
              <p class="text-[10px] font-bold text-gray-500 mt-2">* Alamat ini akan otomatis ditarik saat Anda melakukan Checkout.</p>
            </div>

            <div class="pt-4 border-t-4 border-black mt-6 flex justify-end">
              <button type="submit" class="bg-[#2563EB] text-white border-4 border-black px-8 py-3 text-sm font-black uppercase tracking-widest shadow-[6px_6px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] hover:shadow-[8px_8px_0_0_#000] active:translate-y-[4px] active:translate-x-[4px] active:shadow-none transition-all flex items-center">
                SIMPAN PERUBAHAN
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
              </button>
            </div>

          </form>
        </div>
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
    <p id="global-toast-success-msg" class="text-xs font-bold text-gray-600 mt-0.5">Profile berhasil diperbarui.</p>
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

<script src="<?= BASEURL; ?>/js/profile.js?v=<?= time(); ?>"></script>