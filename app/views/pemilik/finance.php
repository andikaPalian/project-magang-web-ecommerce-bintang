<?php
$total_tx = (int)($data['totals']['total_transactions'] ?? 0);
$total_gross = (float)($data['totals']['total_revenue'] ?? 0);
$completed_deliv = (int)($data['totals']['completed_delivered'] ?? 0);

$avg_order = $total_tx > 0 ? $total_gross / $total_tx : 0;

$currentPage = $data['pagination']['current_page'];
$totalPages = $data['pagination']['total_pages'];
$totalRecords = $data['pagination']['total_records'];

$params = $_GET;
unset($params['url']);
?>

<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8" data-aos="fade-down">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-1">FINANCIAL REPORTS</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Analisis mendalam tentang performa penjualan, tren pendapatan, dan perilaku pelanggan untuk membantu pemilik bisnis membuat keputusan strategis yang lebih baik.
      </p>
    </div>

    <div class="mt-4 md:mt-0 flex flex-row gap-4 w-full md:w-auto">

      <button type="button" id="btn-export-pdf" class="bg-white text-black px-4 py-2 border-4 border-black font-black text-[10px] md:text-xs uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-transform flex items-center justify-center flex-1 md:flex-none">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        EXPORT REPORT (PDF)
      </button>

      <form method="GET" action="<?= BASEURL; ?>/pemilik/exportExcel" target="_blank" class="flex-1 md:flex-none">
        <input type="hidden" name="date_range" value="<?= htmlspecialchars($data['filters']['date_range'] ?? 'ALL_TIME') ?>">
        <?php if (isset($data['filters']['payment_status']) && is_array($data['filters']['payment_status'])): ?>
          <?php foreach ($data['filters']['payment_status'] as $status): ?>
            <input type="hidden" name="payment_status[]" value="<?= htmlspecialchars($status) ?>">
          <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit" class="w-full bg-[#2563EB] text-white px-4 py-2 border-4 border-black font-black text-[10px] md:text-xs uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-transform flex items-center justify-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          EXPORT REPORT (EXCEL)
        </button>
      </form>

    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">PENDAPATAN KOTOR</h3>
      <div>
        <span class="text-3xl font-black text-black leading-none block mb-2">Rp <?= number_format($total_gross, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-[#4ADE80]">+ SQL AGGREGATE</span>
      </div>
    </div>
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">TOTAL TRANSAKSI</h3>
      <div>
        <span class="text-3xl font-black text-black leading-none block mb-2"><?= number_format($total_tx, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-gray-500">RECORDS FOUND</span>
      </div>
    </div>
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">RATA-RATA NILAI PEMESANAN</h3>
      <div>
        <span class="text-3xl font-black text-black leading-none block mb-2">Rp <?= number_format($avg_order, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-[#4ADE80]">+ STABLE_METRIC</span>
      </div>
    </div>
    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-5 flex flex-col justify-between">
      <h3 class="text-[9px] font-black tracking-widest text-[#2563EB] mb-2">PEMESANAN SELESAI</h3>
      <div>
        <span class="text-3xl font-black text-black leading-none block mb-2"><?= number_format($completed_deliv, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-[#2563EB]">UNITS SECURED</span>
      </div>
    </div>
  </div>

  <div class="flex flex-col lg:flex-row gap-8" data-aos="fade-up" data-aos-delay="100">

    <div class="w-full lg:w-64 shrink-0">
      <form method="GET" action="<?= BASEURL; ?>/pemilik/finance" class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
        <div class="flex items-center mb-6 border-b-4 border-black pb-4">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
          </svg>
          <h2 class="text-sm font-black tracking-widest">FILTERS</h2>
        </div>

        <div class="mb-6">
          <label class="block text-[10px] font-black mb-2">DATE RANGE</label>
          <select name="date_range" class="w-full border-4 border-black p-2 text-xs font-black uppercase outline-none cursor-pointer bg-white focus:bg-gray-100">
            <option value="ALL_TIME" <?= $data['filters']['date_range'] === 'ALL_TIME' ? 'selected' : '' ?>>ALL TIME</option>
            <option value="LAST_30_DAYS" <?= $data['filters']['date_range'] === 'LAST_30_DAYS' ? 'selected' : '' ?>>LAST 30 DAYS</option>
            <option value="THIS_YEAR" <?= $data['filters']['date_range'] === 'THIS_YEAR' ? 'selected' : '' ?>>THIS YEAR</option>
          </select>
        </div>

        <div class="mb-6">
          <label class="block text-[10px] font-black mb-2">PAYMENT STATUS</label>
          <div class="flex items-center gap-2 mb-2">
            <input type="checkbox" name="payment_status[]" value="completed" <?= in_array('completed', $data['filters']['payment_status'] ?? []) ? 'checked' : '' ?> class="w-4 h-4 border-2 border-black accent-black cursor-pointer">
            <span class="text-[10px] font-bold">COMPLETED</span>
          </div>
          <div class="flex items-center gap-2 mb-2">
            <input type="checkbox" name="payment_status[]" value="pending" <?= in_array('pending', $data['filters']['payment_status'] ?? []) ? 'checked' : '' ?> class="w-4 h-4 border-2 border-black accent-black cursor-pointer">
            <span class="text-[10px] font-bold">PENDING</span>
          </div>
        </div>

        <button type="submit" class="w-full bg-black text-white border-4 border-black font-black text-[10px] py-3 tracking-widest hover:bg-[#FFE600] hover:text-black transition-colors">
          APPLY FILTERS
        </button>
      </form>
    </div>

    <div class="flex-1 flex flex-col gap-4">
      <div id="report-content" class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10 overflow-hidden transition-opacity duration-300">

        <div class="bg-black text-white font-black text-[10px] tracking-widest p-4 flex justify-between items-center">
          <span>TRANSACTIONS LOG</span>
        </div>

        <div class="overflow-x-auto min-h-[350px]">
          <table class="w-full text-left text-xs border-collapse min-w-[800px]">
            <thead class="bg-white font-black text-[9px] text-black border-b-4 border-black">
              <tr>
                <th class="p-4 border-r-2 border-black tracking-widest">ORDER ID</th>
                <th class="p-4 border-r-2 border-black tracking-widest">DATE</th>
                <th class="p-4 border-r-2 border-black tracking-widest">CUSTOMER ID</th>
                <th class="p-4 border-r-2 border-black text-right tracking-widest">AMOUNT</th>
                <th class="p-4 border-r-2 border-black text-center tracking-widest">PAYMENT</th>
                <th class="p-4 text-center tracking-widest">DELIVERY</th>
              </tr>
            </thead>
            <tbody class="font-bold text-black text-[10px]">
              <?php if (empty($data['transactions'])): ?>
                <tr>
                  <td colspan="6" class="p-10 text-center font-black">NO TRANSACTION RECORDS DETECTED.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($data['transactions'] as $tx): ?>
                  <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                    <td class="p-4 border-r-2 border-black font-mono">
                      #<?= explode('-', $tx['invoice_number'])[2] ?? $tx['invoice_number'] ?>
                    </td>
                    <td class="p-4 border-r-2 border-black font-mono text-gray-600">
                      <?= date('Y-m-d', strtotime($tx['created_at'])) ?>
                    </td>
                    <td class="p-4 border-r-2 border-black truncate max-w-[120px]">
                      <?= htmlspecialchars($tx['customer_name']) ?>
                    </td>
                    <td class="p-4 border-r-2 border-black text-right text-sm font-black">
                      Rp <?= number_format((float)$tx['grand_total'], 0, ',', '.') ?>
                    </td>
                    <td class="p-4 border-r-2 border-black text-center">
                      <?php if ($tx['payment_status'] === 'paid'): ?>
                        <span class="bg-[#4ADE80] border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">COMPLETED</span>
                      <?php elseif ($tx['payment_status'] === 'pending'): ?>
                        <span class="bg-[#FFE600] border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">PENDING</span>
                      <?php else: ?>
                        <span class="bg-[#FF5757] text-white border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">FAILED</span>
                      <?php endif; ?>
                    </td>
                    <td class="p-4 text-center">
                      <?php
                      $del_bg = 'bg-white';
                      $del_text = 'text-black';
                      if ($tx['order_status'] === 'delivered') {
                        $del_bg = 'bg-gray-200';
                      } elseif (in_array($tx['order_status'], ['shipped', 'on_delivery'])) {
                        $del_bg = 'bg-[#FFE600]';
                      } elseif (in_array($tx['order_status'], ['pending', 'processing'])) {
                        $del_bg = 'bg-white';
                      } else {
                        $del_bg = 'bg-[#FF5757]';
                        $del_text = 'text-white';
                      }
                      ?>
                      <span class="<?= $del_bg ?> <?= $del_text ?> border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">
                        <?= strtoupper($tx['order_status']) ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php if ($totalPages > 1): ?>
          <div class="bg-gray-100 border-t-4 border-black p-4 flex justify-between items-center">
            <span class="text-[10px] font-black text-gray-600">VIEWING PAGE <?= $currentPage ?> OF <?= $totalPages ?></span>
            <div class="flex gap-2">
              <?php
              $params['page'] = $currentPage - 1;
              $prevUrl = BASEURL . '/pemilik/finance?' . http_build_query($params);

              $params['page'] = $currentPage + 1;
              $nextUrl = BASEURL . '/pemilik/finance?' . http_build_query($params);
              ?>

              <?php if ($currentPage > 1): ?>
                <a href="<?= $prevUrl ?>" class="ajax-link bg-white text-black border-2 border-black px-4 py-2 font-black text-[10px] hover:bg-black hover:text-white transition-colors shadow-[2px_2px_0_0_#000]">PREV</a>
              <?php else: ?>
                <button disabled class="bg-gray-200 text-gray-400 border-2 border-gray-400 px-4 py-2 font-black text-[10px] cursor-not-allowed">PREV</button>
              <?php endif; ?>

              <?php if ($currentPage < $totalPages): ?>
                <a href="<?= $nextUrl ?>" class="ajax-link bg-white text-black border-2 border-black px-4 py-2 font-black text-[10px] hover:bg-black hover:text-white transition-colors shadow-[2px_2px_0_0_#000]">NEXT</a>
              <?php else: ?>
                <button disabled class="bg-gray-200 text-gray-400 border-2 border-gray-400 px-4 py-2 font-black text-[10px] cursor-not-allowed">NEXT</button>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btnPdf = document.getElementById('btn-export-pdf');
    if (btnPdf) {
      btnPdf.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '<span class="animate-pulse">GENERATING PDF...</span>';

        let element = document.getElementById('report-content');

        let opt = {
          margin: 0.3,
          filename: 'TIMART_FINANCE_REPORT.pdf',
          image: {
            type: 'jpeg',
            quality: 0.98
          },
          html2canvas: {
            scale: 2
          },
          jsPDF: {
            unit: 'in',
            format: 'a4',
            orientation: 'landscape'
          }
        };

        html2pdf().set(opt).from(element).save().then(() => {
          this.innerHTML = originalText;
        });
      });
    }

    document.addEventListener('click', function(e) {
      const targetLink = e.target.closest('.ajax-link');

      if (targetLink) {
        e.preventDefault();
        const url = targetLink.getAttribute('href');
        const reportContent = document.getElementById('report-content');

        reportContent.style.opacity = '0.5';
        reportContent.style.pointerEvents = 'none';

        fetch(url)
          .then(response => response.text())
          .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.getElementById('report-content').innerHTML;

            reportContent.innerHTML = newContent;
            reportContent.style.opacity = '1';
            reportContent.style.pointerEvents = 'auto';

            window.history.pushState({
              path: url
            }, '', url);
          })
          .catch(err => {
            console.error('AJAX gagal, mengalihkan secara normal:', err);
            window.location.href = url;
          });
      }
    });

    window.addEventListener('popstate', function() {
      window.location.reload();
    });

  });
</script>