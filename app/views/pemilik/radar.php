<div class="p-6 sm:p-10 w-full min-h-screen bg-[#F8F9FA] text-black font-sans uppercase tracking-widest relative">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-4 border-black pb-4 mb-8" data-aos="fade-down">
    <div>
      <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-1">OPERATIONAL RADAR</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Pantau status operasional pengiriman secara real-time. Lihat jumlah pesanan yang sedang diproses, dalam pengiriman, dan menunggu penanganan.
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between relative overflow-hidden">
      <div class="absolute -right-4 -top-4 w-16 h-16 bg-[#FF5757] rounded-full border-4 border-black"></div>
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2 relative z-10">PENDING ORDERS</h3>
      <div class="relative z-10">
        <span class="text-5xl font-black text-black leading-none block mb-2">
          <?= number_format($data['radar_stats']['pending'], 0, ',', '.') ?>
        </span>
        <span class="text-[9px] font-black text-[#FF5757]">WAITING FOR PROCESSING</span>
      </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between relative overflow-hidden">
      <div class="absolute -right-4 -top-4 w-16 h-16 bg-[#FFE600] rounded-full border-4 border-black"></div>
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2 relative z-10">PROCESSING ORDERS</h3>
      <div class="relative z-10">
        <span class="text-5xl font-black text-black leading-none block mb-2">
          <?= number_format($data['radar_stats']['processing'], 0, ',', '.') ?>
        </span>
        <span class="text-[9px] font-black text-[#2563EB]">BEING PACKED / READY PICKUP</span>
      </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-6 flex flex-col justify-between relative overflow-hidden">
      <div class="absolute -right-4 -top-4 w-16 h-16 bg-[#4ADE80] rounded-full border-4 border-black"></div>
      <h3 class="text-[10px] font-black tracking-widest text-gray-500 mb-2 relative z-10">ON DELIVERY ORDERS</h3>
      <div class="relative z-10">
        <span class="text-5xl font-black text-black leading-none block mb-2">
          <?= number_format($data['radar_stats']['on_delivery'], 0, ',', '.') ?>
        </span>
        <span class="text-[9px] font-black text-[#4ADE80]">IN TRANSIT TO CUSTOMER</span>
      </div>
    </div>

  </div>

  <div class="flex flex-col lg:flex-row gap-8" data-aos="fade-up" data-aos-delay="100">

    <div class="w-full lg:w-1/2 flex flex-col gap-4">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 h-full flex flex-col">
        <div class="flex items-center justify-between mb-6 border-b-4 border-black pb-4">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h2 class="text-sm font-black tracking-widest">COURIER PERFORMANCE STATISTICS</h2>
          </div>
          <span class="text-[9px] bg-[#2563EB] text-white px-2 py-1 border-2 border-black font-black">COMPLETED ONLY</span>
        </div>

        <div class="w-full flex-1 min-h-[300px] relative">
          <?php if (empty($data['fleets'])): ?>
            <div class="absolute inset-0 flex items-center justify-center font-black text-[10px] text-gray-400">NO COURIER DATA DETECTED</div>
          <?php endif; ?>
          <canvas id="fleetChart"></canvas>
        </div>
      </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col gap-4">
      <div class="flex-1 bg-white border-4 border-black shadow-[8px_8px_0_0_#000] flex flex-col relative z-10 overflow-hidden">

        <div class="bg-black text-white font-black text-[10px] tracking-widest p-4 flex justify-between items-center">
          <span>COURIER LIST</span>
        </div>

        <div class="overflow-x-auto min-h-[300px]">
          <table class="w-full text-left text-xs border-collapse">
            <thead class="bg-white font-black text-[9px] text-black border-b-4 border-black">
              <tr>
                <th class="p-4 border-r-2 border-black tracking-widest w-24">COURIER ID</th>
                <th class="p-4 border-r-2 border-black tracking-widest">COURIER NAME</th>
                <th class="p-4 text-center tracking-widest w-32">DELIVERIES</th>
              </tr>
            </thead>
            <tbody class="font-bold text-black text-[10px]">
              <?php if (empty($data['fleets'])): ?>
                <tr>
                  <td colspan="3" class="p-10 text-center font-black">NO COURIER DATA DETECTED.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($data['fleets'] as $fleet): ?>
                  <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                    <td class="p-4 border-r-2 border-black font-mono">
                      #CR-<?= str_pad((string)$fleet['id'], 3, '0', STR_PAD_LEFT) ?>
                    </td>
                    <td class="p-4 border-r-2 border-black truncate max-w-[150px]">
                      <?= htmlspecialchars($fleet['name']) ?>
                    </td>
                    <td class="p-4 text-center text-sm font-black">
                      <?php
                      $completed = (int)$fleet['total_completed'];
                      $badgeColor = $completed > 10 ? 'bg-[#4ADE80]' : ($completed > 0 ? 'bg-[#FFE600]' : 'bg-gray-200');
                      ?>
                      <span class="<?= $badgeColor ?> border-2 border-black px-2 py-1 shadow-[2px_2px_0_0_#000]">
                        <?= $completed ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php
    $fleetNames = [];
    $fleetCompletions = [];
    foreach ($data['fleets'] as $fleet) {
      $fleetNames[] = $fleet['name'];
      $fleetCompletions[] = (int)$fleet['total_completed'];
    }
    ?>

    const fleetLabels = <?= json_encode($fleetNames) ?>;
    const fleetData = <?= json_encode($fleetCompletions) ?>;

    if (document.getElementById('fleetChart') && fleetData.length > 0) {
      const ctxBar = document.getElementById('fleetChart').getContext('2d');
      new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: fleetLabels,
          datasets: [{
            label: 'Completed Drops',
            data: fleetData,
            backgroundColor: '#2563EB',
            borderColor: '#000000',
            borderWidth: 4,
            hoverBackgroundColor: '#FFE600'
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
                size: 12
              },
              bodyFont: {
                family: 'monospace',
                size: 14,
                weight: 'bold'
              },
              padding: 10,
              cornerRadius: 0,
              displayColors: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: '#e5e7eb',
                tickLength: 0
              },
              ticks: {
                font: {
                  family: 'monospace',
                  weight: 'bold',
                  size: 10
                },
                color: '#000',
                stepSize: 1
              }
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
  });
</script>