<div class="bg-[#F8F9FA] min-h-screen pt-10 pb-20 font-sans text-black" data-aos="fade-in">
  <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-10 border-b-4 border-black pb-4">
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">UPLOAD BUKTI PEMBAYARAN</h1>
      <p class="text-sm font-bold mt-2 text-gray-700 uppercase tracking-widest border-l-4 border-[#2563EB] pl-2">SUBMIT BUKTI PEMBAYARAN ANDA UNTUK KONFIRMASI PESANAN ANDA</p>
    </div>

    <?php if (isset($_SESSION['flash_error'])): ?>
      <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <p><?= $_SESSION['flash_error']; ?></p>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-10 relative">

      <div class="absolute -top-4 -right-4 bg-[#FFE600] border-2 border-black px-4 py-2 font-black uppercase shadow-[4px_4px_0_0_#000] text-sm hidden sm:block">
        INV: <?= htmlspecialchars($data['order']['invoice_number']); ?>
      </div>

      <div class="mb-6">
        <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-1">TOTAL AMOUNT REQUIRED</p>
        <p class="text-3xl font-black text-black tracking-tighter">Rp <?= number_format((float)$data['order']['grand_total'], 0, ',', '.'); ?></p>
      </div>

      <form action="<?= BASEURL; ?>/order/processUpload" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">

        <div class="mb-8 mt-4">
          <label class="block text-xs font-black uppercase tracking-widest text-black mb-3 bg-[#A6FAAE] border-2 border-black px-2 py-1 inline-block">SELECT PROOF IMAGE (JPG/PNG)</label>

          <div class="relative border-4 border-dashed border-black bg-gray-50 hover:bg-[#90E0FF] transition-colors duration-300 group cursor-pointer mt-2 h-48">
            <input type="file" name="payment_proof" id="payment_proof" accept="image/jpeg, image/png, image/jpg" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none p-4 text-center">
              <svg class="w-12 h-12 mb-4 text-black group-hover:-translate-y-2 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
              </svg>
              <p class="font-black uppercase text-sm md:text-base tracking-widest" id="file-name-display">CLICK OR DRAG FILE HERE</p>
              <p class="text-[10px] font-bold text-gray-500 mt-2 uppercase tracking-widest bg-white border-2 border-black px-2 py-0.5">MAX FILE SIZE: 5MB</p>
            </div>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 mt-10">
          <button type="submit" class="flex-1 bg-[#2563EB] text-white border-4 border-black text-center py-4 font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:translate-y-[6px] active:translate-x-[6px] active:shadow-none transition-all cursor-pointer z-20 relative">
            UPLOAD
          </button>

          <a href="<?= BASEURL; ?>/order" class="flex-1 bg-white text-black border-4 border-black text-center py-4 font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:bg-[#FF5757] hover:text-white hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:translate-y-[6px] active:translate-x-[6px] active:shadow-none transition-all z-20 relative">
            CANCEL
          </a>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
  const fileInput = document.getElementById('payment_proof');
  const fileNameDisplay = document.getElementById('file-name-display');

  fileInput.addEventListener('change', function() {
    if (this.files && this.files.length > 0) {
      fileNameDisplay.textContent = 'SELECTED: ' + this.files[0].name;
      fileNameDisplay.classList.add('text-[#2563EB]', 'bg-white', 'border-2', 'border-black', 'px-2', 'py-1');
    } else {
      fileNameDisplay.textContent = 'CLICK OR DRAG FILE HERE';
      fileNameDisplay.classList.remove('text-[#2563EB]', 'bg-white', 'border-2', 'border-black', 'px-2', 'py-1');
    }
  });
</script>