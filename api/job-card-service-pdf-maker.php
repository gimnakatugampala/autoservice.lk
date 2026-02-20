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

// ── Fetch real job_card_code ───────────────────────────────────────────
$jc_code_result    = $conn->query("SELECT job_card_code FROM job_card WHERE id = $jcId");
$jc_code_row       = $jc_code_result ? $jc_code_result->fetch_assoc() : [];
$real_jobcard_code = $jc_code_row['job_card_code'] ?? $jobcardcode ?? '';

// ── Fetch ALL items from all 5 tables ─────────────────────────────────

$items = [];

// 1. Washers
$r = $conn->query("
    SELECT w.code AS item_code, 'Car Wash' AS item_name,
           jcw.qty, jcw.price AS unit_price, jcw.discount
    FROM job_card_washer jcw
    INNER JOIN washers w ON jcw.washer_id = w.id
    WHERE jcw.job_card_id = $jcId
");
if ($r) while ($row = $r->fetch_assoc()) $items[] = $row;

// 2. Products
$r = $conn->query("
    SELECT p.code AS item_code, p.product_name AS item_name,
           jcp.qty, jcp.price AS unit_price, jcp.discount
    FROM job_card_products jcp
    INNER JOIN product p ON jcp.product_id = p.id
    WHERE jcp.job_card_id = $jcId
");
if ($r) while ($row = $r->fetch_assoc()) $items[] = $row;

// 3. Repairs / Labour
$r = $conn->query("
    SELECT r.code AS item_code, r.name AS item_name,
           jcr.hours AS qty, jcr.unit_price, jcr.discount
    FROM job_card_repair jcr
    INNER JOIN repair r ON jcr.repair_id = r.id
    WHERE jcr.job_card_id = $jcId
");
if ($r) while ($row = $r->fetch_assoc()) $items[] = $row;

// 4. Service Package – Filters
$r = $conn->query("
    SELECT ft.code AS item_code, ft.name AS item_name,
           1 AS qty, jcsf.price AS unit_price, 0 AS discount
    FROM job_card_service_package_filter jcsf
    INNER JOIN filter_type ft ON jcsf.filter_type_id = ft.id
    WHERE jcsf.job_card_id = $jcId
");
if ($r) while ($row = $r->fetch_assoc()) $items[] = $row;

// 5. Service Package – Fuel / Lubricants
$r = $conn->query("
    SELECT ft.code AS item_code, ft.name AS item_name,
           1 AS qty, jcspf.price AS unit_price, 0 AS discount
    FROM job_card_service_package_fuel jcspf
    INNER JOIN fuel_type ft ON jcspf.fuel_type_id = ft.id
    WHERE jcspf.job_card_id = $jcId
");
if ($r) while ($row = $r->fetch_assoc()) $items[] = $row;

// ── Build PDF ──────────────────────────────────────────────────────────
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,  '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,  '', PDF_FONT_SIZE_DATA));
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
    font-size:11px;
    line-height:24px;
    font-family:"Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
    color:#000;
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
<table cellpadding="0" cellspacing="0">
<table style="width:100%;">
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="5" align="center">
        <img width="50" height="50" src="../uploads/stations/' . $data_station[0]["logo"] . '">
    </td></tr>
    <tr><td colspan="2" align="center"><b>' . $data_station[0]["service_name"] . '</b></td></tr>
    <tr><td colspan="2" align="center">ADDRESS: ' . $data_station[0]["address"] . ' ' . $data_station[0]["street"] . ' ' . $data_station[0]["city"] . '</td></tr>
    <tr><td colspan="2" align="center">CONTACT: ' . $data_station[0]["phone"] . '</td></tr>
    <tr><td colspan="2" align="center">EMAIL: ' . $data_station[0]["email"] . '</td></tr>
    <tr><td colspan="2" align="center"><b>Invoice</b></td></tr>
</table>
</table>

<p>------------------------------------------------------------------------------------------------------------------------------</p>

<table cellpadding="0" cellspacing="0">
<table style="width:100%;">
    <tr>
        <td><b>JOB CARD NO</b>: ' . htmlspecialchars($real_jobcard_code) . '</td>
        <td align="right"><b>INVOICE NO</b>: ' . htmlspecialchars($jobcardInvoicecode) . '</td>
    </tr>
    <tr>
        <td><b>CUSTOMER NAME</b>: ' . $data_vehicle[0]["first_name"] . ' ' . $data_vehicle[0]["last_name"] . '</td>
        <td align="right"><b>INVOICE DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>ADDRESS</b>: ' . $data_vehicle[0]["address"] . '</td>
        <td align="right"><b>VEHICLE NO</b>: ' . $data_vehicle[0]["vehicle_number"] . '</td>
    </tr>
    <tr>
        <td><b>CONTACT NO</b>: ' . $data_vehicle[0]["phone"] . '</td>
        <td align="right"><b>OPENING DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>VAT (%)</b>: ' . $vat . '</td>
        <td align="right"><b>CLOSING DATE</b>: ' . date("Y-m-d H:i:s") . '</td>
    </tr>
    <tr>
        <td><b>MODEL</b>: ' . ($data_vehicle[0]["vehicle_model_name"] ?? '') . '</td>
        <td align="right"><b>NXT SERV. MILEAGE</b>: ' . $new_mileage . ' KM</td>
    </tr>
    <tr>
        <td><b>MAKE</b>: ' . ($data_vehicle[0]["vehicle_make_name"] ?? '') . '</td>
        <td align="right"><b>CHASSIS NO</b>: ' . $data_vehicle[0]["chassis_number"] . '</td>
    </tr>
    <tr>
        <td><b>CURRENT MILEAGE</b>: ' . $current_mileage . ' KM</td>
        <td align="right"><b>ENGINE NO</b>: ' . $data_vehicle[0]["engine_number"] . '</td>
    </tr>
    <tr>
        <td><b>EMPLOYEE NAME</b>: ' . $curr_emp . '</td>
        <td align="right"><b>JOB CARD TYPE</b>: SERVICE ONLY</td>
    </tr>
</table>
</table>

<p>------------------------------------------------------------------------------------------------------------------------------</p>

<div class="row my-3">
<div class="col-12 table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>QTY / Hrs</th>
            <th>Unit Price (LKR)</th>
            <th>Discount (LKR)</th>
            <th>Total (LKR)</th>
        </tr>
    </thead>
    <tbody>';

$subTotal = 0.0;

if (!empty($items)) {
    foreach ($items as $item) {
        $qty       = floatval($item['qty']);
        $unitPrice = floatval($item['unit_price']);
        $discount  = floatval($item['discount']);
        $lineTotal = ($qty * $unitPrice) - $discount;
        $subTotal += $lineTotal;

        $content .= '
        <tr>
            <td>' . htmlspecialchars($item['item_code']) . '</td>
            <td>' . htmlspecialchars($item['item_name']) . '</td>
            <td align="center">' . $qty . '</td>
            <td align="right">' . number_format($unitPrice, 2) . '</td>
            <td align="right">' . number_format($discount,  2) . '</td>
            <td align="right">' . number_format($lineTotal,  2) . '</td>
        </tr>';
    }
} else {
    $content .= '<tr><td colspan="6" align="center">No items found.</td></tr>';
}

$vatAmount   = $subTotal * floatval($vat) / 100;
$totalAmount = $subTotal + $vatAmount;

$content .= '
    </tbody>
</table>
</div>
</div>

<table cellpadding="0" cellspacing="0">
<table style="width:100%;">
    <tr><td align="right"><b>Subtotal:</b> LKR ' . number_format($subTotal,   2) . '</td></tr>
    <tr><td align="right"><b>VAT (' . $vat . '%):</b> LKR ' . number_format($vatAmount,   2) . '</td></tr>
    <tr><td align="right"><b>Total Amount:</b> LKR ' . number_format($totalAmount, 2) . '</td></tr>
</table>
</table>
</div>';

$pdf->writeHTML($content);
$pdf->Output($file_location . $file_name, 'F');

// Send Email
$email_invoice_path = $file_location . $file_name;
require_once '../api/send-email-invoice.php';
?>