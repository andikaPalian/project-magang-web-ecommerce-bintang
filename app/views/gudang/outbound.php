<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="mb-6 border-b-4 border-black pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">OUTBOUND</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola pengiriman pesanan online dan distribusi stok ke cabang.
      </p>
    </div>

    <button onclick="openTransferModal()" class="w-full md:w-auto bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center justify-center shrink-0">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
      </svg>
      DISTRIBUSI KE CABANG
    </button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-center relative">
      <h3 class="text-sm font-black border-b-4 border-black pb-2 mb-4">INFO</h3>

      <div class="flex justify-between items-center mb-4">
        <span class="text-xs font-black">READY FOR HANDOVER</span>
        <span class="bg-black text-white px-3 py-1 font-black text-lg">
          <?= str_pad((string)($data['stats']['ready_to_ship'] ?? 0), 2, '0', STR_PAD_LEFT) ?>
        </span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-xs font-black">TOTAL PARCELS</span>
        <span class="bg-[#2563EB] border-2 border-black text-white px-3 py-1 font-black text-lg shadow-[2px_2px_0_0_#000]">
          <?= str_pad((string)($data['stats']['total_parcels'] ?? 0), 2, '0', STR_PAD_LEFT) ?>
        </span>
      </div>
    </div>

    <div class="lg:col-span-2 bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex items-start gap-4">
      <div class="bg-black text-white w-12 h-12 flex items-center justify-center font-black text-2xl shrink-0 border-2 border-white shadow-[4px_4px_0_0_#000]">!</div>
      <div>
        <h3 class="text-lg font-black tracking-tight mb-1">PERHATIAN</h3>
        <p class="text-xs font-bold leading-relaxed text-black/80">
          Pastikan kardus yang diserahkan ke kurir sesuai dengan <span class="bg-black text-[#FFE600] px-1">CARRIER LOGISTICS</span>. Lakukan pengecekan resi secara teliti sebelum mengeklik tombol eksekusi handover untuk menghindari paket salah kirim.
        </p>
      </div>
    </div>

  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10" data-aos="fade-up" data-aos-delay="100">
    <div class="bg-black text-white p-3 flex justify-between items-center border-b-4 border-black">
      <div class="flex items-center text-xs font-black">
        LIST ORDERS (ONLINE B2C)
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[900px]">
        <thead class="bg-gray-100 border-b-4 border-black font-black text-[10px] text-gray-600">
          <tr>
            <th class="p-4 border-r-2 border-black w-40">ORDER ID</th>
            <th class="p-4 border-r-2 border-black">CUSTOMER</th>
            <th class="p-4 border-r-2 border-black w-48 text-center">CARRIER / LOGISTICS</th>
            <th class="p-4 border-r-2 border-black w-32 text-center">STATUS</th>
            <th class="p-4 text-center w-64">ACTION</th>
          </tr>
        </thead>
        <tbody class="font-bold">
          <?php if (empty($data['orders'])): ?>
            <tr>
              <td colspan="5" class="p-16 text-center text-gray-400 font-black uppercase tracking-widest border-b-4 border-black bg-gray-50">
                LOADING DOCK CLEAR. NO PACKAGES WAITING.
              </td>
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
                  <p class="text-[9px] text-gray-500 mt-1"><?= str_pad((string)$order['total_items'], 2, '0', STR_PAD_LEFT) ?> ITEMS INSIDE</p>
                </td>

                <td class="p-4 border-r-2 border-black text-center text-sm font-black text-[#2563EB]">
                  <?= htmlspecialchars($order['shipping_method']) ?>
                </td>

                <td class="p-4 border-r-2 border-black text-center">
                  <span class="inline-block border-2 border-black px-2 py-1 bg-[#A6FAAE] text-black text-[9px] font-black shadow-[2px_2px_0_0_#000]">PACKED</span>
                </td>

                <td class="p-4 text-center">
                  <button type="button" onclick="openDispatchModal('<?= $order['id'] ?>', '<?= $order['invoice_number'] ?>', '<?= htmlspecialchars($order['shipping_method']) ?>')" class="w-full bg-[#2563EB] text-white border-2 border-black py-2 shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 hover:bg-blue-700 transition-all text-[9px] font-black flex justify-center items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                    VERIFY HANDOVER
                  </button>
                </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="border-t-4 border-black p-3 text-[9px] font-black text-gray-500 bg-gray-50">
      SHOWING <?= count($data['orders'] ?? []) ?> PACKAGES READY FOR DISPATCH
    </div>
  </div>

  <div id="dispatchModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
    <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-lg relative">

      <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#A6FAAE] text-black">
        <h2 class="text-2xl font-black uppercase tracking-widest flex items-center">
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          VERIFICATION
        </h2>
        <button onclick="closeDispatchModal()" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
      </div>

      <div class="p-8">
        <p class="text-sm font-bold mb-4 leading-relaxed text-black">
          Verifikasi penyerahan paket ke pihak ekspedisi untuk resi:
          <br>
          <span id="dispatchInvoiceText" class="font-black text-xl text-[#2563EB] mt-2 inline-block">#INV-XXX</span>
        </p>

        <div class="border-l-4 border-black pl-4 py-2 bg-gray-50 mb-6">
          <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">LOGISTICS CARRIER:</p>
          <p id="dispatchCourierText" class="text-lg font-black text-black uppercase">COURIER_NAME</p>
        </div>

        <form id="dispatchForm" method="POST" action="">
          <div class="flex gap-4 pt-4 border-t-4 border-black mt-6">
            <button type="button" onclick="closeDispatchModal()" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">ABORT</button>
            <button type="submit" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">CONFIRM</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <div id="transferModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
    <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-2xl relative my-auto">

      <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
        <div>
          <h2 class="text-2xl font-black uppercase tracking-widest">TRANSFER STOK</h2>
          <p class="text-[10px] font-bold uppercase tracking-widest text-gray-600">Gudang Pusat -> Toko Cabang</p>
        </div>
        <button onclick="closeTransferModal()" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
      </div>

      <div class="p-8">
        <form id="transferForm" action="<?= BASEURL; ?>/adminproduct/distributeStock" method="POST" class="space-y-6">

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">PILIH PRODUK YANG DIKIRIM</label>
            <div class="relative">
              <select name="product_id" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all appearance-none cursor-pointer">
                <option value="">-- PILIH PRODUK --</option>
                <?php if (isset($data['products'])): ?>
                  <?php foreach ($data['products'] as $p): ?>
                    <option value="<?= $p['id'] ?>">ID: <?= $p['id'] ?> - <?= htmlspecialchars($p['name']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">CABANG TUJUAN</label>
              <div class="relative">
                <select name="destination_location_id" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all appearance-none cursor-pointer">
                  <option value="">-- PILIH CABANG --</option>
                  <?php if (isset($data['locations'])): ?>
                    <?php foreach ($data['locations'] as $loc): ?>
                      <?php if ($loc['id'] != $_SESSION['location_id']): ?>
                        <option value="<?= $loc['id'] ?>">[<?= strtoupper($loc['type']) ?>] <?= htmlspecialchars($loc['name']) ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">JUMLAH (QTY)</label>
              <input type="number" name="quantity" min="1" required placeholder="Contoh: 10" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black text-xl text-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
            </div>
          </div>

          <div class="flex gap-4 pt-4 mt-4 border-t-4 border-black">
            <button type="button" onclick="closeTransferModal()" class="flex-1 bg-white border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all py-4">BATAL</button>
            <button type="submit" class="flex-1 bg-[#FFE600] text-black border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all py-4">KIRIM STOK</button>
          </div>
        </form>
      </div>

    </div>
  </div>

</div>

<script>
  // FUNGSI MODAL HANDOVER KURIR (B2C)
  function openDispatchModal(orderId, invoiceNumber, courier) {
    let invArray = invoiceNumber.split('-');
    let shortInv = invArray[2] ? 'INV-' + invArray[2] : invoiceNumber;

    document.getElementById('dispatchInvoiceText').innerText = shortInv;
    document.getElementById('dispatchCourierText').innerText = courier;
    document.getElementById('dispatchForm').action = `<?= BASEURL; ?>/outbound/dispatch/${orderId}`;

    const modal = document.getElementById('dispatchModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeDispatchModal() {
    const modal = document.getElementById('dispatchModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

  // FUNGSI MODAL TRANSFER GUDANG (B2B)
  function openTransferModal() {
    const modal = document.getElementById('transferModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closeTransferModal() {
    const modal = document.getElementById('transferModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }
</script>