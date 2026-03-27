<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-6" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">HISTORY DELIVERY</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola riwayat pengiriman barang.
      </p>
    </div>
  </div>

  <?php $totalHistory = count($data['history'] ?? []); ?>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between relative">
      <h3 class="text-[10px] font-black tracking-widest mb-2 text-gray-500 border-b-2 border-black pb-2">SELESAI DIKIRIM</h3>
      <div class="flex items-end gap-2 mt-4">
        <span class="text-5xl font-black text-black leading-none"><?= str_pad((string)$totalHistory, 2, '0', STR_PAD_LEFT) ?></span>
        <span class="text-sm font-black mb-1">UNITS</span>
      </div>
    </div>

    <div class="md:col-span-2 bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex items-start gap-4">
      <div class="bg-black text-[#A6FAAE] w-16 h-16 flex items-center justify-center font-black text-4xl shrink-0 border-4 border-black shadow-[4px_4px_0_0_#fff]">
        ✓
      </div>
      <div class="pt-1">
        <h3 class="text-2xl font-black tracking-tight mb-2 text-black">INFORMASI</h3>
        <p class="text-[10px] font-bold leading-relaxed text-black tracking-widest">
          SELURUH DATA PADA DELIVERY INI TELAH DIVALIDASI SEBAGAI SELESAI. BUKTI SERAH TERIMA TELAH TERSIMPAN AMAN DI SERVER PUSAT TI MART. TIDAK ADA TINDAKAN LANJUTAN YANG DIPERLUKAN DARI OPERATOR.
        </p>
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">

    <div class="bg-black text-white font-black text-sm tracking-widest p-5 flex justify-between items-center">
      <span>LIST HISTORY DELIVERY</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-[#F8F9FA] font-black text-[10px] text-gray-500">
          <tr class="border-b-4 border-black">
            <th class="p-6 border-r-2 border-black w-48 tracking-widest">ORDER ID</th>
            <th class="p-6 border-r-2 border-black tracking-widest">CUSTOMER</th>
            <th class="p-6 border-r-2 border-black tracking-widest">DESTINATION ADDRESS</th>
            <th class="p-6 border-r-2 border-black w-48 text-center tracking-widest">TIME COMPLETED</th>
            <th class="p-6 text-center w-40 tracking-widest">STATUS</th>
          </tr>
        </thead>
        <tbody class="font-bold text-black">
          <?php if (empty($data['history'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black bg-white uppercase text-sm border-b-4 border-black">
                NO COMPLETED DELIVERIES FOUND IN RECORD.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['history'] as $history): ?>
              <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors opacity-90">

                <td class="p-6 border-r-2 border-black align-middle">
                  <span class="font-black text-xl block mb-2 tracking-wide text-gray-700">
                    #<?= explode('-', $history['invoice_number'])[2] ?? $history['invoice_number'] ?>
                  </span>
                  <span class="text-[9px] text-gray-500 font-mono tracking-widest block font-bold">
                    TRK: <?= htmlspecialchars($history['tracking_number'] ?? 'N/A') ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black align-middle">
                  <span class="font-black text-sm block tracking-widest text-gray-800">
                    <?= htmlspecialchars($history['recipient_name'] ?: $history['customer_name']) ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black align-middle">
                  <span class="text-[10px] leading-relaxed block tracking-widest font-bold text-gray-600">
                    <?= htmlspecialchars($history['shipping_address']) ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black text-center align-middle">
                  <span class="text-2xl font-black tracking-tighter text-black block">
                    <?= date('H:i', strtotime($history['completed_at'])) ?>
                  </span>
                  <span class="text-[9px] text-gray-500 font-mono tracking-widest block font-bold mt-1">
                    <?= strtoupper(date('d M Y', strtotime($history['completed_at']))) ?>
                  </span>
                </td>

                <td class="p-6 text-center align-middle bg-white">
                  <div class="flex justify-center">
                    <span class="inline-block border-2 border-black px-4 py-2 bg-[#E5E7EB] text-gray-500 text-[10px] font-black shadow-[3px_3px_0_0_#000] tracking-widest">
                      DELIVERED ✓
                    </span>
                  </div>
                </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="bg-white p-5 text-[10px] font-black text-gray-500 tracking-widest uppercase border-t-0">
      ARCHIVE CONTAINS <?= str_pad((string)$totalHistory, 2, '0', STR_PAD_LEFT) ?> RECORDED ENTRIES
    </div>

  </div>
</div>