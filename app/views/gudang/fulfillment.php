<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="mb-6 border-b-4 border-black pb-4" data-aos="fade-down">
    <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">PENGEMASAN</h1>
    <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
      Kelola pengemasan barang.
    </p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-center relative">
      <h3 class="text-sm font-black border-b-4 border-black pb-2 mb-4">INFO</h3>

      <div class="flex justify-between items-center mb-4">
        <span class="text-xs font-black">PENDING INVOICES</span>
        <span class="bg-black text-white px-3 py-1 font-black text-lg">
          <?= str_pad((string)$data['stats']['pending_invoices'], 2, '0', STR_PAD_LEFT) ?>
        </span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-xs font-black">TOTAL ITEMS TO PICK</span>
        <span class="bg-[#2563EB] border-2 border-black text-white px-3 py-1 font-black text-lg shadow-[2px_2px_0_0_#000]">
          <?= str_pad((string)$data['stats']['total_items_to_pick'], 2, '0', STR_PAD_LEFT) ?>
        </span>
      </div>
    </div>

    <div class="lg:col-span-2 bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex items-start gap-4">
      <div class="bg-black text-white w-12 h-12 flex items-center justify-center font-black text-2xl shrink-0 border-2 border-white shadow-[4px_4px_0_0_#000]">!</div>
      <div>
        <h3 class="text-lg font-black tracking-tight mb-1">PERHATIAn</h3>
        <p class="text-xs font-bold leading-relaxed text-black/80">
          Pastikan jumlah barang fisik di dalam kardus sesuai dengan angka <span class="bg-black text-[#FFE600] px-1">ITEMS COUNT</span> sebelum mengeklik eksekusi. Segera tempelkan resi pada kardus untuk menghindari paket tertukar di area OUTBOUND.
        </p>
      </div>
    </div>

  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">
    <div class="bg-black text-white p-3 flex justify-between items-center border-b-4 border-black">
      <div class="flex items-center text-xs font-black">
        LIST ORDERS
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-gray-100 border-b-4 border-black font-black text-[10px] text-gray-600">
          <tr>
            <th class="p-4 border-r-2 border-black w-40">ORDER ID</th>
            <th class="p-4 border-r-2 border-black">CUSTOMER</th>
            <th class="p-4 border-r-2 border-black w-32 text-center">ITEMS COUNT</th>
            <th class="p-4 border-r-2 border-black w-32 text-center">STATUS</th>
            <th class="p-4 text-center w-80">ACTION</th>
          </tr>
        </thead>
        <tbody class="font-bold">
          <?php if (empty($data['orders'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black uppercase tracking-widest">ALL ORDERS FULFILLED. NO PENDING TASKS.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['orders'] as $order): ?>
              <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">

                <td class="p-4 border-r-2 border-black">
                  <span class="font-black text-sm text-black">#<?= explode('-', $order['invoice_number'])[2] ?? $order['invoice_number'] ?></span>
                  <p class="text-[9px] text-gray-500 mt-1 font-mono"><?= date('H:i // d-M-Y', strtotime($order['created_at'])) ?></p>
                </td>

                <td class="p-4 border-r-2 border-black">
                  <?= htmlspecialchars($order['recipient_name']) ?>
                  <p class="text-[9px] text-[#2563EB] mt-1"><?= htmlspecialchars($order['shipping_method']) ?></p>
                </td>

                <td class="p-4 border-r-2 border-black text-center text-lg font-black">
                  <?= str_pad((string)$order['total_items'], 2, '0', STR_PAD_LEFT) ?>
                </td>

                <td class="p-4 border-r-2 border-black text-center">
                  <span class="inline-block border-2 border-black px-2 py-1 bg-[#FFE600] text-black text-[9px] font-black shadow-[2px_2px_0_0_#000]">PROCESSING</span>
                </td>

                <td class="p-4 text-center flex justify-center space-x-2 items-center h-full">
                  <a href="<?= BASEURL; ?>/fulfillment/print_slip/<?= $order['id'] ?>" target="_blank" class="flex-1 bg-white border-2 border-black py-2 shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 hover:bg-gray-100 transition-all text-[9px] font-black flex justify-center items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    PRINT SLIP
                  </a>

                  <button type="button" onclick="openPackModal('<?= $order['id'] ?>', '<?= $order['invoice_number'] ?>', '<?= $order['total_items'] ?>')" class="flex-1 bg-[#2563EB] text-white border-2 border-black py-2 shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 hover:bg-blue-700 transition-all text-[9px] font-black flex justify-center items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                    MARK AS READY
                  </button>
                </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="border-t-4 border-black p-3 text-[9px] font-black text-gray-500 bg-gray-50">
      SHOWING <?= count($data['orders']) ?> PENDING ORDERS IN QUEUE
    </div>
  </div>

  <div id="packModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
    <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">

      <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
        <h2 class="text-2xl font-black uppercase tracking-widest flex items-center">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
          VERIFICATION
        </h2>
        <button onclick="closePackModal()" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
      </div>

      <div class="p-8">
        <p class="text-sm font-bold mb-4 leading-relaxed text-black">
          Sistem mendeteksi <span id="modalItemCount" class="bg-black text-white px-2 py-1 mx-1 font-black text-lg">00</span> item fisik untuk resi:
          <br>
          <span id="modalInvoiceText" class="font-black text-xl text-[#2563EB] mt-2 inline-block">#INV-XXX</span>
        </p>

        <div class="border-l-4 border-black pl-4 py-2 bg-gray-50 mb-6">
          <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">CONFIRMATION CHECK</p>
          <p class="text-sm font-bold">Apakah seluruh barang fisik sudah masuk ke dalam kardus, resi ditempel, dan siap diserahkan ke kurir?</p>
        </div>

        <form id="packForm" method="POST" action="">
          <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
            <button type="button" onclick="closePackModal()" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">CANCEL</button>
            <button type="submit" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">CONFIRM</button>
          </div>
        </form>
      </div>

    </div>
  </div>

</div>

<script>
  function openPackModal(orderId, invoiceNumber, totalItems) {
    let invArray = invoiceNumber.split('-');
    let shortInv = invArray[2] ? 'INV-' + invArray[2] : invoiceNumber;

    document.getElementById('modalInvoiceText').innerText = shortInv;
    document.getElementById('modalItemCount').innerText = totalItems.toString().padStart(2, '0');
    document.getElementById('packForm').action = `<?= BASEURL; ?>/fulfillment/mark_packed/${orderId}`;

    const modal = document.getElementById('packModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closePackModal() {
    const modal = document.getElementById('packModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }
</script>