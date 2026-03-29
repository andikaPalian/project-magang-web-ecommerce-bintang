<?php
$revenue = (float)($data['stats']['total_revenue'] ?? 0);
$tx_count = (int)($data['stats']['total_transactions'] ?? 0);
$low_stocks = $data['low_stocks'] ?? [];
$low_stock_count = count($low_stocks);
?>

<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8" data-aos="fade-down">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-2">DASHBOARD</h1>
      <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">
        Logged in as: <span class="text-[#2563EB]"><?= $_SESSION['role'] ?? 'ROOT' ?></span>
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-[10px] font-black tracking-widest text-gray-500">TOTAL PENDAPATAN HARI INI</h3>
        <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-3">Rp <?= number_format($revenue, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-white bg-[#4ADE80] border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">+ REALTIME_SYNC</span>
      </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-[10px] font-black tracking-widest text-gray-500">TOTAL TRANSAKSI</h3>
        <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
      </div>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-3"><?= number_format($tx_count, 0, ',', '.') ?></span>
        <span class="text-[9px] font-black text-white bg-[#2563EB] border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">NORMAL LOAD</span>
      </div>
    </div>

    <div class="<?= $low_stock_count > 0 ? 'bg-[#FFE600]' : 'bg-white' ?> border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between transition-colors duration-300">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-[10px] font-black tracking-widest text-black">LOW STOCK PRODUCTS</h3>
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>
      <div>
        <span class="text-4xl font-black text-black leading-none block mb-3"><?= $low_stock_count ?></span>
        <a href="<?= BASEURL; ?>/admintoko/inventory" class="inline-block text-[9px] font-black text-white bg-black border-2 border-black px-3 py-1 shadow-[2px_2px_0_0_#000] hover:bg-[#FF5757] transition-colors cursor-pointer">
          <?= $low_stock_count > 0 ? 'CHECK INVENTORY' : 'NO PROBLEM' ?>
        </a>
      </div>
    </div>

  </div>

  <div class="flex flex-col lg:flex-row gap-8" data-aos="fade-up" data-aos-delay="100">

    <div class="w-full lg:w-2/3 flex flex-col gap-8">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col min-h-[350px]">
        <div class="flex justify-between items-end border-b-4 border-black pb-2 mb-6">
          <h2 class="text-xs font-black tracking-widest">TRAFFIC STATISTICS PENJUALAN HARI INI</h2>
        </div>
        <div class="flex-1 relative w-full">
          <canvas id="trafficChart"></canvas>
        </div>
      </div>
    </div>

    <div class="w-full lg:w-1/3 flex flex-col">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col h-full">

        <div class="p-4 border-b-4 border-black flex items-center justify-between shrink-0">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-xs font-black tracking-widest">RECENT SALES</h2>
          </div>
        </div>

        <div class="flex-1 overflow-y-auto p-5 flex flex-col gap-5 bg-[#F8F9FA]">

          <?php if (empty($data['recent_sales'])): ?>
            <div class="flex flex-col items-center justify-center h-full text-gray-400 mt-10">
              <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <p class="font-black text-[10px] tracking-widest text-center">AWAITING TRANSACTIONS...<br>NO DATA FOUND.</p>
            </div>
          <?php else: ?>
            <?php foreach ($data['recent_sales'] as $sale): ?>
              <div class="border-b-2 border-dashed border-gray-300 pb-4 last:border-0 last:pb-0">
                <div class="flex justify-between items-center mb-1">
                  <?php
                  $invoice_parts = explode('-', $sale['invoice_number']);
                  $short_invoice = end($invoice_parts);
                  ?>
                  <span class="text-[9px] font-mono font-black text-gray-500">TXN_ID: #<?= htmlspecialchars($short_invoice) ?></span>

                  <?php
                  $time_diff = time() - strtotime($sale['created_at']);
                  $time_display = ($time_diff < 300) ? 'JUST NOW' : date('H:i', strtotime($sale['created_at']));
                  ?>
                  <span class="text-[8px] font-bold text-gray-400"><?= $time_display ?></span>
                </div>
                <p class="text-[10px] font-black uppercase line-clamp-1 mb-1" title="<?= htmlspecialchars($sale['first_item_name'] ?? 'MULTIPLE_ITEMS') ?>">
                  <?= htmlspecialchars($sale['first_item_name'] ?? 'MULTIPLE_ITEMS') ?>
                </p>
                <p class="text-xs font-black text-[#2563EB]">Rp <?= number_format((float)$sale['grand_total'], 0, ',', '.') ?></p>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

        <a href="<?= BASEURL; ?>/admintoko/history" class="bg-gray-100 border-t-4 border-black p-4 text-center font-black text-[10px] hover:bg-[#2563EB] hover:text-white transition-colors cursor-pointer shrink-0 block">
          VIEW FULL HISTORY
        </a>
      </div>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const trafficCtx = document.getElementById('trafficChart');
    const dynamicTrafficData = <?= json_encode($data['traffic'] ?? [0, 0, 0, 0, 0, 0, 0]) ?>;
    const maxTrafficValue = Math.max(...dynamicTrafficData);
    const peakHourIndex = maxTrafficValue > 0 ? dynamicTrafficData.indexOf(maxTrafficValue) : -1;

    if (trafficCtx) {
      new Chart(trafficCtx.getContext('2d'), {
        type: 'bar',
        data: {
          labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'],
          datasets: [{
            label: 'Total Transactions',
            data: dynamicTrafficData,
            backgroundColor: function(context) {
              return context.dataIndex === peakHourIndex ? '#4ADE80' : '#2563EB';
            },
            borderColor: '#000000',
            borderWidth: 4,
            borderRadius: 0,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: '#000',
              titleFont: {
                family: 'monospace',
                size: 10
              },
              bodyFont: {
                family: 'monospace',
                size: 12,
                weight: 'bold'
              },
              cornerRadius: 0,
              displayColors: false,
              callbacks: {
                label: function(context) {
                  return context.parsed.y + ' Transactions';
                }
              }
            }
          },
          scales: {
            y: {
              display: false,
              beginAtZero: true,
              suggestedMax: maxTrafficValue > 0 ? maxTrafficValue + 2 : 10
            },
            x: {
              grid: {
                color: '#000',
                drawBorder: true,
                tickLength: 10,
                lineWidth: 2
              },
              ticks: {
                font: {
                  family: 'monospace',
                  weight: 'bold',
                  size: 10
                },
                color: '#000'
              }
            }
          }
        }
      });
    }
  });
</script>