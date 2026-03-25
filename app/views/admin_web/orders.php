<div class="mb-6" data-aos="fade-in">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">ORDER MANAGEMENT</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola transaksi masuk, verifikasi pembayaran, dan pantau status logistik pengiriman.
      </p>
    </div>

    <div class="flex gap-4">
      <a href="<?= BASEURL; ?>/adminorder/exportCsv" class="bg-white text-black px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        EXPORT CSV
      </a>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['flash_success'])): ?>
  <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>
    <p><?= $_SESSION['flash_success'];
        unset($_SESSION['flash_success']); ?></p>
  </div>
<?php endif; ?>
<?php if (isset($_SESSION['flash_error'])): ?>
  <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
    </svg>
    <p><?= $_SESSION['flash_error'];
        unset($_SESSION['flash_error']); ?></p>
  </div>
<?php endif; ?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000] transition-all">
    <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-2 border-b-2 border-black pb-2">TOTAL ORDERS</p>
    <div class="flex justify-between items-end">
      <p class="text-4xl font-black tracking-tighter"><?= number_format($data['stats']['total_orders'], 0, ',', '.') ?></p>
      <span class="text-[10px] font-black text-black bg-[#A6FAAE] px-2 py-0.5 border-2 border-black shadow-[2px_2px_0_0_#000]">+ALL</span>
    </div>
  </div>

  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000] transition-all">
    <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-2 border-b-2 border-black pb-2">PENDING FULFILLMENT</p>
    <div class="flex justify-between items-end">
      <p class="text-4xl font-black tracking-tighter text-[#FF5757]"><?= number_format($data['stats']['pending_fulfillment'], 0, ',', '.') ?></p>
      <span class="text-[10px] font-black text-white bg-[#FF5757] px-2 py-0.5 border-2 border-black shadow-[2px_2px_0_0_#000]">URGENT</span>
    </div>
  </div>

  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000] transition-all">
    <p class="text-xs font-black text-gray-500 uppercase tracking-widest mb-2 border-b-2 border-black pb-2">SHIPPED & DONE</p>
    <div class="flex justify-between items-end">
      <p class="text-4xl font-black tracking-tighter"><?= number_format($data['stats']['shipped_total'], 0, ',', '.') ?></p>
      <span class="text-[10px] font-black text-black bg-[#FFE600] px-2 py-0.5 border-2 border-black shadow-[2px_2px_0_0_#000]">OPTIMAL</span>
    </div>
  </div>

  <div class="bg-[#2563EB] text-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000] transition-all relative overflow-hidden">
    <div class="absolute -right-4 -top-4 w-16 h-16 bg-white opacity-20 rounded-full"></div>
    <p class="text-xs font-black text-blue-200 uppercase tracking-widest mb-2 border-b-2 border-black pb-2">TOTAL REVENUE</p>
    <p class="text-3xl font-black tracking-tighter truncate">Rp <?= number_format($data['stats']['total_revenue'], 0, ',', '.') ?></p>
  </div>
</div>

