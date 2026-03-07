<div class="flex min-h-screen bg-white">

  <div class="w-full lg:w-1/2 flex flex-col relative h-screen overflow-y-auto scrollbar-hide" data-aos="fade-right">

    <div class="absolute top-6 left-6 sm:top-8 sm:left-10 z-50">
      <a href="<?= BASEURL; ?>" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-[#ef4444] transition-all bg-white hover:bg-red-50 px-4 py-2.5 rounded-full border border-gray-200 shadow-sm hover:shadow">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
      </a>
    </div>

    <div class="flex-1 flex flex-col justify-center w-full max-w-md mx-auto px-6 py-28">

      <div class="mb-10 text-left">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 font-medium">Lengkapi data diri Anda di bawah ini untuk mulai berbelanja.</p>
      </div>

      <?php if (isset($data['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          <?= $data['error']; ?>
        </div>
      <?php endif; ?>

      <form action="<?= BASEURL; ?>/auth/storeRegistration" method="POST" class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
          <input id="name" name="name" type="text" required
            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
            placeholder="Masukkan Nama Lengkap Anda">
        </div>

        <div>
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
          <input id="email" name="email" type="email" required
            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
            placeholder="email@example.com">
        </div>

        <div>
          <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
          <input id="phone" name="phone" type="tel" required
            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
            placeholder="Contoh: 081234567890">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
            <input id="password" name="password" type="password" required minlength="6"
              class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
              placeholder="Min. 6 karakter">
          </div>
          <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Ulangi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
              class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
              placeholder="Konfirmasi">
          </div>
        </div>

        <div class="flex items-start pt-2">
          <div class="flex items-center h-5">
            <input id="terms" name="terms" type="checkbox" required class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-[#ef4444] text-[#ef4444] cursor-pointer">
          </div>
          <label for="terms" class="ml-2.5 text-xs font-medium text-gray-500 leading-relaxed cursor-pointer">
            Saya menyetujui <a href="#" class="text-[#ef4444] hover:underline font-bold">Syarat & Ketentuan</a> serta <a href="#" class="text-[#ef4444] hover:underline font-bold">Kebijakan Privasi</a>.
          </label>
        </div>

        <button type="submit" class="w-full flex justify-center py-4 px-4 mt-6 border border-transparent rounded-xl shadow-lg shadow-red-500/30 text-sm font-bold text-white bg-[#ef4444] hover:bg-red-600 hover:shadow-red-600/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ef4444] transition-all active:scale-[0.98]">
          Daftar Sekarang
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm font-medium text-gray-600">
          Sudah memiliki akun?
          <a href="<?= BASEURL; ?>/auth" class="font-bold text-[#ef4444] hover:text-red-700 hover:underline ml-1 transition-colors">Masuk di sini</a>
        </p>
      </div>
    </div>
  </div>

  <div class="hidden lg:flex lg:w-1/2 bg-[#0f172a] relative h-screen sticky top-0 flex-col justify-end p-12 xl:p-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img class="h-full w-full object-cover opacity-50 mix-blend-overlay" src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=80" alt="ALASKA Workspace">
      <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-[#0f172a]/60 to-transparent"></div>
    </div>

    <div class="relative z-10 text-white max-w-lg" data-aos="fade-up" data-aos-delay="300">
      <h3 class="text-4xl xl:text-5xl font-extrabold mb-4 leading-tight tracking-tight">Kualitas Terbaik. Harga Spesial.</h3>
      <p class="text-base text-gray-300 leading-relaxed font-medium">Jadilah bagian dari ribuan pelanggan puas lainnya. Nikmati voucher khusus pengguna baru dan layanan prioritas 24/7.</p>
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 800
  });
</script>
</body>

</html>