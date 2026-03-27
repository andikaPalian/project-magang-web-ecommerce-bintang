<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-6" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">PICKUP</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola antrian pengambilan barang.
      </p>
    </div>
  </div>

  <?php
  $totalPickups = count($data['pickups']);
  $queueStatus = $totalPickups > 10 ? 'HIGH VOLUME DETECTED' : 'NORMAL OPERATIONS';
  $bgColor = $totalPickups > 10 ? 'bg-[#2563EB]' : 'bg-[#A6FAAE]';
  $textColor = $totalPickups > 10 ? 'text-white' : 'text-black';
  ?>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
    <div class="<?= $bgColor ?> <?= $textColor ?> border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between relative">
      <h3 class="text-[10px] font-black tracking-widest mb-2 opacity-80">QUEUE STATUS</h3>
      <div class="flex justify-between items-center">
        <span class="text-xl font-black leading-tight"><?= $queueStatus ?></span>
        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
        </svg>
      </div>
    </div>
    <div class="bg-[#4ADE80] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between">
      <h3 class="text-[10px] font-black tracking-widest text-black mb-2">NEXT PICKUP WINDOW</h3>
      <span class="text-3xl font-black text-black">SEKARANG</span>
    </div>
    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between">
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2 border-b-2 border-black pb-2">TOTAL PACKAGES AVAILABLE</h3>
      <div class="flex items-end gap-2">
        <span class="text-5xl font-black text-[#2563EB] leading-none"><?= str_pad((string)$totalPickups, 2, '0', STR_PAD_LEFT) ?></span>
        <span class="text-sm font-black mb-1">UNITS</span>
      </div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">

    <div class="bg-black text-white font-black text-sm tracking-widest p-5">
      LIST PICKUPS IN QUEUE
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-[#F8F9FA] font-black text-[10px] text-gray-500">
          <tr class="border-b-4 border-black">
            <th class="p-6 border-r-2 border-black w-48 tracking-widest">ORDER ID</th>
            <th class="p-6 border-r-2 border-black tracking-widest">CUSTOMER</th>
            <th class="p-6 border-r-2 border-black w-32 text-center tracking-widest">ITEMS COUNT</th>
            <th class="p-6 border-r-2 border-black w-48 text-center tracking-widest">STATUS</th>
            <th class="p-6 text-center w-[300px] tracking-widest">ACTION</th>
          </tr>
        </thead>
        <tbody class="font-bold text-black">
          <?php if (empty($data['pickups'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black bg-white uppercase text-sm border-b-4 border-black">
                NO PACKAGES AVAILABLE IN QUEUE.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['pickups'] as $pickup): ?>
              <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors">

                <td class="p-6 border-r-2 border-black align-middle">
                  <span class="font-black text-xl block mb-2 tracking-wide">
                    #<?= explode('-', $pickup['invoice_number'])[2] ?? $pickup['invoice_number'] ?>
                  </span>
                  <span class="text-[9px] text-gray-500 font-mono tracking-widest block font-bold">
                    <?= strtoupper(date('H:i // d-M-Y', strtotime($pickup['created_at']))) ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black align-middle">
                  <span class="font-black text-sm block mb-2 tracking-widest">
                    <?= htmlspecialchars($pickup['recipient_name'] ?: $pickup['customer_name']) ?>
                  </span>
                  <span class="text-[10px] text-[#2563EB] font-black tracking-widest block uppercase">
                    <?= htmlspecialchars($pickup['shipping_method'] ?: 'STANDARD DELIVERY') ?>
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black text-center align-middle">
                  <span class="text-4xl font-black tracking-tighter text-black">
                    01
                  </span>
                </td>

                <td class="p-6 border-r-2 border-black text-center align-middle">
                  <div class="flex justify-center">
                    <span class="inline-block border-2 border-black px-4 py-2 bg-[#FFE600] text-black text-[10px] font-black shadow-[4px_4px_0_0_#000] tracking-widest">
                      READY_FOR_PICKUP
                    </span>
                  </div>
                </td>

                <td class="p-6 text-center align-middle bg-white">
                  <div class="flex justify-center items-center gap-3">

                    <!-- <button type="button" class="flex-1 bg-white text-black border-2 border-black py-3 shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all text-[9px] font-black flex justify-center items-center tracking-widest">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                      </svg>
                      VIEW DETAIL
                    </button> -->

                    <form action="<?= BASEURL; ?>/ekspedisi/take/<?= $pickup['id'] ?>" method="POST" class="m-0 flex-1">
                      <button type="submit" class="w-full bg-[#2563EB] text-white border-2 border-black py-3 shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[5px_5px_0_0_#000] transition-all text-[9px] font-black flex justify-center items-center tracking-widest">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        CLAIM PACKAGE
                      </button>
                    </form>

                  </div>
                </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="bg-white p-5 text-[10px] font-black text-gray-500 tracking-widest uppercase">
      SHOWING <?= $totalPickups ?> PENDING ORDERS IN QUEUE
    </div>

  </div>
</div>