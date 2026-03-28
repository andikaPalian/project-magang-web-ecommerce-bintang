<?php

declare(strict_types=1);
class PemilikController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu.', '/login', 401);
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'pemilik'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini.', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Dashboard Pemilik | TI MART';
    $data['total_revenue'] = $this->model('PemilikModel')->getTotalRevenue();
    $data['revenue_growth'] = $this->model('PemilikModel')->getRevenueGrowth();
    $data['successful_sales'] = $this->model('PemilikModel')->getSuccessfulSales();
    $data['completion_rate'] = $this->model('PemilikModel')->getCompletionRate();
    $data['active_customers'] = $this->model('PemilikModel')->getActiveCustomers();
    $data['top_products'] = $this->model('PemilikModel')->getTopProducts();
    $data['revenue_trend'] = $this->model('PemilikModel')->getRevenueTrend30Days();
    $data['shipping_dist'] = $this->model('PemilikModel')->getShippingDistribution();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/index', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function finance(): void
  {
    $data['judul'] = 'Financial Reports | TI MART';

    $filters = [
      'date_range' => $_GET['date_range'] ?? 'ALL_TIME',
      'payment_status' => isset($_GET['date_range']) ? ($_GET['payment_status'] ?? []) : ['completed', 'pending']
    ];

    $totals = $this->model('PemilikModel')->getFinancialTotals($filters);
    $total_records = (int)($totals['total_transactions'] ?? 0);

    $limit = 5;
    $total_pages = $total_records > 0 ? ceil($total_records / $limit) : 1;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, min($page, $total_pages));
    $offset = ($page - 1) * $limit;

    $data['transactions'] = $this->model('PemilikModel')->getFinancialLogs($filters, $limit, $offset);

    $data['totals'] = $totals;
    $data['filters'] = $filters;
    $data['pagination'] = [
      'current_page' => $page,
      'total_pages' => $total_pages,
      'total_records' => $total_records
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/finance', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function radar(): void
  {
    $data['judul'] = 'Operational Radar | TI MART';

    $rawStats = $this->model('PemilikModel')->getRadarStats();

    $stats = [
      'pending' => 0,
      'processing' => 0,
      'on_delivery' => 0
    ];
    foreach ($rawStats as $row) {
      if ($row['order_status'] === 'pending') {
        $stats['pending'] += $row['total'];
      }
      if (in_array($row['order_status'], ['processing', 'ready_for_pickup'])) {
        $stats['processing'] += $row['total'];
      }
      if (in_array($row['order_status'], ['shipped', 'on_delivery'])) {
        $stats['on_delivery'] += $row['total'];
      }
    }

    $data['radar_stats'] = $stats;
    $data['fleets'] = $this->model('PemilikModel')->getFleetProductivity();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/radar', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function master_data(): void
  {
    $data['judul'] = 'Master Data | TI MART';
    $data['stocks'] = $this->model('PemilikModel')->getStockLevels();
    $data['accounts'] = $this->model('PemilikModel')->getAccountRegistry();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/master_data', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function exportExcel(): void
  {
    $filters = [
      'date_range' => $_GET['date_range'] ?? 'ALL_TIME',
      'payment_status' => isset($_GET['date_range']) ? ($_GET['payment_status'] ?? []) : ['completed', 'pending']
    ];

    $transactions = $this->model('PemilikModel')->getFinancialLogs($filters);

    require_once '../vendor/autoload.php';

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Finance_Report');

    $sheet->setCellValue('A1', 'SALES FINANCIAL REPORT - TI MART');
    $sheet->mergeCells('A1:F1');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $rowHeader = 3;
    $sheet->setCellValue('A' . $rowHeader, 'ORDER ID');
    $sheet->setCellValue('B' . $rowHeader, 'DATE');
    $sheet->setCellValue('C' . $rowHeader, 'CUSTOMER');
    $sheet->setCellValue('D' . $rowHeader, 'AMOUNT (Rp)');
    $sheet->setCellValue('E' . $rowHeader, 'PAYMENT STATUS');
    $sheet->setCellValue('F' . $rowHeader, 'DELIVERY STATUS');

    $styleHeader = [
      'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
      'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '000000']
      ],
      'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
    ];
    $sheet->getStyle("A$rowHeader:F$rowHeader")->applyFromArray($styleHeader);

    $rowData = 4;
    if (count($transactions) > 0) {
      foreach ($transactions as $tx) {
        $sheet->setCellValue('A' . $rowData, '#' . (explode('-', $tx['invoice_number'])[2] ?? $tx['invoice_number']));
        $sheet->setCellValue('B' . $rowData, date('Y-m-d', strtotime($tx['created_at'])));
        $sheet->setCellValue('C' . $rowData, $tx['customer_name']);
        $sheet->setCellValue('D' . $rowData, $tx['grand_total']);
        $sheet->setCellValue('E' . $rowData, strtoupper($tx['payment_status']));
        $sheet->setCellValue('F' . $rowData, strtoupper($tx['order_status']));
        $rowData++;
      }
    } else {
      $sheet->setCellValue('A' . $rowData, 'BELUM ADA DATA TRANSAKSI');
      $sheet->mergeCells("A$rowData:F$rowData");
      $sheet->getStyle('A' . $rowData)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $rowData++;
    }

    $lastRow = $rowData - 1;
    $styleData = [
      'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
    ];
    $sheet->getStyle("A$rowHeader:F$lastRow")->applyFromArray($styleData);

    foreach (range('A', 'F') as $col) {
      $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    ob_end_clean();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="TIMART_FINANCE_REPORT.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
  }
}
