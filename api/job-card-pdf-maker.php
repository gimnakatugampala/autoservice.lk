<?php                

require_once '../includes/db_config.php';
require_once '../vendor/tcpdf_6_3_2/tcpdf/tcpdf.php';


// Production
// $file_location = $_SERVER['DOCUMENT_ROOT']."/invoices/"; 

// Development
$file_location = $_SERVER['DOCUMENT_ROOT']."autoservice/uploads/invoices/"; 

$datetime=date('dmY_hms');
$file_name = "INV_".$datetime.".pdf";
ob_end_clean();


	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
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
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 


    $content = ''; 
    $content .= '
    <style type="text/css">
    body{
    font-size:12px;
    line-height:24px;
    font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    color:#000;
    }
    table.table, th.th, td.td {
        border: 1px solid black;
        border-collapse: collapse;
        padding:10px;
      }

      td.card{
        padding:100px;
      }


    </style>    
    <table cellpadding="0" cellspacing="0">
    <table style="width:100%;" >
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="center"><b>TECH DRIVE SOLUTIONS</b></td></tr>
    <tr><td colspan="2" align="center"><b>CONTACT: +94 764961 707</b></td></tr>
    <tr><td colspan="2" align="center"><b>WEBSITE: WWW.TECHDRIVE.LK</b></td></tr>

    <br />
    <br />

    <tr>
    <td style="font-size:10px;margin-bottom:45px;">CUSTOMER INFO:</td>
    <td style="font-size:10px;margin-bottom:45px;" align="right">INVOICE INFO:</td>
    </tr>

    <br />

    <tr>
    <td><b>CUSTOMER NAME: 3453453543</b></td>
    <td align="right"><b>SALES CODE: 43534535</b> </td>
    </tr>
    <br />

    <tr>
    <td><b>EMAIL:bhgfghfgh</b></td>
    <td align="right"><b>PAYMENT STATUS: 56756757</b> </td>
    </tr>

    <br />

    <tr>
    <td><b>MOBILE: +94 657435656</b></td>
    <td align="right"><b>STATUS: fdghfhf</b> </td>
    </tr>
    <br />

    <tr>
    <td><b>ADDRESS : 789789</b></td>
    <td align="right"><b>PLACED DATE: 675</b> </td>
    </tr>


    <br />

    <tr>
    <td>&nbsp;</td>
    <td align="right"><b>COMPLETED DATE: 66</b> </td>
    </tr>

    <p>--------------------------------------------------------------------------------------------------------------------------------</p>


    <tr><td colspan="2" align="center"><b>SALES ORDER INVOICE</b></td></tr>
    <p></p>

    <table class="table" align="center">
    <tr bgcolor="##BFC9CA">
        <th class="th"  colspan="1">
            <b>PRODUCT NAME</b>
        </th>

        <th class="th" colspan="1">
        <b>QTY</b>
        </th>

        <th class="th" colspan="1">
            <b>PRICE (RS.)</b>
        </th>

        <th class="th" colspan="1">
            <b>DISCOUNT (RS.)</b>
        </th>

        <th class="th" colspan="1">
            <b>SUBTOTAL (RS.)</b>
        </th>

    </tr>
    


    <tbody>
    ';


    $content .= '</tbody></table>';

        
        $content .= '
        <p></p>

        <table>

        <tr>
        <td colspan="2" align="right">
        <b>TOTAL DISCOUNT : 7777</b>
        </td>
        </tr>

        <tr>
        <td colspan="2" align="right">
        <b>PAID AMOUNT : 4445</b>
        </td>
        </tr>

        <tr>
        <td colspan="2" align="right">
        <b>GRAND&nbsp;TOTAL:&nbsp; 444</b>
        </td>
        </tr>

        <tr colspan="2">
        <td>&nbsp;</td>
        <td align="right">------------------------</td>
        </tr>

        <tr>
        <td colspan="2" align="right">
        <b>TO BE PAID : 45</b>
        </td>
        </tr>
        
        <tr><td colspan="2" align="right">------------------------</td></tr>

        <p>--------------------------------------------------------------------------------------------------------------------------------</p>

        
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2" align="center"><b>THANK YOU ! VISIT AGAIN</b></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        </table>
    </table>
</table>'; 
$pdf->writeHTML($content);

$pdf->Output($file_location.$file_name, 'F'); // D means download


?>