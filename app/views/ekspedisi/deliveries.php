<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-6" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">DELIVERIES</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola pengiriman barang.
      </p>
    </div>
  </div>

  <?php $totalActive = count($data['deliveries']); ?>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-center relative">
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2 border-b-2 border-black pb-2">BARANG YANG AKAN DIKIRIM</h3>
      <div class="flex items-end gap-2">
        <span class="text-5xl font-black text-[#2563EB] leading-none"><?= str_pad((string)$totalActive, 2, '0', STR_PAD_LEFT) ?></span>
        <span class="text-sm font-black mb-1">UNITS</span>
      </div>
    </div>

    <div class="lg:col-span-2 bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex items-start gap-4">
      <div class="bg-black text-[#FFE600] w-14 h-14 flex items-center justify-center font-black text-3xl shrink-0 border-4 border-black shadow-[4px_4px_0_0_#fff]">!</div>
      <div class="pt-1">
        <h3 class="text-xl font-black tracking-tight mb-1 text-black">PERHATIAN</h3>
        <p class="text-[10px] font-bold leading-relaxed text-black tracking-widest">
          PASTIKAN PAKET DISERAHKAN LANGSUNG KEPADA PENERIMA YANG SAH DI ALAMAT TUJUAN. KLIK TOMBOL <span class="bg-black text-white px-2 py-0.5">MARK AS DELIVERED</span> HANYA SETELAH BARANG FISIK BERPINDAH TANGAN UNTUK MENGHINDARI SENGKETA LOGISTIK.
        </p>
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">

    <div class="bg-black text-white font-black text-sm tracking-widest p-5 flex justify-between items-center">
      <span>LIST BARANG YANG AKAN DIKIRIM</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-[#F8F9FA] font-black text-[10px] text-gray-500">
          <tr class="border-b-4 border-black">
            <th class="p-6 border-r-2 border-black w-56 tracking-widest">TRACKING ID</th>
            <th class="p-6 border-r-2 border-black w-56 tracking-widest">RECIPIENT INFO</th>
            <th class="p-6 border-r-2 border-black tracking-widest">DESTINATION ADDRESS</th>
            <th class="p-6 border-r-2 border-black w-40 text-center tracking-widest">STATUS</th>
            <th class="p-6 text-center w-64 tracking-widest">ACTION</th>
          </tr>
        </thead>
        <tbody class="font-bold text-black">
          <?php if (empty($data['deliveries'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black bg-white uppercase text-sm border-b-4 border-black">
                VEHICLE EMPTY. NO ACTIVE DELIVERIES.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['deliveries'] as $delivery): ?>
              <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors">

                <td class="p-6 border-r-2 border-black align-top">
                  <span class="font-black text-lg block mb-2 tracking-wide text-[#2563EB]">
                    <?= htmlspecialchars($delivery['tracking_number']) ?>
                  </span>
                  <span class="text-[9px] text-gray-500 font-mono tracking-widest block font-bold">
                    INV: #<?= explode('-', $delivery['invoice_number'])[2] ?? $delivery['invoice_number'] ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black align-top">
                  <span class="font-black text-sm block mb-2 tracking-widest">
                    <?= htmlspecialchars($delivery['recipient_name']) ?>
                  </span>
                  <span class="text-[10px] bg-black text-white px-2 py-1 font-mono tracking-widest inline-block">
                    TEL: <?= htmlspecialchars($delivery['recipient_phone']) ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black align-top">
                  <span class="text-[10px] leading-relaxed block tracking-widest font-bold">
                    <?= htmlspecialchars($delivery['shipping_address']) ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black text-center align-middle">
                  <div class="flex justify-center">
                    <span class="inline-block border-2 border-black px-4 py-2 bg-black text-[#FFE600] text-[10px] font-black shadow-[4px_4px_0_0_#FFE600] tracking-widest">
                      ON_DELIVERY
                    </span>
                  </div>
                </td>

                <td class="p-6 text-center align-middle bg-white">
                  <form action="<?= BASEURL; ?>/ekspedisi/markDelivered/<?= $delivery['order_id'] ?>" method="POST" class="m-0">
                    <button type="submit" class="w-full bg-[#4ADE80] text-black border-4 border-black py-4 shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all text-[10px] font-black flex justify-center items-center tracking-widest">
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                      </svg>
                      MARK AS DELIVERED
                    </button>
                  </form>
                </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="bg-white p-5 text-[10px] font-black text-gray-500 tracking-widest uppercase">
      SHOWING <?= str_pad((string)$totalActive, 2, '0', STR_PAD_LEFT) ?> ACTIVE DELIVERIES IN VEHICLE
    </div>

  </div>
</div>