<div class="mb-8" data-aos="fade-in">
  <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-1">DASHBOARD</h1>
  <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">
    Logged in as: <span class="text-[#2563EB]"><?= $_SESSION['role'] ?? 'ROOT' ?></span>
  </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000]">
    <div class="flex justify-between items-start mb-4">
      <p class="text-[10px] font-black uppercase text-gray-500 tracking-widest">TOTAL PRODUCTS</p>
    </div>
    <div class="flex items-end justify-between">
      <h3 class="text-4xl font-black leading-none"><?= $data['total_produk'] ?? 0; ?></h3>
      <span class="bg-[#A6FAAE] border-2 border-black px-2 py-0.5 text-[10px] font-black shadow-[2px_2px_0_0_#000]">+12%</span>
    </div>
  </div>

  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000]">
    <div class="flex justify-between items-start mb-4">
      <p class="text-[10px] font-black uppercase text-gray-500 tracking-widest">TOTAL USERS</p>
    </div>
    <div class="flex items-end justify-between">
      <h3 class="text-4xl font-black leading-none"><?= $data['total_user'] ?? 0; ?></h3>
      <span class="bg-[#A6FAAE] border-2 border-black px-2 py-0.5 text-[10px] font-black shadow-[2px_2px_0_0_#000]">+5%</span>
    </div>
  </div>

  <div class="bg-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000]">
    <div class="flex justify-between items-start mb-4">
      <p class="text-[10px] font-black uppercase text-gray-500 tracking-widest">TOTAL ARTICLES</p>
    </div>
    <div class="flex items-end justify-between">
      <h3 class="text-4xl font-black leading-none"><?= $data['total_artikel'] ?? 0; ?></h3>
      <span class="bg-[#FF5757] text-white border-2 border-black px-2 py-0.5 text-[10px] font-black shadow-[2px_2px_0_0_#000]">-2%</span>
    </div>
  </div>

  <div class="bg-[#2563EB] text-white border-4 border-black p-5 shadow-[6px_6px_0_0_#000]">
    <div class="flex justify-between items-start mb-4">
      <p class="text-[10px] font-black uppercase text-white tracking-widest">TODAY'S REVENUE</p>
    </div>
    <div class="flex items-end justify-between">
      <h3 class="text-3xl lg:text-4xl font-black leading-none line-clamp-1 truncate">Rp <?= number_format($data['revenue_hari_ini'] ?? 0, 0, ',', '.'); ?></h3>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

  <div class="lg:col-span-2 bg-white border-4 border-black p-6 shadow-[8px_8px_0_0_#000]">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-xl font-black uppercase tracking-tight">SALES ANALYTICS</h3>
      <div class="flex space-x-2">
        <button class="border-2 border-black px-3 py-1 text-xs font-black uppercase bg-black text-white shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 transition-transform">7 DAYS</button>
      </div>
    </div>
    <div class="w-full h-[250px]">
      <canvas id="salesChart"></canvas>
    </div>
  </div>

  <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0_0_#000] flex flex-col">
    <h3 class="text-xl font-black uppercase tracking-tight mb-6">SYSTEM STATUS</h3>
    <div class="space-y-6 flex-1">

      <?php if (empty($data['system_logs'])): ?>
        <p class="text-xs font-bold text-gray-500 uppercase">NO SYSTEM LOGS RECORDED.</p>
      <?php else: ?>
        <?php
        // Array warna brutalism untuk indikator log
        $colors = ['bg-[#A6FAAE]', 'bg-[#2563EB]', 'bg-[#FFE600]', 'bg-[#FF5757]'];
        foreach ($data['system_logs'] as $index => $log):
          $waktu = date('d M Y, H:i', strtotime($log['created_at']));
          $warna = $colors[$index % count($colors)];
        ?>
          <div class="flex items-start">
            <div class="w-3 h-3 <?= $warna ?> border-2 border-black mt-1 mr-3 shrink-0"></div>
            <div>
              <p class="text-xs font-black uppercase line-clamp-1"><?= htmlspecialchars($log['title']) ?></p>
              <p class="text-[10px] font-bold text-gray-500 mt-0.5"><?= $waktu ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
    <button class="w-full mt-6 border-4 border-black bg-white text-black py-2.5 text-xs font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 active:shadow-none transition-all">VIEW ALL LOGS</button>
  </div>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-hidden mb-10">
  <div class="p-6 border-b-4 border-black flex flex-wrap gap-4 justify-between items-center">
    <h3 class="text-xl font-black uppercase tracking-tight">RECENT ACTIVITY (ORDERS)</h3>
    <button class="border-4 border-black bg-white px-4 py-2 text-xs font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 active:shadow-none transition-all">FILTER_DATA</button>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse min-w-[600px]">
      <thead>
        <tr class="bg-[#F8F9FA] border-b-4 border-black text-xs font-black uppercase tracking-widest">
          <th class="p-4 border-r-4 border-black">REFERENCE (INV)</th>
          <th class="p-4 border-r-4 border-black">USER</th>
          <th class="p-4 border-r-4 border-black text-center">STATUS</th>
          <th class="p-4">TIME</th>
        </tr>
      </thead>
      <tbody class="text-sm font-bold">
        <?php if (empty($data['recent_orders'])): ?>
          <tr>
            <td colspan="4" class="p-4 text-center text-gray-500 uppercase font-black">NO RECENT TRANSACTIONS</td>
          </tr>
        <?php else: ?>
          <?php foreach ($data['recent_orders'] as $order):
            $statusColor = 'bg-[#90E0FF] text-black';
            if ($order['order_status'] == 'completed' || $order['order_status'] == 'delivered' || $order['order_status'] == 'shipped') {
              $statusColor = 'bg-[#A6FAAE] text-black';
            }
            if ($order['order_status'] == 'cancelled' || $order['order_status'] == 'failed') {
              $statusColor = 'bg-[#FF5757] text-white';
            }
          ?>
            <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors">
              <td class="p-4 border-r-4 border-black text-gray-500"><?= $order['invoice_number'] ?></td>
              <td class="p-4 border-r-4 border-black text-black"><?= htmlspecialchars($order['user_name']) ?></td>
              <td class="p-4 border-r-4 border-black text-center">
                <span class="<?= $statusColor ?> border-2 border-black px-2 py-1 text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000]"><?= str_replace('_', ' ', $order['order_status']) ?></span>
              </td>
              <td class="p-4 text-gray-500 text-xs"><?= date('H:i:s / d-M', strtotime($order['created_at'])) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');

    const dataPenjualan = <?= !empty($data['chart_data']['data']) ? json_encode($data['chart_data']['data']) : '[0,0,0,0,0,0,0]' ?>;
    const labelHari = <?= !empty($data['chart_data']['labels']) ? json_encode($data['chart_data']['labels']) : '["MON","TUE","WED","THU","FRI","SAT","SUN"]' ?>;

    const barColors = ['#E5E7EB', '#2563EB', '#E5E7EB', '#2563EB', '#E5E7EB', '#2563EB', '#E5E7EB'];

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labelHari,
        datasets: [{
          label: 'Revenue (Rp)',
          data: dataPenjualan,
          backgroundColor: barColors,
          borderColor: '#000000',
          borderWidth: 3,
          borderRadius: 0,
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
              display: false,
              drawBorder: true,
              borderColor: '#000',
              borderWidth: 4
            },
            ticks: {
              font: {
                family: "'Inter', sans-serif",
                weight: '900',
                size: 10
              },
              color: '#000'
            }
          }
        }
      }
    });
  });
</script>