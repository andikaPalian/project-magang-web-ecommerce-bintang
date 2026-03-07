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
        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3 tracking-tight">Selamat Datang!</h2>
        <p class="text-sm text-gray-500 font-medium">Masuk ke akun Anda untuk melacak pesanan dan menikmati promo eksklusif.</p>
      </div>

      <?php if (isset($data['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          <?= $data['error']; ?>
        </div>
      <?php endif; ?>
      <?php if (isset($data['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <?= $data['success']; ?>
        </div>
      <?php endif; ?>

      <form action="<?= BASEURL; ?>/auth/authenticate" method="POST" class="space-y-5">
        <div>
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
          <input id="email" name="email" type="email" required
            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
            placeholder="email@example.com">
        </div>

        <div>
          <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
          <input id="password" name="password" type="password" required
            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-50 focus:border-[#ef4444] transition-all text-sm font-medium text-gray-900"
            placeholder="••••••••">
          <div class="text-right mt-2">
            <a href="#" class="text-xs font-bold text-[#ef4444] hover:text-red-700 transition-colors hover:underline">Lupa password?</a>
          </div>
        </div>

        <div class="flex items-center pt-1">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[#ef4444] focus:ring-[#ef4444] border-gray-300 rounded cursor-pointer">
          <label for="remember-me" class="ml-2.5 block text-sm font-medium text-gray-600 cursor-pointer">Ingat saya</label>
        </div>

        <button type="submit" class="w-full flex justify-center py-4 px-4 mt-6 border border-transparent rounded-xl shadow-lg shadow-red-500/30 text-sm font-bold text-white bg-[#ef4444] hover:bg-red-600 hover:shadow-red-600/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ef4444] transition-all active:scale-[0.98]">
          Masuk Sekarang
        </button>
      </form>

      <div class="mt-10 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm font-medium text-gray-600">
          Belum bergabung dengan kami?
          <a href="<?= BASEURL; ?>/auth/register" class="font-bold text-[#ef4444] hover:text-red-700 hover:underline ml-1 transition-colors">Daftar Akun Baru</a>
        </p>
      </div>
    </div>
  </div>

  <div class="hidden lg:flex lg:w-1/2 bg-[#1e293b] relative h-screen sticky top-0 flex-col justify-end p-12 xl:p-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img class="h-full w-full object-cover opacity-60 mix-blend-overlay" src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1200&q=80" alt="ALASKA Electronics Background">
      <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-[#1e293b]/60 to-transparent"></div>
    </div>

    <div class="relative z-10 text-white max-w-lg" data-aos="fade-up" data-aos-delay="300">
      <h3 class="text-4xl xl:text-5xl font-extrabold mb-4 leading-tight tracking-tight">Teknologi Terkini di Ujung Jari Anda.</h3>
      <p class="text-base text-gray-300 leading-relaxed font-medium">Jelajahi ribuan produk elektronik original bergaransi resmi. Belanja cerdas, aman, dan nyaman hanya di ALASKA Electronics.</p>
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