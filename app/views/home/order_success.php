<div class="bg-[#F8F9FA] min-h-screen font-sans text-black py-16" data-aos="zoom-in">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] p-8 mb-10 text-center relative overflow-hidden">
      <div class="absolute -right-10 -top-10 w-32 h-32 bg-white rounded-full mix-blend-overlay opacity-50"></div>

      <svg class="w-20 h-20 mx-auto mb-6 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight mb-2">ORDER SECURED</h1>
      <p class="font-bold text-black uppercase tracking-widest text-sm bg-white border-2 border-black inline-block px-4 py-1 mt-2 shadow-[2px_2px_0_0_#000]">
        INV: <?= htmlspecialchars($data['order']['invoice_number']); ?>
      </p>
    </div>

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-10 mb-10">
      <h2 class="text-2xl font-black uppercase border-b-4 border-black pb-4 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-3 text-[#2563EB]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
        </svg>
        PAYMENT INTEL
      </h2>

      <div class="mb-8 border-l-4 border-[#FF5757] pl-4">
        <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-1">TOTAL AMOUNT REQUIRED</p>
        <p class="text-4xl md:text-5xl font-black text-[#2563EB] tracking-tighter">
          Rp <?= number_format((float)$data['order']['grand_total'], 0, ',', '.'); ?>
        </p>
      </div>

      <div class="bg-gray-50 border-4 border-black p-6 mb-8 relative">
        <div class="absolute -top-4 -right-4 bg-[#FFE600] border-2 border-black px-3 py-1 text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000]">
          <?= htmlspecialchars($data['order']['payment_method']); ?>
        </div>

        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">TRANSFER DESTINATION</p>

        <?php if (str_contains(strtolower($data['order']['payment_method']), 'bca')): ?>
          <p class="text-3xl md:text-4xl font-black tracking-widest mb-1">8732-192-333</p>
          <p class="font-bold uppercase text-sm text-gray-600">A.N. TI MART TACTICAL</p>

        <?php elseif (str_contains(strtolower($data['order']['payment_method']), 'mandiri')): ?>
          <p class="text-3xl md:text-4xl font-black tracking-widest mb-1">137-000-999-888</p>
          <p class="font-bold uppercase text-sm text-gray-600">A.N. TI MART TACTICAL</p>

        <?php else: ?>
          <p class="font-bold uppercase text-sm text-gray-600 mb-4">SCAN THIS QRIS CODE TO PAY:</p>
          <div class="w-48 h-48 bg-white border-4 border-black p-2 shadow-[4px_4px_0_0_#000]">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=TI-MART-DUMMY-PAYMENT-QRIS" alt="QRIS Code" class="w-full h-full object-contain">
          </div>
        <?php endif; ?>
      </div>

      <div class="flex items-start bg-[#FF5757] text-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] mb-8">
        <svg class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <div>
          <h4 class="font-black uppercase text-sm mb-1">TIME SENSITIVE</h4>
          <p class="text-xs font-bold uppercase leading-relaxed">Complete your payment within 24 hours and upload the proof. Failure to do so will result in order termination.</p>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4">
        <a href="<?= BASEURL; ?>/pesanan" class="flex-1 bg-[#2563EB] text-white border-4 border-black text-center py-4 font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all flex items-center justify-center">
          UPLOAD PROOF
          <svg class="w-5 h-5 ml-3 border-l-2 border-white pl-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
          </svg>
        </a>

        <a href="<?= BASEURL; ?>" class="flex-1 bg-white text-black border-4 border-black text-center py-4 font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all flex items-center justify-center">
          BACK TO BASE
        </a>
      </div>

    </div>

  </div>
</div>