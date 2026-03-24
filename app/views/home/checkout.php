<div class="bg-[#F8F9FA] min-h-screen pt-10 pb-20 font-sans text-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8" data-aos="fade-right">
      <a href="<?= BASEURL; ?>/cart" class="inline-flex items-center text-xs font-black uppercase tracking-widest border-b-2 border-black pb-0.5 hover:text-[#2563EB] hover:border-[#2563EB] transition-colors mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        BACK TO CART
      </a>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">CHECKOUT</h1>
      <p class="text-sm font-bold mt-2 text-gray-700 bg-[#FFE600] inline-block px-3 py-1 border-2 border-black shadow-[2px_2px_0_0_#000]">CHECKOUT PRODUK ANDA</p>
    </div>

    <form action="<?= BASEURL; ?>/order/create" method="POST" id="checkout-form" class="flex flex-col lg:flex-row gap-8 items-start">

      <input type="hidden" name="shipping_method_name" id="input-shipping-method-name" value="Standard Drop">
      <input type="hidden" name="voucher_id" id="input-voucher-id" value="">

      <div class="w-full lg:w-2/3 space-y-8">

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 md:p-8" data-aos="fade-up">
          <h2 class="text-xl font-black uppercase mb-6 flex items-center border-b-4 border-black pb-4">
            <span class="bg-black text-white w-8 h-8 flex items-center justify-center mr-3 text-sm">01</span>
            ALAMAT PENGIRIMAN
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-1">
              <label class="block text-xs font-black uppercase tracking-widest mb-2">NAMA LENGKAP</label>
              <input type="text" name="recipient_name" value="<?= htmlspecialchars($data['user']['name'] ?? ''); ?>" required class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all placeholder-gray-400" placeholder="JOHN DOE">
            </div>
            <div class="md:col-span-1">
              <label class="block text-xs font-black uppercase tracking-widest mb-2">NO. TELEPON</label>
              <input type="tel" name="recipient_phone" value="<?= htmlspecialchars($data['user']['phone'] ?? ''); ?>" required class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all placeholder-gray-400" placeholder="08XXXXXXXXXX">
            </div>
            <div class="md:col-span-2">
              <label class="block text-xs font-black uppercase tracking-widest mb-2">ALAMAT LENGKAP</label>
              <textarea name="shipping_address" required rows="3" class="w-full bg-gray-50 border-2 border-black px-4 py-3 font-bold text-sm outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all placeholder-gray-400" placeholder="STREET NAME, RT/RW, CITY, POSTAL CODE"><?= htmlspecialchars($data['user']['address'] ?? ''); ?></textarea>
            </div>
          </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 md:p-8" data-aos="fade-up" data-aos-delay="100">
          <h2 class="text-xl font-black uppercase mb-6 flex items-center border-b-4 border-black pb-4">
            <span class="bg-black text-white w-8 h-8 flex items-center justify-center mr-3 text-sm">02</span>
            PILIH KURIR
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="cursor-pointer group relative">
              <input type="radio" name="shipping_cost" value="50000" class="peer sr-only" checked onclick="updateOngkir(50000, 'Standard Drop')">
              <div class="h-full bg-gray-50 border-2 border-black p-4 peer-checked:bg-[#2563EB] peer-checked:text-white peer-checked:shadow-[4px_4px_0_0_#000] peer-checked:-translate-y-1 transition-all">
                <div class="flex justify-between items-start mb-2">
                  <p class="font-black uppercase tracking-wider text-sm">STANDARD DROP</p>
                  <svg class="w-5 h-5 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <p class="text-xs font-bold opacity-80 mb-3">Est. 2-3 Days Delivery</p>
                <p class="font-black text-lg">Rp 50.000</p>
              </div>
            </label>

            <label class="cursor-pointer group relative">
              <input type="radio" name="shipping_cost" value="150000" class="peer sr-only" onclick="updateOngkir(150000, 'Heavy Cargo')">
              <div class="h-full bg-gray-50 border-2 border-black p-4 peer-checked:bg-[#2563EB] peer-checked:text-white peer-checked:shadow-[4px_4px_0_0_#000] peer-checked:-translate-y-1 transition-all">
                <div class="flex justify-between items-start mb-2">
                  <p class="font-black uppercase tracking-wider text-sm">HEAVY CARGO</p>
                  <svg class="w-5 h-5 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <p class="text-xs font-bold opacity-80 mb-3">Est. 5-7 Days (Big Items)</p>
                <p class="font-black text-lg">Rp 150.000</p>
              </div>
            </label>
          </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 md:p-8" data-aos="fade-up" data-aos-delay="200">
          <h2 class="text-xl font-black uppercase mb-6 flex items-center border-b-4 border-black pb-4">
            <span class="bg-black text-white w-8 h-8 flex items-center justify-center mr-3 text-sm">03</span>
            METODE PEMBAYARAN
          </h2>

          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="Transfer BCA" class="peer sr-only" checked>
              <div class="text-center bg-gray-50 border-2 border-black p-3 peer-checked:bg-[#A6FAAE] peer-checked:shadow-[4px_4px_0_0_#000] peer-checked:-translate-y-1 transition-all">
                <span class="font-black uppercase text-xs">TRF BCA</span>
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="Transfer Mandiri" class="peer sr-only">
              <div class="text-center bg-gray-50 border-2 border-black p-3 peer-checked:bg-[#A6FAAE] peer-checked:shadow-[4px_4px_0_0_#000] peer-checked:-translate-y-1 transition-all">
                <span class="font-black uppercase text-xs">TRF MANDIRI</span>
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="payment_method" value="QRIS" class="peer sr-only">
              <div class="text-center bg-gray-50 border-2 border-black p-3 peer-checked:bg-[#A6FAAE] peer-checked:shadow-[4px_4px_0_0_#000] peer-checked:-translate-y-1 transition-all">
                <span class="font-black uppercase text-xs">QRIS MANUAL</span>
              </div>
            </label>
          </div>
          <p class="text-xs font-bold text-gray-500 mt-4">* Instruksi transfer akan ditampilkan setelah Anda menekan tombol konfirmasi.</p>
        </div>

      </div>

      <div class="w-full lg:w-1/3 sticky top-24" data-aos="fade-left">
        <div class="bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col h-full">
          <h3 class="text-2xl font-black uppercase mb-4 border-b-4 border-black pb-4">RINGKASAN PESANAN</h3>

          <div class="space-y-4 mb-6 max-h-[250px] overflow-y-auto pr-2 custom-scrollbar border-b-4 border-black pb-6">
            <?php foreach ($data['cart_items'] as $item): ?>
              <div class="flex items-start justify-between group bg-white border-2 border-black p-2 shadow-[2px_2px_0_0_#000]">
                <div class="flex items-center space-x-3 w-3/4">
                  <div class="w-12 h-12 bg-gray-100 border-2 border-black flex-shrink-0 overflow-hidden">
                    <?php
                    $img_url = $item['image_url'] ?? '';
                    $img = !empty($img_url) ? (str_starts_with($img_url, 'http') ? $img_url : BASEURL . '/img/products/' . $img_url) : 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=400&q=80';
                    ?>
                    <img src="<?= $img; ?>" class="w-full h-full object-cover mix-blend-multiply grayscale">
                  </div>
                  <div>
                    <h4 class="text-xs font-black uppercase line-clamp-1 leading-tight"><?= htmlspecialchars($item['name'] ?? ''); ?></h4>
                    <p class="text-[10px] font-bold mt-1 text-gray-700"><?= $item['quantity']; ?> x Rp <?= number_format((float)(!empty($item['discount_price']) ? $item['discount_price'] : $item['price']), 0, ',', '.'); ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mb-6 border-b-4 border-black pb-6">
            <label class="block text-[10px] font-black uppercase tracking-widest mb-2 text-black">HAVE A VOUCHER CODE?</label>
            <div class="flex gap-2 h-12">
              <input type="text" id="voucher-input" class="w-full h-full bg-white border-4 border-black px-3 font-black uppercase text-sm outline-none shadow-[4px_4px_0_0_#000] focus:-translate-y-1 focus:shadow-[6px_6px_0_0_#000] transition-all placeholder-gray-400" placeholder="ENTER CODE">
              <button type="button" onclick="applyVoucher()" id="btn-apply-voucher" class="h-full bg-black text-white border-4 border-black px-4 font-black uppercase text-sm shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex-shrink-0">APPLY</button>
            </div>

            <div id="voucher-msg-container" class="hidden mt-4 p-3 border-4 border-black shadow-[4px_4px_0_0_#000] transition-all">
              <p id="voucher-msg" class="text-[10px] md:text-xs font-black uppercase tracking-widest leading-tight"></p>
            </div>
          </div>
          <div class="space-y-2 mb-6 font-bold text-sm">
            <div class="flex justify-between items-end border-b-2 border-black border-dashed pb-2">
              <span class="uppercase">SUBTOTAL</span>
              <span>Rp <?= number_format((float)($data['subtotal_bayar'] ?? 0), 0, ',', '.'); ?></span>
            </div>

            <?php if (!empty($data['total_diskon']) && $data['total_diskon'] > 0): ?>
              <div class="flex justify-between items-end border-b-2 border-black border-dashed pb-2 text-[#FF5757]">
                <span class="uppercase">PRODUCT DISCOUNT</span>
                <span>- Rp <?= number_format((float)$data['total_diskon'], 0, ',', '.'); ?></span>
              </div>
            <?php endif; ?>

            <div id="voucher-discount-container" class="flex justify-between items-end border-b-2 border-black border-dashed pb-2 text-[#FF5757] hidden">
              <span class="uppercase font-black">VOUCHER (<span id="voucher-code-display"></span>)</span>
              <span id="display-voucher-diskon" class="font-black">- Rp 0</span>
            </div>

            <div class="flex justify-between items-end border-b-2 border-black border-dashed pb-2">
              <span class="uppercase">ONGKOS KIRIM</span>
              <span id="display-ongkir">Rp 50.000</span>
            </div>
          </div>

          <div class="bg-black text-white p-4 border-2 border-black mb-6 shadow-[4px_4px_0_0_#000]">
            <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-1">TOTAL PEMBAYARAN</p>
            <p id="display-total-bayar" class="text-2xl font-black tracking-tight text-[#A6FAAE]">
              Rp <?= number_format((float)($data['subtotal_bayar'] ?? 0) + 50000, 0, ',', '.'); ?>
            </p>
          </div>

          <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border-4 border-black shadow-[6px_6px_0_0_#000] text-sm font-black uppercase tracking-widest text-white bg-[#FF5757] hover:bg-red-700 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[4px_4px_0_0_#000] active:translate-y-[6px] active:translate-x-[6px] active:shadow-none transition-all">
            CONFIRM & PAY
            <svg class="w-5 h-5 ml-2 border-l-2 border-white pl-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </button>

        </div>
      </div>

    </form>
  </div>
</div>

<script>
  const BASEURL = '<?= BASEURL; ?>';
  let subtotalBayar = <?= (float)($data['subtotal_bayar'] ?? 0); ?>;
</script>

<script src="<?= BASEURL; ?>/js/checkout.js?v=<?= time(); ?>"></script>