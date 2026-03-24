<div class="mb-6" data-aos="fade-in">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">VOUCHER MANAGEMENT</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola voucher diskon, kode unik, dan penggunaan voucher
      </p>
    </div>

    <div class="flex gap-4">
      <button onclick="openModal('addVoucherModal')" class="bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        + ADD VOUCHER
      </button>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative">
    <div class="w-8 h-8 bg-[#2563EB] rounded-full mb-4 flex items-center justify-center border-2 border-black">
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
      </svg>
    </div>
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">TOTAL VOUCHERS</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['total_vouchers'], 2, '0', STR_PAD_LEFT) ?></div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative">
    <div class="w-8 h-8 bg-[#A6FAAE] rounded-full mb-4 flex items-center justify-center border-2 border-black">
      <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
      </svg>
    </div>
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">ACTIVE VOUCHERS</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['active_vouchers'], 2, '0', STR_PAD_LEFT) ?></div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative">
    <div class="w-8 h-8 bg-[#FF5757] rounded-full mb-4 flex items-center justify-center border-2 border-black">
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </div>
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">EXPIRED VOUCHERS</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['expired_vouchers'], 2, '0', STR_PAD_LEFT) ?></div>
  </div>
</div>

<div class="flex flex-col md:flex-row gap-4 mb-6 relative z-20" data-aos="fade-up" data-aos-delay="100">
  <div class="flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
    <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH VOUCHER CODE..." class="w-full py-4 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
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
      <div onclick="selectFilterStatus('ACTIVE', 'ACTIVE')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">ACTIVE</div>
      <div onclick="selectFilterStatus('PENDING', 'PENDING')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PENDING</div>
      <div onclick="selectFilterStatus('EXPIRED', 'EXPIRED')" class="p-3 font-black text-xs uppercase hover:bg-[#FFE600] cursor-pointer">EXPIRED</div>
    </div>
  </div>

  <button onclick="reloadPage()" class="bg-black text-white px-6 py-4 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
    REFRESH
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-8 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest border-b-4 border-black">
        <th class="p-5 border-r-2 border-black">CODE</th>
        <th class="p-5 border-r-2 border-black">TYPE</th>
        <th class="p-5 border-r-2 border-black">VALUE</th>
        <th class="p-5 border-r-2 border-black">MIN SPEND</th>
        <th class="p-5 border-r-2 border-black">EXPIRY DATE</th>
        <th class="p-5 border-r-2 border-black text-center">STATUS</th>
        <th class="p-5 text-center w-32">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black" id="tableBody">

      <?php if (empty($data['vouchers'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="7" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">VOUCHER NOT FOUND</td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['vouchers'] as $v):

          $calcStatus = $v['calculated_status'];
          $statusColor = 'bg-[#F8F9FA] text-black';
          if ($calcStatus === 'ACTIVE') $statusColor = 'bg-[#A6FAAE] text-black';
          if ($calcStatus === 'PENDING') $statusColor = 'bg-[#FFE600] text-black';
          if ($calcStatus === 'EXPIRED') $statusColor = 'bg-[#FF5757] text-white';

          $valDisplay = $v['discount_type'] === 'percent' ? rtrim(rtrim($v['discount_amount'], '0'), '.') . '%' : 'Rp ' . number_format((float)$v['discount_amount'], 0, ',', '.');
          $minSpend = $v['min_purchase'] > 0 ? 'Rp ' . number_format((float)$v['min_purchase'], 0, ',', '.') : 'Rp 0';
        ?>
          <tr class="border-b-2 border-black hover:bg-[#F8F9FA] transition-colors voucher-row">
            <td class="p-5 border-r-2 border-black">
              <span class="font-black text-base text-[#2563EB] uppercase tracking-wider voucher-code-text"><?= htmlspecialchars($v['code']) ?></span>
            </td>
            <td class="p-5 border-r-2 border-black">
              <span class="font-black text-xs uppercase"><?= $v['discount_type'] === 'percent' ? 'PERCENTAGE' : 'FIXED' ?></span>
            </td>
            <td class="p-5 border-r-2 border-black">
              <span class="font-black text-base"><?= $valDisplay ?></span>
            </td>
            <td class="p-5 border-r-2 border-black">
              <span class="font-mono text-xs"><?= $minSpend ?></span>
            </td>
            <td class="p-5 border-r-2 border-black">
              <span class="font-mono text-xs text-gray-600"><?= $v['valid_until'] ?></span>
            </td>
            <td class="p-5 border-r-2 border-black text-center voucher-status-text">
              <span class="inline-block border-2 border-black px-2 py-1 <?= $statusColor ?> text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">
                <?= $calcStatus ?>
              </span>
            </td>
            <td class="p-4">
              <div class="flex items-center justify-center space-x-2">
                <button data-voucher='<?= htmlspecialchars(json_encode($v, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), ENT_QUOTES, 'UTF-8') ?>' onclick="openEditModal(this)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                  </svg>
                </button>
                <button onclick="deleteVoucher(<?= $v['id']; ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
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
  <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">PAGE_000_OF_000</div>
  <div class="flex items-center gap-2 text-black" id="paginationControls"></div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10" data-aos="fade-up" data-aos-delay="300">
  <div class="bg-[#2563EB] border-4 border-black shadow-[8px_8px_0_0_#000] p-8 text-white relative overflow-hidden">
    <h3 class="text-2xl font-black uppercase tracking-tight mb-2">QUICK_EXPORT.SYS</h3>
    <p class="text-xs font-bold mb-6 max-w-sm">Generate comprehensive reports for all active marketing campaigns in .CSV or .JSON format for data synthesis.</p>
    <div class="flex gap-4 relative z-10">
      <button class="bg-white text-black px-4 py-2 border-2 border-black font-black text-[10px] uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">DOWNLOAD_CSV</button>
      <button class="bg-black text-white px-4 py-2 border-2 border-white font-black text-[10px] uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">EXPORT_JSON</button>
    </div>
    <svg class="absolute -right-10 -bottom-10 w-48 h-48 text-blue-800 opacity-50" fill="currentColor" viewBox="0 0 20 20">
      <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
      <path d="M2 12a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2z"></path>
    </svg>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-8">
    <div class="flex items-center mb-4">
      <div class="bg-[#FFE600] border-2 border-black p-2 mr-3 shadow-[2px_2px_0_0_#000]">
        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>
      <h3 class="text-xl font-black uppercase tracking-tight">EXPIRATION_ALERT</h3>
    </div>
    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AUTO_REDACTION_PROTOCOL:</p>
    <p class="text-xs font-bold text-black leading-relaxed">System will automatically flag vouchers after passing the expiry date. Ensure manual override is set for seasonal campaigns.</p>
  </div>
</div>

<div id="addVoucherModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
      <h2 class="text-2xl font-black uppercase tracking-widest">ADD VOUCHER</h2>
      <button onclick="closeModal('addVoucherModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="addForm" action="<?= BASEURL; ?>/adminvoucher/store" method="POST" class="space-y-4">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">VOUCHER CODE</label>
          <input type="text" name="code" required placeholder="Ex: TIMART2026" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-black uppercase text-[#2563EB] focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1 relative" id="addTypeDropdown">
            <label class="text-[10px] font-black uppercase tracking-widest">DISCOUNT TYPE</label>
            <input type="hidden" name="discount_type" id="add_hiddenType" value="fixed">
            <button type="button" onclick="toggleAddType()" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-black uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
              <span id="addTypeText">FIXED (Rp)</span>
              <svg class="w-4 h-4 text-black transition-transform shrink-0" id="addTypeIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="addTypeMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col">
              <div onclick="selectAddType('fixed', 'FIXED (Rp)')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">FIXED (Rp)</div>
              <div onclick="selectAddType('percent', 'PERCENTAGE (%)')" class="p-3 font-black text-xs uppercase hover:bg-[#FFE600] cursor-pointer">PERCENTAGE (%)</div>
            </div>
          </div>

          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">VALUE AMOUNT</label>
            <input type="number" name="discount_amount" required min="1" step="0.01" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">MIN SPEND (Rp)</label>
            <input type="number" name="min_purchase" value="0" min="0" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">EXPIRY DATE</label>
            <input type="date" name="valid_until" required class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="space-y-1 pt-2 border-t-2 border-black border-dashed">
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 border-2 border-black rounded-none mr-3 accent-black">
            <span class="text-sm font-black uppercase">ACTIVATE IMMEDIATELY</span>
          </label>
        </div>

        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="button" onclick="closeModal('addVoucherModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">ADD</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editVoucherModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <h2 class="text-2xl font-black uppercase tracking-widest">EDIT VOUCHER</h2>
      <button onclick="closeModal('editVoucherModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="editForm" action="<?= BASEURL; ?>/adminvoucher/update" method="POST" class="space-y-4">
        <input type="hidden" name="id" id="edit_id">

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">VOUCHER CODE</label>
          <input type="text" name="code" id="edit_code" required class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-black uppercase text-[#2563EB] focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1 relative" id="editTypeDropdown">
            <label class="text-[10px] font-black uppercase tracking-widest">DISCOUNT TYPE</label>
            <input type="hidden" name="discount_type" id="edit_hiddenType">
            <button type="button" onclick="toggleEditType()" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-black uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
              <span id="editTypeText">FIXED (Rp)</span>
              <svg class="w-4 h-4 text-black transition-transform shrink-0" id="editTypeIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="editTypeMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col">
              <div onclick="selectEditType('fixed', 'FIXED (Rp)')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">FIXED (Rp)</div>
              <div onclick="selectEditType('percent', 'PERCENTAGE (%)')" class="p-3 font-black text-xs uppercase hover:bg-[#FFE600] cursor-pointer">PERCENTAGE (%)</div>
            </div>
          </div>

          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">VALUE AMOUNT</label>
            <input type="number" name="discount_amount" id="edit_amount" required min="1" step="0.01" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">MIN SPEND (Rp)</label>
            <input type="number" name="min_purchase" id="edit_min" min="0" class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">EXPIRY DATE</label>
            <input type="date" name="valid_until" id="edit_expiry" required class="w-full p-3 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="space-y-1 pt-2 border-t-2 border-black border-dashed">
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" name="is_active" id="edit_active" value="1" class="w-5 h-5 border-2 border-black rounded-none mr-3 accent-black">
            <span class="text-sm font-black uppercase">VOUCHER IS ACTIVE</span>
          </label>
        </div>

        <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
          <button type="button" onclick="closeModal('editVoucherModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="confirmDeleteModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">WARNING!</h2>
    <p class="text-sm font-bold text-white mb-6">Yakin ingin menghapus voucher ini.</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">CANCEL</button>
      <button onclick="executeDeleteVoucher()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">DELETE</button>
    </div>
  </div>
</div>

<div id="successModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-black mb-2">SUCCESS!</h2>
    <p id="successMessage" class="text-sm font-bold text-black mb-6">Operasi berhasil dilakukan.</p>
    <button onclick="reloadPage()" class="w-full bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">OK</button>
  </div>
</div>

<div id="errorModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-white mb-2">ERROR!</h2>
    <p id="errorMessage" class="text-sm font-bold text-white mb-6">Terjadi kesalahan.</p>
    <button onclick="closeModal('errorModal')" class="w-full bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">TUTUP</button>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['vouchers']) ? 'false' : 'true'; ?>;
  const BASEURL = '<?= BASEURL; ?>';
</script>
<script src="<?= BASEURL; ?>/js/admin_vouchers.js?v=<?= time(); ?>"></script>