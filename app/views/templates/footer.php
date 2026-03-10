<footer class="bg-[#F8F9FA] border-t-4 border-black font-sans text-black" data-aos="fade-up">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="flex flex-col md:flex-row justify-between gap-12 md:gap-20">

      <div class="w-full md:w-1/2">
        <h2 class="text-5xl md:text-6xl font-black uppercase tracking-tighter leading-[0.9] mb-6">
          DAPATKAN INFO <br>PROMO <br>TERBARU.
        </h2>
        <p class="text-sm font-bold text-gray-700 mb-8 max-w-sm">
          Subscribe newsletter kami dan dapatkan voucher diskon 10% untuk pembelian pertama!
        </p>

        <form class="flex flex-col sm:flex-row gap-3">
          <input type="email" placeholder="Masukkan email Anda" required
            class="flex-1 bg-gray-50 border-2 border-black px-4 py-3.5 text-xs font-black uppercase outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all placeholder-gray-400">
          <button type="submit"
            class="bg-[#2563EB] text-white border-2 border-black px-8 py-3.5 text-xs font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] hover:shadow-[6px_6px_0_0_#000] active:translate-y-[4px] active:translate-x-[4px] active:shadow-none transition-all">
            Langganan
          </button>
        </form>
      </div>

      <div class="w-full md:w-1/2 flex justify-start md:justify-end gap-16 md:gap-24">

        <div class="flex flex-col space-y-4">
          <h4 class="text-[#2563EB] text-[10px] font-black uppercase tracking-widest mb-2">INTELLIGENCE</h4>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">ORDERS</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">SHIPPING</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">RETURNS</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">FAQ</a>
        </div>

        <div class="flex flex-col space-y-4">
          <h4 class="text-[#2563EB] text-[10px] font-black uppercase tracking-widest mb-2">NETWORK</h4>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">DISCORD</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">INSTAGRAM</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">X / TWITTER</a>
          <a href="#" class="text-xs font-black uppercase hover:text-[#2563EB] hover:translate-x-1 transition-transform">TWITCH</a>
        </div>

      </div>

    </div>
  </div>

  <div class="border-t-2 border-black bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">
      <p>&copy; <?= date('Y'); ?> TI MART. ALL RIGHTS RESERVED.</p>

      <div class="flex space-x-6">
        <a href="#" class="hover:text-black transition-colors">PRIVACY PROTOCOL</a>
        <a href="#" class="hover:text-black transition-colors">TERMS OF ENGAGEMENT</a>
      </div>
    </div>
  </div>

</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 600,
    easing: 'ease-out-cubic'
  });
</script>
</body>

</html>