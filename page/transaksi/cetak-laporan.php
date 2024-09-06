<?php
require_once "vendor/autoload.php";
require_once "database/class/transaksi.php";

// Create new mPDF instance with specific margins
$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 25,
    'margin_right' => 25,
    'margin_top' => 60, // Adjusted top margin for header
    'margin_bottom' => 40, // Adjusted bottom margin for footer
    'margin_header' => 10, // Added margin for header
    'margin_footer' => 10, // Added margin for footer
]);

// Set header and footer
$mpdf->SetHeader('Laporan Transaksi Kasir|{PAGENO}|{DATE j-m-Y}');
$mpdf->SetFooter('Generated on {DATE j-m-Y H:i:s}|{PAGENO}|');

// Database connection and data retrieval
$pdo = koneksi::connect();
$tanggal = $_GET['tanggal'];
$transaksi = Transaksi::getInstance($pdo);
$datatransaksi = $transaksi->getAll();

// Define the HTML content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Kasir</title>
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        h4 {
            text-align: center;
            color: #2c3e50;
            font-size: 20px;
            margin: 0;
            padding: 10px;
            letter-spacing: 1px;
        }
        .report-date {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #fff;
            text-transform: uppercase;
            font-weight: 500;
        }
        td {
            font-size: 13px;
            color: #7f8c8d;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h4>Laporan Transaksi Kasir</h4>
    <p class="report-date">' . date("Y-m-d") . '</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Invoice</th>
                <th>Total Keseluruhan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>';

$i = 1;
foreach ($datatransaksi as $row) {
    $html .= '<tr>
        <td>' . $i . '</td>
        <td>' . htmlspecialchars($row["tanggal"]) . '</td>
        <td>' . htmlspecialchars($row["nama"]) . '</td>
        <td>' . htmlspecialchars($row["invoice"]) . '</td>
        <td>Rp ' . number_format($row["total_keseluruhan"], 0, ',', '.') . '</td>
        <td>' . htmlspecialchars($row["catatan"]) . '</td>
    </tr>';
    $i++;
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();
?>
