<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8" data-aos="fade-down">
    <div>
      <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-1">DASHBOARD</h1>
      <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">
        Logged in as: <span class="text-[#2563EB]"><?= $_SESSION['role'] ?? 'ROOT' ?></span>
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between">
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2">TOTAL PENDAPATAN</h3>
      <div class="mt-2">
        <span class="text-4xl lg:text-5xl font-black text-black leading-none block mb-2">
          Rp <?= number_format($data['total_revenue'], 0, ',', '.') ?>
        </span>

        <?php $growth = $data['revenue_growth']['growth'];
        $isPos = $data['revenue_growth']['is_positive']; ?>
        <span class="text-[10px] font-black <?= $isPos ? 'text-[#4ADE80]' : 'text-[#FF5757]' ?> flex items-center">
          <?php if ($isPos): ?>
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            +<?= $growth ?>% VS LAST MONTH
          <?php else: ?>
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
            </svg>
            <?= $growth ?>% VS LAST MONTH
          <?php endif; ?>
        </span>
      </div>
    </div>

    <div class="bg-[#2563EB] text-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between">
      <h3 class="text-[10px] font-black tracking-widest text-blue-200 mb-2">PENJUALAN BERHASIL</h3>
      <div class="mt-2">
        <span class="text-5xl font-black leading-none block mb-2">
          <?= number_format($data['successful_sales'], 0, ',', '.') ?>
        </span>
        <span class="text-[10px] font-black text-white flex items-center">
          <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
          </svg>
          <?= $data['completion_rate'] ?>% COMPLETION RATE
        </span>
      </div>
    </div>

    <div class="bg-[#FFE600] text-black border-4 border-black shadow-[8px_8px_0_0_#000] p-6 flex flex-col justify-between">
      <h3 class="text-[10px] font-black tracking-widest text-gray-700 mb-2">CUSTOMER AKTIF</h3>
      <div class="mt-2">
        <span class="text-5xl font-black leading-none block mb-2">
          <?= number_format($data['active_customers'], 0, ',', '.') ?>
        </span>
        <span class="text-[10px] font-black text-black flex items-center">
          <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          (ROLE: PEMBELI)
        </span>
      </div>
    </div>

  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">

    <div class="lg:col-span-2 bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-sm font-black tracking-widest italic">STATISTIK PENJUALAN 30 HARI TERAKHIR</h3>
        <span class="text-[9px] font-black text-gray-500 flex items-center"><span class="w-3 h-3 bg-[#2563EB] mr-2 block"></span> PENJUALAN</span>
      </div>
      <div class="w-full h-64 relative">
        <?php if (empty($data['revenue_trend']['data'])): ?>
          <div class="absolute inset-0 flex items-center justify-center font-black text-gray-400">NO REVENUE DATA DETECTED IN THE LAST 30 DAYS</div>
        <?php endif; ?>
        <canvas id="revenueChart"></canvas>
      </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative flex flex-col">
      <h3 class="text-sm font-black tracking-widest italic mb-6">DISTRIBUSI PENGIRIMAN</h3>

      <div class="w-full flex-1 relative flex items-center justify-center min-h-[200px]">
        <?php if (empty($data['shipping_dist']['data'])): ?>
          <div class="absolute inset-0 flex items-center justify-center font-black text-[10px] text-gray-400">NO SHIPPING DATA</div>
        <?php endif; ?>
        <canvas id="shippingChart"></canvas>
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
          <div class="bg-white border-4 border-black px-2 py-3 text-center">
            <span class="text-[9px] font-black block">TOTAL PENGIRIMAN</span>
          </div>
        </div>
      </div>

      <div class="mt-6 flex flex-col gap-2">
        <?php
        $shipTotal = $data['shipping_dist']['total'] ?: 1;
        $colors = ['#2563EB', '#4ADE80', '#FFE600', '#FF5757', '#9333EA'];
        ?>
        <?php foreach ($data['shipping_dist']['raw'] as $index => $ship): ?>
          <?php
          $methodName = strtoupper($ship['shipping_method']);
          $percentage = round(($ship['total'] / $shipTotal) * 100);
          $color = $colors[$index % count($colors)];
          ?>
          <div class="flex justify-between text-[10px] font-black">
            <span class="flex items-center"><span class="w-3 h-3 mr-2 block" style="background-color: <?= $color ?>"></span> <?= $methodName ?></span>
            <span><?= $percentage ?>%</span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10">
    <div class="bg-black text-white font-black text-sm tracking-widest p-5 flex justify-between items-center">
      <span>PRODUK TERLARIS</span>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs border-collapse min-w-[800px]">
        <thead class="bg-white font-black text-[10px] text-black border-b-4 border-black">
          <tr>
            <th class="p-5 border-r-2 border-black w-32 tracking-widest">PRODUCT UID</th>
            <th class="p-5 border-r-2 border-black tracking-widest">PRODUCT NAME</th>
            <th class="p-5 border-r-2 border-black w-40 text-center tracking-widest">TOTAL SOLD</th>
            <th class="p-5 border-r-2 border-black w-48 text-right tracking-widest">TOTAL REVENUE</th>
            <th class="p-5 text-center w-32 tracking-widest">STATUS</th>
          </tr>
        </thead>
        <tbody class="font-bold text-black">
          <?php if (empty($data['top_products'])): ?>
            <tr>
              <td colspan="5" class="p-10 text-center">NO TOP PRODUCTS DATA DETECTED.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($data['top_products'] as $index => $product): ?>
              <tr class="border-b-4 border-black hover:bg-gray-50">
                <td class="p-5 border-r-2 border-black text-[10px] font-mono">#HW-<?= str_pad((string)($index + 1), 3, '0', STR_PAD_LEFT) ?></td>
                <td class="p-5 border-r-2 border-black text-sm font-black"><?= htmlspecialchars($product['name']) ?></td>
                <td class="p-5 border-r-2 border-black text-center text-lg font-black"><?= number_format((float)$product['total_sold'], 0, ',', '.') ?></td>
                <td class="p-5 border-r-2 border-black text-right text-sm font-black">Rp <?= number_format((float)$product['revenue_gen'], 0, ',', '.') ?></td>
                <td class="p-5 text-center">
                  <?php if ($product['is_active']): ?>
                    <span class="bg-[#4ADE80] border-2 border-black px-2 py-1 text-[9px] font-black shadow-[2px_2px_0_0_#000]">IN_STOCK</span>
                  <?php else: ?>
                    <span class="bg-[#FF5757] text-white border-2 border-black px-2 py-1 text-[9px] font-black shadow-[2px_2px_0_0_#000]">OFFLINE</span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const trendLabels = <?= json_encode($data['revenue_trend']['labels']) ?>;
    const trendData = <?= json_encode($data['revenue_trend']['data']) ?>;
    const shipLabels = <?= json_encode($data['shipping_dist']['labels']) ?>;
    const shipData = <?= json_encode($data['shipping_dist']['data']) ?>;
    const shipColors = ['#2563EB', '#4ADE80', '#FFE600', '#FF5757', '#9333EA'];

    if (document.getElementById('revenueChart') && trendData.length > 0) {
      const ctxLine = document.getElementById('revenueChart').getContext('2d');
      new Chart(ctxLine, {
        type: 'line',
        data: {
          labels: trendLabels,
          datasets: [{
            label: 'Gross Revenue (Rp)',
            data: trendData,
            borderColor: '#2563EB',
            borderWidth: 6,
            tension: 0,
            pointBackgroundColor: '#2563EB',
            pointBorderColor: '#000',
            pointBorderWidth: 3,
            pointRadius: 6,
            pointHoverRadius: 8
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              display: false,
              beginAtZero: true
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                font: {
                  family: 'monospace',
                  weight: 'bold',
                  size: 9
                },
                color: '#000'
              }
            }
          }
        }
      });
    }

    if (document.getElementById('shippingChart') && shipData.length > 0) {
      const ctxDoughnut = document.getElementById('shippingChart').getContext('2d');
      new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
          labels: shipLabels,
          datasets: [{
            data: shipData,
            backgroundColor: shipColors,
            borderColor: '#000000',
            borderWidth: 4,
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '60%',
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    }

  });
</script>