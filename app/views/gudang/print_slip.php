<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['judul'] ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap');

    body {
      font-family: 'Courier Prime', monospace;
    }

    @media print {
      .no-print {
        display: none !important;
      }

      body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }

    .stamp {
      transform: rotate(-15deg);
      display: inline-block;
    }
  </style>
</head>

<body class="bg-gray-100 text-black p-8 text-xs sm:text-sm">

  <div class="bg-white border-8 border-black max-w-4xl mx-auto p-8 shadow-[12px_12px_0_0_#000] print:border-0 print:shadow-none print:p-0">

    <div class="flex justify-between items-start border-b-4 border-black pb-4 mb-6">
      <div>
        <h1 class="text-4xl font-black tracking-tighter mb-2 uppercase">SLIP ORDER</h1>
        <span class="bg-black text-white font-black text-xl px-4 py-1 uppercase">
          #<?= explode('-', $data['order']['invoice_number'])[2] ?? $data['order']['invoice_number'] ?>
        </span>
      </div>
      <div class="text-right flex flex-col items-end">
        <p class="text-[10px] font-black uppercase mb-1">BARCODE</p>
        <div class="flex h-12 bg-black w-48 mb-1" style="background: repeating-linear-gradient(90deg, #000, #000 2px, #fff 2px, #fff 4px, #000 4px, #000 8px, #fff 8px, #fff 10px);"></div>
        <p class="text-[8px] font-bold"><?= $data['order']['invoice_number'] ?></p>
      </div>
    </div>

    <div class="flex flex-col md:flex-row gap-6 mb-8 uppercase">

      <div class="flex-1 border-2 border-black p-4">
        <p class="text-[10px] text-gray-500 font-bold mb-3">ORDER INFORMATION</p>
        <table class="w-full text-xs font-bold">
          <tr>
            <td class="pb-2 w-32">ORDER DATE:</td>
            <td class="pb-2"><?= date('Y-M-d', strtotime($data['order']['created_at'])) ?></td>
          </tr>
          <tr>
            <td class="pb-2">WAREHOUSE:</td>
            <td class="pb-2">TI_MART_HQ_01</td>
          </tr>
          <tr>
            <td class="pb-2">STATION:</td>
            <td class="pb-2">STATION_04</td>
          </tr>
          <tr>
            <td>PICKER ID:</td>
            <td><?= $_SESSION['name'] ?? 'ROOT_USR' ?></td>
          </tr>
        </table>
      </div>

      <div class="flex-1 border-2 border-black p-4">
        <p class="text-[10px] font-bold mb-3 flex items-center">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          SHIP TO
        </p>
        <h2 class="font-black text-lg mb-1 leading-tight"><?= htmlspecialchars($data['order']['recipient_name']) ?></h2>
        <p class="font-bold text-xs leading-relaxed mb-3 whitespace-pre-line">
          <?= htmlspecialchars($data['order']['shipping_address']) ?>
        </p>
        <p class="font-bold text-xs border-t-2 border-dashed border-black pt-2">
          CONTACT: <?= htmlspecialchars($data['order']['recipient_phone']) ?>
        </p>
      </div>

    </div>

    <div class="mb-8">
      <div class="bg-black text-white px-3 py-2 flex justify-between font-black uppercase text-xs">
        <span>LIST OF ITEMS</span>
        <span>COUNT: <?= str_pad((string)count($data['items']), 2, '0', STR_PAD_LEFT) ?> ITEMS</span>
      </div>
      <table class="w-full text-left uppercase border-b-4 border-black">
        <thead class="text-[10px] font-black border-b-2 border-black">
          <tr>
            <th class="py-3 px-2 w-32">SKU ID</th>
            <th class="py-3 px-2">PRODUCT NAME</th>
            <th class="py-3 px-2 w-16 text-center">QTY</th>
            <th class="py-3 px-2 w-32 text-right">ROUTING</th>
          </tr>
        </thead>
        <tbody class="font-bold text-xs">
          <?php
          $total_weight_grams = 0;
          foreach ($data['items'] as $item):
            $total_weight_grams += ($item['weight_grams'] * $item['quantity']);
          ?>
            <tr class="border-b border-gray-300 border-dashed">
              <td class="py-3 px-2 text-gray-600">PRD-<?= str_pad((string)$item['product_id'], 4, '0', STR_PAD_LEFT) ?></td>
              <td class="py-3 px-2 font-black text-sm"><?= htmlspecialchars($item['product_name']) ?></td>
              <td class="py-3 px-2 text-center text-lg font-black"><?= str_pad((string)$item['quantity'], 2, '0', STR_PAD_LEFT) ?></td>
              <td class="py-3 px-2 text-right">
                <span class="bg-[#2563EB] text-white px-2 py-1 text-[9px]">ZONE_A</span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="flex justify-between items-end uppercase pt-4">

      <div class="border-2 border-black p-4 w-64 h-32 relative flex flex-col justify-between">
        <p class="text-[8px] font-black">PICKER SIGNATURE</p>
        <div class="border-b border-black mb-2"></div>
        <p class="text-[7px] text-gray-500">SIGN BY: <?= $_SESSION['name'] ?? 'ROOT_USR' ?></p>
      </div>

      <?php $total_weight_kg = number_format($total_weight_grams / 1000, 2); ?>
      <div class="border-2 border-black p-4 w-64 text-center">
        <p class="text-[9px] font-black mb-2">WEIGHT VERIFICATION</p>
        <p class="text-3xl font-black mb-1"><?= $total_weight_kg ?> KG</p>
        <p class="text-[8px] font-bold">SENS_04_CONFIRMED</p>
      </div>

      <div class="flex flex-col items-end w-64">
        <div class="stamp border-4 border-[#2563EB] text-[#2563EB] font-black text-xl px-4 py-1 mb-6 mr-4 opacity-80">
          SYSTEM_VERIFIED
        </div>

        <div class="text-right w-full">
          <p class="text-[7px] text-gray-400 mb-1">FILE: PRINT_PACKING_SLIP.SH // VERSION: 4.0.2</p>
          <p class="text-[7px] text-gray-400 mb-4">GEN_TIME: <?= date('H:i:s') ?>_WITA</p>

          <button onclick="window.print()" class="no-print w-full bg-black text-white py-3 font-black text-xs hover:bg-gray-800 flex items-center justify-center transition-colors">
            PRINT_COMMAND.EXE
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
          </button>
        </div>
      </div>

    </div>

  </div>

  <div class="text-center mt-6 no-print">
    <button onclick="window.close()" class="text-sm font-bold text-gray-500 hover:text-black underline uppercase">
      &lt; RETURN TO DASHBOARD
    </button>
  </div>

  <script>
    window.onload = function() {
      setTimeout(() => {
        window.print();
      }, 500);
    }
  </script>
</body>

</html>