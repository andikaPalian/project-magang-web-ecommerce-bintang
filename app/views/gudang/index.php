<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest">

  <div class="mb-8" data-aos="fade-in">
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-1">DASHBOARD</h1>
    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">
      Logged in as: <span class="text-[#2563EB]"><?= $_SESSION['role'] ?? 'ROOT' ?></span>
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between hover:-translate-y-1 transition-all">
      <div class="flex justify-between items-start mb-6">
        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <span class="text-[9px] font-black bg-black text-white px-2 py-1">LIVE DATA</span>
      </div>
      <div>
        <div class="text-6xl font-black tracking-tighter text-black mb-2"><?= str_pad((string)$data['packing_due'], 2, '0', STR_PAD_LEFT) ?></div>
        <p class="text-xs font-black border-t-2 border-black pt-2">TOTAL PACKING</p>
      </div>
    </div>

    <div class="bg-[#2563EB] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between hover:-translate-y-1 transition-all text-white">
      <div class="flex justify-between items-start mb-6">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
        </svg>
        <span class="text-[9px] font-black bg-white text-black px-2 py-1">QUEUED</span>
      </div>
      <div>
        <div class="text-6xl font-black tracking-tighter text-white mb-2"><?= str_pad((string)$data['ready_pickup'], 2, '0', STR_PAD_LEFT) ?></div>
        <p class="text-xs font-black border-t-2 border-white pt-2 text-blue-200">READY FOR PICKUP</p>
      </div>
    </div>

    <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col justify-between hover:-translate-y-1 transition-all text-white">
      <div class="flex justify-between items-start mb-6">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <span class="text-[9px] font-black bg-black text-white px-2 py-1">URGENT</span>
      </div>
      <div>
        <div class="text-6xl font-black tracking-tighter text-white mb-2"><?= str_pad((string)$data['low_stock'], 2, '0', STR_PAD_LEFT) ?></div>
        <p class="text-xs font-black border-t-2 border-black pt-2 text-red-200">LOW STOCK PRODUCTS</p>
      </div>
    </div>

  </div>

  <div class="w-full" data-aos="fade-up" data-aos-delay="100">

    <div class="w-full bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col">
      <div class="bg-black text-white p-3 flex justify-between items-center border-b-4 border-black">
        <div class="flex items-center text-xs font-black">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          RECENT ACTIVITY
        </div>
        <div class="flex space-x-1">
          <div class="w-3 h-3 bg-[#FF5757] border-2 border-black"></div>
          <div class="w-3 h-3 bg-[#FFE600] border-2 border-black"></div>
          <div class="w-3 h-3 bg-[#A6FAAE] border-2 border-black"></div>
        </div>
      </div>

      <div class="overflow-x-auto flex-1 p-0">
        <table class="w-full text-left text-xs border-collapse">
          <thead class="bg-gray-100 border-b-4 border-black font-black text-[10px] text-gray-500">
            <tr>
              <th class="p-4 border-r-2 border-black w-32">TIMESTAMP</th>
              <th class="p-4 border-r-2 border-black w-48">EVENT TYPE</th>
              <th class="p-4 border-r-2 border-black">ACTION DETAILS</th>
              <th class="p-4 text-center w-32">STATUS</th>
            </tr>
          </thead>
          <tbody class="font-bold">
            <?php if (empty($data['recent_activities'])): ?>
              <tr>
                <td colspan="4" class="p-8 text-center text-[#FF5757] font-black uppercase tracking-widest">AWAITING SYSTEM LOGS...</td>
              </tr>
            <?php else: ?>
              <?php foreach ($data['recent_activities'] as $log): ?>
                <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                  <td class="p-4 border-r-2 border-black font-mono"><?= date('H:i:s', strtotime($log['created_at'])) ?></td>
                  <td class="p-4 border-r-2 border-black text-[#2563EB]">ORDER_UPDATE</td>
                  <td class="p-4 border-r-2 border-black">INV_<?= explode('-', $log['invoice_number'])[2] ?? $log['invoice_number'] ?> MOVED TO [<?= strtoupper($log['order_status']) ?>]</td>
                  <td class="p-4 text-center">
                    <span class="bg-[#A6FAAE] border-2 border-black px-2 py-1 text-[9px] font-black shadow-[2px_2px_0_0_#000]">SUCCESS</span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="border-t-4 border-black p-3 flex justify-between items-center text-[9px] font-black bg-gray-50">
        <span class="text-gray-500">SHOWING LASTEST ACTIVITIES</span>
        <button onclick="alert('Fitur Full System Logs akan dikembangkan di modul selanjutnya!')" class="bg-black text-white border-2 border-black px-4 py-2 uppercase tracking-widest shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 transition-all">
          VIEW ALL LOGS
        </button>
      </div>

    </div>
  </div>

</div>