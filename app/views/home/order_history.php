<div class="bg-[#F8F9FA] min-h-screen pt-10 pb-20 font-sans text-black" data-aos="fade-in">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-10 flex flex-col sm:flex-row items-start sm:items-end justify-between border-b-4 border-black pb-4 gap-4">
      <div>
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight" style="-webkit-text-stroke: 1px black;">DEPLOYMENT LOGS</h1>
        <p class="text-sm font-bold mt-2 text-gray-700 uppercase tracking-widest border-l-4 border-[#2563EB] pl-2">TRACK YOUR ACQUIRED GEAR</p>
      </div>
      <div class="bg-black text-white px-4 py-2 border-2 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#A6FAAE]">
        STATUS: SECURE
      </div>
    </div>

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-8 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <p><?= $_SESSION['flash_success']; ?></p>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
      <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-8 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-center">
        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <p><?= $_SESSION['flash_error']; ?></p>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div class="space-y-6">

      <?php if (empty($data['orders'])): ?>
        <div class="bg-white border-4 border-black border-dashed p-12 text-center shadow-[6px_6px_0_0_#000]" data-aos="zoom-in">
          <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
          </svg>
          <h3 class="text-2xl font-black uppercase tracking-tight mb-2">NO LOGS FOUND</h3>
          <p class="text-sm font-bold text-gray-500 uppercase">You haven't initiated any deployments yet.</p>
          <a href="<?= BASEURL; ?>/katalog" class="mt-6 inline-block bg-[#2563EB] text-white border-4 border-black px-8 py-4 text-xs font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all">VIEW CATALOG</a>
        </div>
      <?php else: ?>

        <?php foreach ($data['orders'] as $order): ?>
          <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0_0_#000]">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-4 border-black pb-4 mb-4 gap-4">
              <div>
                <span class="bg-[#FFE600] border-2 border-black px-2 py-0.5 text-[10px] font-black tracking-widest uppercase mb-1 inline-block shadow-[2px_2px_0_0_#000]">
                  INV: <?= htmlspecialchars($order['invoice_number']); ?>
                </span>
                <p class="text-xs font-bold uppercase text-gray-600 mt-1"><?= date('d M Y - H:i', strtotime($order['created_at'])); ?></p>
              </div>

              <?php
              $status_bg = 'bg-gray-200 text-black';
              $status_text = 'UNKNOWN';

              if ($order['payment_status'] === 'pending' && empty($order['payment_proof'])) {
                $status_bg = 'bg-[#FF5757] text-white';
                $status_text = 'AWAITING PAYMENT';
              } elseif ($order['payment_status'] === 'pending' && !empty($order['payment_proof'])) {
                $status_bg = 'bg-[#90E0FF] text-black';
                $status_text = 'VERIFYING PROOF';
              } elseif ($order['payment_status'] === 'paid') {
                if ($order['order_status'] === 'pending' || $order['order_status'] === 'processing') {
                  $status_bg = 'bg-[#FFE600] text-black';
                  $status_text = 'GEAR PREPARATION';
                } elseif ($order['order_status'] === 'shipped') {
                  $status_bg = 'bg-[#2563EB] text-white';
                  $status_text = 'IN TRANSIT';
                } elseif ($order['order_status'] === 'delivered') {
                  $status_bg = 'bg-[#A6FAAE] text-black';
                  $status_text = 'MISSION ACCOMPLISHED';
                }
              } elseif ($order['order_status'] === 'cancelled') {
                $status_bg = 'bg-black text-white';
                $status_text = 'TERMINATED';
              }
              ?>
              <div class="<?= $status_bg; ?> border-2 border-black px-3 py-1.5 text-[10px] font-black tracking-widest uppercase shadow-[2px_2px_0_0_#000]">
                <?= $status_text; ?>
              </div>
            </div>

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
              <div class="w-full lg:w-auto">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">TOTAL DEPLOYMENT COST</p>
                <p class="text-3xl md:text-4xl font-black text-black tracking-tighter mb-2">Rp <?= number_format((float)$order['grand_total'], 0, ',', '.'); ?></p>
                <p class="text-xs font-bold text-gray-600 uppercase border-l-4 border-[#2563EB] pl-2">METHOD: <?= htmlspecialchars($order['payment_method']); ?></p>
              </div>

              <div class="w-full lg:w-auto flex flex-col sm:flex-row gap-3">

                <button class="bg-white border-4 border-black px-6 py-3 text-xs font-black uppercase tracking-widest text-center shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] transition-all cursor-not-allowed opacity-70" title="Akan dibuat nanti">
                  VIEW INTEL (COMING SOON)
                </button>

                <?php if ($order['payment_status'] === 'pending' && empty($order['payment_proof'])): ?>
                  <a href="<?= BASEURL; ?>/order/upload/<?= $order['id']; ?>" class="bg-[#2563EB] text-white border-4 border-black px-6 py-3 text-xs font-black uppercase tracking-widest text-center shadow-[4px_4px_0_0_#000] hover:bg-blue-700 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] transition-all flex items-center justify-center">
                    UPLOAD PROOF
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                  </a>
                <?php elseif ($order['payment_status'] === 'pending' && !empty($order['payment_proof'])): ?>
                  <button disabled class="bg-gray-200 text-gray-500 border-4 border-gray-400 px-6 py-3 text-xs font-black uppercase tracking-widest cursor-not-allowed border-dashed">
                    PROOF SENT. WAITING ADMIN...
                  </button>
                <?php endif; ?>

              </div>
            </div>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>

  </div>
</div>