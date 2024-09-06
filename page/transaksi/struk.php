<?php
// Ensure the necessary classes and libraries are included
require_once "vendor/autoload.php"; // Ensure mPDF is installed via composer
require_once "database/class/cetak.php"; // The Cetak class for database access

// Get the necessary parameters from the URL (GET method)
$id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : null;
// $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;

// Ensure both 'id_transaksi' and 'tanggal' are provided
// if (!$id_transaksi || !$tanggal) {
    // die("Transaction ID or Date is missing.");
// }

// Initialize the database connection and the Cetak class
$pdo = koneksi::connect(); // Assuming koneksi::connect() returns a PDO instance
$transaksi = Cetak::getInstance($pdo);

// Fetch the transaction details for the given transaction ID
$dataTransaksi = $transaksi->getTransactionById($id_transaksi); // Custom method to fetch by transaction ID
if (!$dataTransaksi || count($dataTransaksi) == 0) {
    die("No transaction found for the provided ID.");
}

// Generate a new invoice code
$invoice = $transaksi->generateKodeNota();

// Create new mPDF instance for receipt format
$mpdf = new \Mpdf\Mpdf(['format' => [80, 200]]); // Narrow width for receipt

// Start building the HTML content for the PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 10px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .container {
            padding: 10px;
            width: 100%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }
        .header h2 {
            margin: 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 4px 0;
        }
        th {
            border-bottom: 1px dashed #000;
        }
        .totals th, .totals td {
            padding-top: 5px;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-style: italic;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Struk Transaksi</h2>
            <p>Tanggal: ' . htmlspecialchars($tanggal) . '</p>
            <p>Invoice: ' . htmlspecialchars($invoice) . '</p>
            <p>ID Transaksi: ' . htmlspecialchars($dataTransaksi[0]["id_transaksi"]) . '</p>
        </div>
        <table>
            <tbody>';

// Loop through the transaction details to display each item
foreach ($dataTransaksi as $row) {
    $html .= '
                <tr>
                    <td colspan="2">' . htmlspecialchars($row["nama_barang"]) . '</td>
                </tr>
                <tr>
                    <td>' . htmlspecialchars($row["qty"]) . ' x Rp. ' . number_format($row["harga"], 0, ",", ".") . '</td>
                    <td style="text-align:right;">Rp. ' . number_format($row["qty"] * $row["harga"], 0, ",", ".") . '</td>
                </tr>';
}

// Close the table and add totals
$html .= '
            </tbody>
        </table>
        <table class="totals">
            <tr>
                <th>Subtotal:</th>
                <td>Rp.' . number_format($dataTransaksi[0]["subtotal"], 0, ",", ".") . '</td>
            </tr>
            <tr>
                <th>Diskon:</th>
                <td>Rp.' . number_format($dataTransaksi[0]["diskon"], 0, ",", ".") . '</td>
            </tr>
            <tr>
                <th>Total Harga:</th>
                <td>Rp.' . number_format($dataTransaksi[0]["total_harga"], 0, ",", ".") . '</td>
            </tr>
            <tr>
                <th>Bayar:</th>
                <td>Rp.' . number_format($dataTransaksi[0]["nominal"], 0, ",", ".") . '</td>
            </tr>
            <tr>
                <th>Kembalian:</th>
                <td>Rp.' . number_format($dataTransaksi[0]["kembalian"], 0, ",", ".") . '</td>
            </tr>
        </table>
        <div class="footer">
            <p>Terima kasih telah berbelanja!</p>
        </div>
    </div>
</body>
</html>';

// Output the HTML as a PDF
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
