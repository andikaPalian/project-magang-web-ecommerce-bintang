<?php
// MENGHITUNG METRIK DATA MASTER
$total_accounts = count($data['accounts'] ?? []);
$total_inventory = count($data['stocks'] ?? []);
$low_stock_items = 0;
$out_of_stock_items = 0;

if ($total_inventory > 0) {
  foreach ($data['stocks'] as $stock) {
    $qty = (int)$stock['stock_quantity'];
    if ($qty === 0) {
      $out_of_stock_items++;
    } elseif ($qty < 15) {
      $low_stock_items++;
    }
  }
}
?>

<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8" data-aos="fade-down">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-1">MASTER DATA</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Tinjau data master inventaris dan akun pengguna. Pantau jumlah total akun, item inventaris, serta peringatan stok rendah dan habis untuk pengelolaan yang lebih efektif.
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">TOTAL ACCOUNTS</h3>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-2"><?= number_format($total_accounts, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-gray-500">REGISTERED USERS</span>
      </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">TOTAL INVEBTORY</h3>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-2"><?= number_format($total_inventory, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-gray-500">TRACKED HARDWARE</span>
      </div>
    </div>

    <div class="bg-[#FFE600] border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-black mb-2">LOW STOCK PRODUCTS</h3>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-2"><?= number_format($low_stock_items, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-black">UNITS &lt; 15</span>
      </div>
    </div>

    <div class="bg-[#FF5757] border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between text-white">
      <h3 class="text-[9px] font-black tracking-widest text-red-200 mb-2">OUT OF STOCK PRODUCTS</h3>
      <div>
        <span class="text-4xl font-black text-white leading-none block mb-2"><?= number_format($out_of_stock_items, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-white">ACTION REQUIRED</span>
      </div>
    </div>

  </div>

  <div class="flex flex-col gap-10" data-aos="fade-up" data-aos-delay="100">

    <div class="w-full flex flex-col gap-4">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10 overflow-hidden">

        <div class="bg-black text-white font-black text-[10px] tracking-widest p-4 flex justify-between items-center">
          <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span>INVENTORY DATA</span>
          </div>
        </div>

        <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
          <table class="w-full text-left text-xs border-collapse min-w-[800px] relative">
            <thead class="bg-white font-black text-[9px] text-black border-b-4 border-black sticky top-0 z-20">
              <tr>
                <th class="p-4 border-r-2 border-black tracking-widest w-32">PRODUCT ID</th>
                <th class="p-4 border-r-2 border-black tracking-widest">PRODUCT NAME</th>
                <th class="p-4 border-r-2 border-black tracking-widest w-48">STORAGE LOCATION</th>
                <th class="p-4 border-r-2 border-black text-center tracking-widest w-32">QUANTITY</th>
                <th class="p-4 text-center tracking-widest w-32">STATUS</th>
              </tr>
            </thead>
            <tbody class="font-bold text-black text-[10px]">
              <?php if (empty($data['stocks'])): ?>
                <tr>
                  <td colspan="5" class="p-10 text-center font-black">NO INVENTORY DATA DETECTED.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($data['stocks'] as $index => $stock): ?>
                  <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                    <td class="p-4 border-r-2 border-black font-mono">#PRD-<?= str_pad((string)($index + 1), 3, '0', STR_PAD_LEFT) ?></td>
                    <td class="p-4 border-r-2 border-black"><?= htmlspecialchars($stock['product_name']) ?></td>
                    <td class="p-4 border-r-2 border-black font-mono text-[9px]"><?= strtoupper(htmlspecialchars($stock['location_name'])) ?></td>
                    <td class="p-4 border-r-2 border-black text-center text-sm font-black"><?= number_format((float)$stock['stock_quantity'], 0, ',', '.') ?></td>
                    <td class="p-4 text-center">
                      <?php
                      $qty = (int)$stock['stock_quantity'];
                      if ($qty === 0): ?>
                        <span class="bg-[#FF5757] text-white border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">EMPTY</span>
                      <?php elseif ($qty < 15): ?>
                        <span class="bg-[#FFE600] text-black border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">LOW_STOCK</span>
                      <?php else: ?>
                        <span class="bg-[#4ADE80] text-black border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">OPTIMAL</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="w-full flex flex-col gap-4">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10 overflow-hidden">

        <div class="bg-black text-white font-black text-[10px] tracking-widest p-4 flex justify-between items-center">
          <div class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>USERS DATA</span>
          </div>
        </div>

        <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
          <table class="w-full text-left text-xs border-collapse min-w-[800px] relative">
            <thead class="bg-white font-black text-[9px] text-black border-b-4 border-black sticky top-0 z-20">
              <tr>
                <th class="p-4 border-r-2 border-black tracking-widest w-24">USER ID</th>
                <th class="p-4 border-r-2 border-black tracking-widest">USERNAME</th>
                <th class="p-4 border-r-2 border-black tracking-widest">EMAIL</th>
                <th class="p-4 border-r-2 border-black text-center tracking-widest w-40">ROLE</th>
                <th class="p-4 text-center tracking-widest w-32">REGISTRATION DATE</th>
              </tr>
            </thead>
            <tbody class="font-bold text-black text-[10px]">
              <?php if (empty($data['accounts'])): ?>
                <tr>
                  <td colspan="5" class="p-10 text-center font-black">NO ACCOUNT DATA DETECTED.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($data['accounts'] as $acc): ?>
                  <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                    <td class="p-4 border-r-2 border-black font-mono">#USR-<?= str_pad((string)$acc['id'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td class="p-4 border-r-2 border-black"><?= htmlspecialchars($acc['name']) ?></td>
                    <td class="p-4 border-r-2 border-black font-mono text-[9px] text-gray-600"><?= htmlspecialchars($acc['email']) ?></td>
                    <td class="p-4 border-r-2 border-black text-center">
                      <?php
                      $role = $acc['role'];
                      $bg = 'bg-gray-200';
                      $text = 'text-black';

                      if ($role === 'pemilik' || $role === 'admin_web' || $role === 'admin_toko') {
                        $bg = 'bg-[#2563EB]';
                        $text = 'text-white';
                      } elseif ($role === 'ekspedisi' || $role === 'gudang') {
                        $bg = 'bg-[#FFE600]';
                        $text = 'text-black';
                      } else {
                        $bg = 'bg-white';
                        $text = 'text-black';
                      }
                      ?>
                      <span class="<?= $bg ?> <?= $text ?> border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000] text-[9px]">
                        <?= strtoupper($role) ?>
                      </span>
                    </td>
                    <td class="p-4 text-center font-mono text-[9px] text-gray-500">
                      <?= date('Y-m-d', strtotime($acc['created_at'])) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

</div>