<div class="flex flex-col md:flex-row gap-4 mb-6 relative z-20" data-aos="fade-up" data-aos-delay="100">
  <div class="flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
    <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    <input type="text" id="searchInput" placeholder="SEARCH INVOICE OR CUSTOMER..." class="w-full py-4 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
  </div>

  <div class="w-full md:w-48 relative" id="filterStatusDropdown">
    <input type="hidden" id="statusFilter" value="ALL">
    <button type="button" onclick="toggleFilterStatus()" class="w-full py-4 px-4 bg-white border-4 border-black font-black text-xs uppercase flex justify-between items-center shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all cursor-pointer">
      <span id="filterStatusText">STATUS ALL</span>
      <svg class="w-4 h-4 text-black transition-transform" id="filterStatusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <div id="filterStatusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col">
      <div onclick="selectFilterStatus('ALL', 'STATUS: ALL')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">STATUS ALL</div>
      <div onclick="selectFilterStatus('PENDING', 'PENDING')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PENDING</div>
      <div onclick="selectFilterStatus('PROCESSING', 'PROCESSING')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PROCESSING</div>
      <div onclick="selectFilterStatus('SHIPPED', 'SHIPPED')" class="p-3 font-black text-xs uppercase hover:bg-[#FFE600] cursor-pointer">SHIPPED</div>
    </div>
  </div>

  <button onclick="window.location.reload()" class="bg-black text-white px-6 py-4 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
    REFRESH
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-8 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest border-b-4 border-black">
        <th class="p-5 border-r-2 border-black">INVOICE</th>
        <th class="p-5 border-r-2 border-black">CUSTOMER</th>
        <th class="p-5 border-r-2 border-black">GRAND TOTAL</th>
        <th class="p-5 border-r-2 border-black text-center">PAYMENT</th>
        <th class="p-5 border-r-2 border-black text-center">STATUS</th>
        <th class="p-5 border-r-2 border-black">DATE</th>
        <th class="p-5 text-center w-32">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black" id="tableBody">

      <?php if (empty($data['orders'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="7" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">ORDER NOT FOUND</td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['orders'] as $o): ?>
          <tr class="border-b-2 border-black hover:bg-[#F8F9FA] transition-colors voucher-row">
            <td class="p-5 border-r-2 border-black">
              <span class="font-black text-base text-[#2563EB] uppercase tracking-wider voucher-code-text">
                INV-<?= explode('-', $o['invoice_number'])[2] ?? $o['invoice_number'] ?>
              </span>
            </td>

            <td class="p-5 border-r-2 border-black truncate max-w-[150px]">
              <span class="font-black text-xs uppercase"><?= htmlspecialchars($o['customer_name'] ?? $o['recipient_name']) ?></span>
            </td>

            <td class="p-5 border-r-2 border-black">
              <span class="font-black text-base">Rp <?= number_format((float)$o['grand_total'], 0, ',', '.') ?></span>
            </td>

            <td class="p-5 border-r-2 border-black text-center">
              <?php if ($o['payment_status'] === 'pending' && !empty($o['payment_proof'])): ?>
                <span class="inline-block border-2 border-black px-2 py-1 bg-[#FFE600] text-black text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000] animate-pulse">CHECK</span>
              <?php elseif ($o['payment_status'] === 'paid'): ?>
                <span class="inline-block border-2 border-black px-2 py-1 bg-[#A6FAAE] text-black text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">PAID</span>
              <?php elseif ($o['payment_status'] === 'failed'): ?>
                <span class="inline-block border-2 border-black px-2 py-1 bg-[#FF5757] text-white text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">FAILED</span>
              <?php else: ?>
                <span class="inline-block border-2 border-black px-2 py-1 bg-gray-200 text-black text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">PENDING</span>
              <?php endif; ?>
            </td>

            <td class="p-5 border-r-2 border-black text-center voucher-status-text">
              <?php
              $fst_color = 'bg-[#F8F9FA] text-black';
              if ($o['order_status'] === 'pending' || $o['order_status'] === 'processing') {
                $fst_color = 'bg-[#FFE600] text-black';
              }
              if ($o['order_status'] === 'shipped' || $o['order_status'] === 'delivered') {
                $fst_color = 'bg-[#A6FAAE] text-black';
              }
              if ($o['order_status'] === 'cancelled') {
                $fst_color = 'bg-[#FF5757] text-white';
              }
              ?>
              <span class="inline-block border-2 border-black px-2 py-1 <?= $fst_color ?> text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">
                <?= $o['order_status'] ?>
              </span>
            </td>

            <td class="p-5 border-r-2 border-black">
              <span class="font-mono text-xs text-gray-600"><?= date('Y-m-d', strtotime($o['created_at'])) ?></span>
            </td>

            <td class="p-4">
              <div class="flex items-center justify-center space-x-2">
                <button onclick='openProofModal(<?= json_encode($o) ?>)' class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] shadow-[2px_2px_0_0_#000] transition-all" title="Verify Payment">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </button>
                <?php if ($o['payment_status'] === 'paid'): ?>
                  <button onclick='openStatusModal(<?= $o['id'] ?>, "<?= $o['order_status'] ?>")' class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#2563EB] hover:text-white shadow-[2px_2px_0_0_#000] transition-all" title="Update Status">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                  </button>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="7" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">SYSTEM ERROR: DATA_NOT_FOUND.</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper">
  <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">PAGE_001_OF_001</div>
  <div class="flex items-center gap-2 text-black" id="paginationControls">
    <button class="w-8 h-8 flex items-center justify-center border-4 border-black bg-[#F8F9FA] text-black font-black hover:-translate-y-1 shadow-[2px_2px_0_0_#000] transition-all">&lt;</button>
    <button class="w-8 h-8 flex items-center justify-center border-4 border-black bg-black text-white font-black hover:-translate-y-1 shadow-[2px_2px_0_0_#000] transition-all">1</button>
    <button class="w-8 h-8 flex items-center justify-center border-4 border-black bg-[#F8F9FA] text-black font-black hover:-translate-y-1 shadow-[2px_2px_0_0_#000] transition-all">&gt;</button>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10" data-aos="fade-up" data-aos-delay="300">
  <div class="bg-[#2563EB] border-4 border-black shadow-[8px_8px_0_0_#000] p-8 text-white relative overflow-hidden">
    <h3 class="text-2xl font-black uppercase tracking-tight mb-2">BATCH OPERATIONS.EXE</h3>
    <p class="text-xs font-bold mb-6 max-w-sm">Jalankan aksi massal pada pesanan yang dipilih untuk mempercepat pemrosesan gudang.</p>
    <div class="flex gap-4 relative z-10">
      <button class="bg-white text-black px-4 py-2 border-2 border-black font-black text-[10px] uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">GENERATE LABELS</button>
      <button class="bg-black text-white px-4 py-2 border-2 border-white font-black text-[10px] uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">MARK SHIPPED</button>
    </div>
    <svg class="absolute -right-10 -bottom-10 w-48 h-48 text-blue-800 opacity-50" fill="currentColor" viewBox="0 0 20 20">
      <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
      <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
    </svg>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-8">
    <div class="flex items-center mb-4">
      <div class="bg-[#FFE600] border-2 border-black p-2 mr-3 shadow-[2px_2px_0_0_#000]">
        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>
      <h3 class="text-xl font-black uppercase tracking-tight">SYSTEM ALERTS</h3>
    </div>
    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AUTO_NOTIFICATIONS:</p>
    <ul class="text-xs font-bold text-black leading-relaxed space-y-2 mt-3">
      <li class="flex items-center"><span class="w-2 h-2 bg-[#FF5757] rounded-full mr-2"></span> Ada 3 Pesanan Menunggu Verifikasi</li>
      <li class="flex items-center"><span class="w-2 h-2 bg-[#A6FAAE] rounded-full mr-2"></span> Sinkronisasi Resi Ekspedisi Delay 2 Menit</li>
    </ul>
  </div>
</div>

<div id="proofModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
      <h2 class="text-2xl font-black uppercase tracking-widest">VERIFY PAYMENT</h2>
      <button onclick="closeModal('proofModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <p class="text-[10px] font-black uppercase tracking-widest mb-2 text-gray-500" id="proof_invoice_label"></p>
      <div class="bg-[#F8F9FA] border-4 border-black p-2 mb-6">
        <img id="proofImage" src="" class="max-h-64 mx-auto object-contain w-full">
      </div>

      <form action="<?= BASEURL; ?>/adminorder/verifyPayment" method="POST">
        <input type="hidden" name="order_id" id="verify_order_id">
        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="submit" name="action" value="reject" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] hover:bg-[#FF5757] hover:text-white transition-all">REJECT</button>
          <button type="submit" name="action" value="approve" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">APPROVE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="statusModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <h2 class="text-2xl font-black uppercase tracking-widest">UPDATE STATUS</h2>
      <button onclick="closeModal('statusModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form action="<?= BASEURL; ?>/adminorder/updateOrderStatus" method="POST" class="space-y-4">
        <input type="hidden" name="order_id" id="status_order_id">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">SELECT NEW STATUS</label>
          <select name="new_status" id="status_select" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black uppercase text-black focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
            <option value="pending">PENDING</option>
            <option value="processing">PROCESSING (DIKEMAS)</option>
            <option value="ready_for_pickup">READY FOR PICKUP</option>
            <option value="shipped">SHIPPED (DIKIRIM)</option>
            <option value="delivered">DELIVERED (SELESAI)</option>
          </select>
        </div>

        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="button" onclick="closeModal('statusModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const BASEURL = '<?= BASEURL; ?>';

  function toggleFilterStatus() {
    const menu = document.getElementById('filterStatusMenu');
    const icon = document.getElementById('filterStatusIcon');
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
    icon.classList.toggle('rotate-180');
  }

  function selectFilterStatus(value, text) {
    document.getElementById('statusFilter').value = value;
    document.getElementById('filterStatusText').innerText = text;
    toggleFilterStatus();
  }

  function openProofModal(order) {
    document.getElementById('verify_order_id').value = order.id;
    document.getElementById('proof_invoice_label').textContent = 'INVOICE: INV-' + (order.invoice_number.split('-')[2] || order.invoice_number);

    if (order.payment_proof) {
      const imgPath = order.payment_proof.startsWith('http') ? order.payment_proof : BASEURL + '/img/proofs/' + order.payment_proof;
      document.getElementById('proofImage').src = imgPath;
      document.getElementById('proofImage').parentElement.classList.remove('hidden');
    } else {
      document.getElementById('proofImage').parentElement.classList.add('hidden');
    }

    const modal = document.getElementById('proofModal');
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }

  function openStatusModal(orderId, currentStatus) {
    document.getElementById('status_order_id').value = orderId;
    document.getElementById('status_select').value = currentStatus;

    const modal = document.getElementById('statusModal');
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }

  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  }
</script>