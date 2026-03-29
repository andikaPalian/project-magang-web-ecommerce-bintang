<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-2">RIWAYAT PENJUALAN</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Buku besar pencatatan transaksi offline. Seluruh aliran dana dan struk pembayaran yang diproses melalui POS System cabang Anda terekam di sini.
      </p>
    </div>

    <div class="mt-4 md:mt-0 w-full md:w-80">
      <div class="flex w-full bg-white border-4 border-black shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 transition-transform">
        <div class="p-2 border-r-4 border-black bg-gray-50 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" id="searchHistory" placeholder="CARI INVOICE / KASIR..." class="w-full px-3 py-2 font-black text-xs uppercase outline-none placeholder-gray-400">
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-hidden flex flex-col">

    <div class="bg-black text-white grid grid-cols-12 gap-4 p-4 border-b-4 border-black text-[10px] font-black tracking-widest hidden md:grid">
      <div class="col-span-2">WAKTU (WITA)</div>
      <div class="col-span-3">NO. INVOICE</div>
      <div class="col-span-2">KASIR / STAFF</div>
      <div class="col-span-2 text-center">METODE</div>
      <div class="col-span-1 text-center">STATUS</div>
      <div class="col-span-2 text-right">TOTAL NILAI</div>
    </div>

    <div class="flex-1 overflow-y-auto max-h-[60vh] bg-white">
      <?php if (empty($data['history'])): ?>
        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
          <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <h2 class="font-black text-xl text-black">TIDAK ADA DATA</h2>
          <p class="text-[10px] font-bold uppercase tracking-widest mt-2">Belum ada transaksi yang terjadi di cabang ini.</p>
        </div>
      <?php else: ?>

        <?php foreach ($data['history'] as $log): ?>
          <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-4 p-4 border-b-2 border-dashed border-gray-300 items-center bg-white hover:bg-gray-100 transition-colors history-row">

            <div class="col-span-1 md:col-span-2 flex flex-col">
              <span class="font-black text-xs text-black"><?= date('d M Y', strtotime($log['created_at'])) ?></span>
              <span class="font-bold text-[9px] text-gray-500"><?= date('H:i:s', strtotime($log['created_at'])) ?></span>
            </div>

            <div class="col-span-1 md:col-span-3">
              <span class="bg-[#FFE600] border-2 border-black px-2 py-1 font-mono font-black text-[10px] shadow-[2px_2px_0_0_#000] inline-block invoice-number">
                <?= htmlspecialchars($log['invoice_number']) ?>
              </span>
            </div>

            <div class="col-span-1 md:col-span-2">
              <span class="font-black text-[10px] cashier-name">
                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <?= htmlspecialchars($log['kasir_name'] ?? 'SYSTEM') ?>
              </span>
            </div>

            <div class="col-span-1 md:col-span-2 text-left md:text-center font-black text-[10px] text-[#2563EB]">
              [<?= strtoupper(htmlspecialchars($log['payment_method'] ?? 'UNKNOWN')) ?>]
            </div>

            <div class="col-span-1 md:col-span-1 text-left md:text-center">
              <?php if ($log['payment_status'] === 'paid'): ?>
                <span class="bg-[#4ADE80] border-2 border-black px-2 py-0.5 text-[9px] font-black text-black">PAID</span>
              <?php else: ?>
                <span class="bg-[#FF5757] border-2 border-black px-2 py-0.5 text-[9px] font-black text-white">FAIL</span>
              <?php endif; ?>
            </div>

            <div class="col-span-1 md:col-span-2 text-left md:text-right font-black text-sm md:text-base text-black mt-2 md:mt-0">
              Rp <?= number_format((float)$log['grand_total'], 0, ',', '.') ?>
            </div>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>

    <div class="bg-gray-100 p-4 border-t-4 border-black flex justify-between items-center shrink-0">
      <p class="text-[9px] font-black text-gray-500">
        TOTAL TRANSAKSI: <?= count($data['history']) ?> LOGS
      </p>
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchHistory');
    const rows = document.querySelectorAll('.history-row');

    searchInput.addEventListener('keyup', function(e) {
      const keyword = e.target.value.toLowerCase();

      rows.forEach(row => {
        const invoiceName = row.querySelector('.invoice-number').innerText.toLowerCase();
        const cashierName = row.querySelector('.cashier-name').innerText.toLowerCase();

        if (invoiceName.includes(keyword) || cashierName.includes(keyword)) {
          row.classList.remove('hidden');
        } else {
          row.classList.add('hidden');
        }
      });
    });
  });
</script>