<?php                

require_once '../includes/db_config.php';
require_once '../includes/environment.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($env == 'd') {
    $file_location = $_SERVER['DOCUMENT_ROOT'] . "autoservice/uploads/invoices/";
} else {
    $file_location = $_SERVER['DOCUMENT_ROOT'] . "uploads/invoices/";
}

$curr_emp = $_SESSION["user_emp_name"] ?? '';

$datetime  = date('dmY_hms');
$file_name = "INV_" . $datetime . ".pdf";
ob_end_clean();

$jcId = (int)$JobCardID;

// ── Fetch real job_card_code from DB ──────────────────────────────────────────
$jc_code_result    = $conn->query("SELECT job_card_code FROM job_card WHERE id = $jcId");
$jc_code_row       = $jc_code_result ? $jc_code_result->fetch_assoc() : [];
$real_jobcard_code = $jc_code_row['job_card_code'] ?? $jobcardcode ?? '';

// ── Build PDF ─────────────────────────────────────────────────────────────────
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();

$content  = '';
$content .= '
<style type="text/css">
* { margin:0; padding:0; }
body {
    font-size: 11px;
    line-height: 24px;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    color: #000;
}
table.table, th, table.table td {
    border: 1px solid black;
    padding: 5px;
}
.invoice {
    background-color: #ffffff;
    border-radius: 10px;
    max-width: 800px;
    margin: 0 auto;
}
</style>

<div class="invoice">

<table style="width:100%;">
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="5" align="center">
        <img width="50" height="50" src="../uploads/stations/' . $data_station[0]["logo"] . '">
    </td></tr>
    <tr><td colspan="2" align="center"><b>' . htmlspecialchars($data_station[0]["service_name"]) . '</b></td></tr>
    <tr><td colspan="2" align="center">ADDRESS: ' . htmlspecialchars($data_station[0]["address"] . ' ' . $data_station[0]["street"] . ' ' . $data_station[0]["city"]) . '</td></tr>
    <tr><td colspan="2" align="center">CONTACT: ' . htmlspecialchars($data_station[0]["phone"]) . '</td></tr>
    <tr><td colspan="2" align="center">EMAIL: ' . htmlspecialchars($data_station[0]["email"]) . '</td></tr>
    <tr><td colspan="2" align="center"><b>Invoice</b></td></tr>
</table>

<p>------------------------------------------------------------------------------------------------------------------------------</p>

<table style="width:100%;">
    <tr>
        <td><b>JOB CARD NO</b>: ' . htmlspecialchars($real_jobcard_code) . '</td>
        <td align="right"><b>INVOICE NO</b>: ' . htmlspecialchars($jobcardInvoicecode) . '</td>
    </tr>
    <tr>
        <td><b>CUSTOMER NAME</b>: ' . htmlspecialchars($data_vehicle[0]["first_name"] . ' ' . $data_vehicle[0]["last_name"]) . '</td>
        <td align="right"><b>INVOICE DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>ADDRESS</b>: ' . htmlspecialchars($data_vehicle[0]["address"]) . '</td>
        <td align="right"><b>VEHICLE NO</b>: ' . htmlspecialchars($data_vehicle[0]["vehicle_number"]) . '</td>
    </tr>
    <tr>
        <td><b>CONTACT NO</b>: ' . htmlspecialchars($data_vehicle[0]["phone"]) . '</td>
        <td align="right"><b>OPENING DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>VAT (%)</b>: ' . htmlspecialchars($vat) . '</td>
        <td align="right"><b>CLOSING DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>MODEL</b>: ' . htmlspecialchars($data_vehicle[0]["vehicle_model_name"] ?? '') . '</td>
        <td align="right"><b>NXT SERV. MILEAGE</b>: N/A</td>
    </tr>
    <tr>
        <td><b>MAKE</b>: ' . htmlspecialchars($data_vehicle[0]["vehicle_make_name"] ?? '') . '</td>
        <td align="right"><b>CHASSIS NO</b>: ' . htmlspecialchars($data_vehicle[0]["chassis_number"]) . '</td>
    </tr>
    <tr>
        <td><b>CURRENT MILEAGE</b>: ' . htmlspecialchars($data_vehicle[0]["current_mileage"] ?? 'N/A') . ' KM</td>
        <td align="right"><b>ENGINE NO</b>: ' . htmlspecialchars($data_vehicle[0]["engine_number"]) . '</td>
    </tr>
    <tr>
        <td><b>EMPLOYEE NAME</b>: ' . htmlspecialchars($curr_emp) . '</td>
        <td align="right"><b>JOB CARD TYPE</b>: REPAIR ONLY</td>
    </tr>
</table>

<p>------------------------------------------------------------------------------------------------------------------------------</p>

<table class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th>Code</th>
            <th>Item Description</th>
            <th>QTY / Labour Hr</th>
            <th>Unit Price (LKR)</th>
            <th>Discount (LKR)</th>
            <th>Total (LKR)</th>
        </tr>
    </thead>
    <tbody>';

$subTotal = 0.0;

// ── Repairs ───────────────────────────────────────────────────────────────────
foreach ($data_repairs as $row) {
    $total     = floatval($row['total']);
    $subTotal += $total;
    $content  .= '
        <tr>
            <td>' . htmlspecialchars($row['repairCode']) . '</td>
            <td class="text-uppercase">' . htmlspecialchars($row['repairName']) . '</td>
            <td>' . htmlspecialchars($row['hours']) . '</td>
            <td>' . number_format(floatval($row['price']),    2) . '</td>
            <td>' . number_format(floatval($row['discount']), 2) . '</td>
            <td>' . number_format($total,                     2) . '</td>
        </tr>';
}

// ── Products ──────────────────────────────────────────────────────────────────
foreach ($data_products as $row) {
    $total     = floatval($row['total']);
    $subTotal += $total;
    $content  .= '
        <tr>
            <td>' . htmlspecialchars($row['productCode']) . '</td>
            <td class="text-uppercase">' . htmlspecialchars($row['productName']) . '</td>
            <td>' . htmlspecialchars($row['qty']) . '</td>
            <td>' . number_format(floatval($row['price']),    2) . '</td>
            <td>' . number_format(floatval($row['discount']), 2) . '</td>
            <td>' . number_format($total,                     2) . '</td>
        </tr>';
}

// ── Totals ────────────────────────────────────────────────────────────────────
$vatAmount   = $subTotal * floatval($vat) / 100;
$totalAmount = $subTotal + $vatAmount;

$content .= '
    </tbody>
</table>

<table style="width:100%;">
    <tr><td align="right"><b>Subtotal:</b> LKR ' . number_format($subTotal,   2) . '</td></tr>
    <tr><td align="right"><b>VAT (' . htmlspecialchars($vat) . '%):</b> LKR ' . number_format($vatAmount,   2) . '</td></tr>
    <tr><td align="right"><b>Total Amount:</b> LKR ' . number_format($totalAmount, 2) . '</td></tr>
</table>

</div>';

$pdf->writeHTML($content);
$pdf->Output($file_location . $file_name, 'F');

// Send Email
$email_invoice_path = $file_location . $file_name;
require_once '../api/send-email-invoice.php';
?>