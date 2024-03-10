<?php                

require_once '../includes/db_config.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';


// Production
$file_location = $_SERVER['DOCUMENT_ROOT']."uploads/invoices/"; 

// Development
// $file_location = $_SERVER['DOCUMENT_ROOT']."autoservice/uploads/invoices/"; 

// -------------------- FILE NAME DEFINE -------------------
$datetime=date('dmY_hms');
$file_name = "INV_".$datetime.".pdf";
ob_end_clean();
// -------------------- FILE NAME DEFINE -------------------

// ---------------- STATION LOGO -------------------
$station_logo =$_SERVER['DOCUMENT_ROOT'].'';
// ---------------- STATION LOGO -------------------


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
    *{
        margin:0;
        padding:0;
    }
    body{
		font-size:11px;
		line-height:24px;
		font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		color:#000;
		}
        
		table.table, th, table.table td {
			border: 1px solid black;
            padding:5px;
		  }
	

          .invoice {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Adjust as needed */
            margin: 0 auto;
        }

    
    </style>
    
        <div class="invoice">
    
        <table cellpadding="0" cellspacing="0">

        <table style="width:100%;" >
        <tr><td colspan="2">&nbsp;</td></tr>

        <tr><td colspan="5" align="center"> <img  width="50" height="50" src="../uploads/stations/'.$data_station[0]["logo"].'"></td></tr>
        <tr><td colspan="2" align="center"><b>'.$data_station[0]["service_name"].'</b></td></tr>
        <tr><td colspan="2" align="center">ADDRESS: '.$data_station[0]["address"].' '.$data_station[0]["street"].' '.$data_station[0]["city"].'</td></tr>
        <tr><td colspan="2" align="center">CONTACT: '.$data_station[0]["phone"].'</td></tr>
        <tr><td colspan="2" align="center">EMAIL: '.$data_station[0]["email"].'</td></tr>
        <tr><td colspan="2" align="center"><b>Invoice</b></td></tr>
    
        <p>------------------------------------------------------------------------------------------------------------------------------</p>
    
    
        <tr>
        <td><b>JOB CARD NO</b>:'.$jobcardcode.'</td>
        <td align="right"><b>INVOICE NO</b>:'.$jobcardInvoicecode.'</td>
        </tr>
        
        <tr>
        <td><b>CUSTOMER NAME</b>:'.$data_vehicle[0]["first_name"].' '.$data_vehicle[0]["last_name"].'</td>
        <td align="right"><b>INVOICE DATE</b>:'.date("Y-m-d H:i:s").'</td>
        </tr>


        <tr>
        <td><b>ADDRESS</b>:'.$data_vehicle[0]["address"].'</td>
        <td align="right"><b>VEHICLE NO</b>:'.$data_vehicle[0]["vehicle_number"].'</td>
        </tr>

     
     
    
        <tr>
        <td><b>CONTACT NO</b>:'.$data_vehicle[0]["phone"].'</td>
        <td align="right"><b>OPENING DATE</b>:'.date("Y-m-d H:i:s").'</td>
        </tr>


        <tr>
        <td><b>VAT NO</b>:'.$vat.'</td>
        <td align="right"><b>CLOSING DATE</b>:'.date("Y-m-d H:i:s").'</td>
        </tr>

        <tr>
        <td><b>MODEL CODE</b>:'.$data_vehicle[0]["vehicle_model_name"].'</td>
        <td align="right"><b>NXT SERV.MILEAGE</b>: '.$new_mileage.' KM</td>
        </tr>

        <tr>
        <td><b>MAKE CODE</b>:'.$data_vehicle[0]["vehicle_make_name"].'</td>
        <td align="right"><b>CHASSIS NO</b>: '.$data_vehicle[0]["chassis_number"].'</td>
        </tr>

        <tr>
        <td><b>CURRENT MILEAGE</b>:'.$current_mileage.' KM</td>
        <td align="right"><b>ENGINE NO</b>:'.$data_vehicle[0]["engine_number"].'</td>
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
                    <th>Item Description</th>
                    <th>QTY / Labour Hr</th>
                    <th>Unit Price (LKR)</th>
                    <th>Discount (LKR)</th>
                    <th>Total (LKR)</th>
                    </tr>
                    </thead>
                    <tbody>


                    ';

                    $fuelTotal = 0;
                    $filterTotal = 0;

                    $subTotal=0.0;
                    $subTotalWash =0.0;
                    $totalAmount = 0.0;


                    foreach ($data_repairs as $row) {

                        $subTotal += floatval($row['total']);
    
                        $content .= '
                                <tr>
                                <td>'.$row['repairCode'].'</td>
                                <td class="text-uppercase">'.$row['repairName'].'</td>
                                <td>'.$row['hours'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['discount'].'</td>
                                <td>'.$row['total'].'</td>
                                </tr> ';
                        }
    
    
                        foreach ($data_products as $row) {
                            $subTotal += floatval($row['total']);
                            $content .= '
                            <tr>
                            <td>'.$row['productCode'].'</td>
                            <td class="text-uppercase">'.$row['productName'].'</td>
                            <td>'.$row['qty'].'</td>
                            <td>'.$row['price'].'</td>
                            <td>'.$row['discount'].'</td>
                            <td>'.$row['total'].'</td>
                                </tr> ';
                            }
                    
                    foreach ($data_fuels as $spitem) {
                        // Get the service package ID
                        $servicePackageId = $spitem['ServicePackageId']; // Assuming 'rowServicePackageID' is the key in your array
                        
                        // Initialize fuel and filter totals for each service package
                        $fuelTotal = 0;
                        $filterTotal = 0;
                        
                        // Calculate fuel total
                        foreach ($data_fuels as $fuelItem) {
                            if ($fuelItem['ServicePackageId'] == $servicePackageId) {
                                $fuelTotal += floatval($fuelItem['price']);
                            }
                        }
                        
                        // Calculate filter total
                        foreach ($data_filters as $filterItem) {
                            if ($filterItem['ServicePackageId'] == $servicePackageId) {
                                $filterTotal += floatval($filterItem['price']);
                            }
                        }
                        
                        // Calculate total
                        $total = $fuelTotal + $filterTotal;
                        $subTotal += $total;
                        
                        // Append table row to content
                        $content .= '
                            <tr>
                                <td>'.$spitem['ServicePackageCode'].'</td>
                                <td class="text-uppercase">'.$spitem['ServicePackageName'].'</td>
                                <td>1</td>
                                <td>1</td>
                                <td>0</td>
                                <td>'.  number_format($total, 2) . '</td>
                            </tr>';
                    }


                $subTotalWash += (floatval($data_washers[0]['quantity']) * floatval($data_washers[0]['price'])) - floatval($data_washers[0]['discount']);
    
                 $content .= '
                        <tr>
                        <td>01</td>
                        <td class="text-uppercase">WASH</td>
                        <td>'.$data_washers[0]['quantity'].'</td>
                        <td>'.$data_washers[0]['price'].'</td>
                        <td>'.$data_washers[0]['discount'].'</td>
                        <td>'.$subTotalWash.'</td>
                        </tr> ';


                $subTotal += $subTotalWash;

                $totalAmount += $subTotal + ($subTotal * floatval($vat) / 100);



            $content .= '
                    
            </tbody>
            </table>
            </div>
          
            </div>
         
    
    
    
    
            <table cellpadding="0" cellspacing="0">
            <table style="width:100%;">
            <tr>
            <td align="right"><b>Subtotal:</b>LKR '.$subTotal.'</td>
            </tr>
    
            <tr>
            <td align="right"><b>VAT (%) :</b>'.$vat.'</td>
            </tr>
    
            <tr>
            <td align="right"><b>Total Amount :</b>LKR '.$totalAmount.'</td>
            </tr>
    
    
           
            </table>
        </table>
        </div>
        
   
        '; 
$pdf->writeHTML($content);
$pdf->Output($file_location.$file_name, 'F'); // D means download


// Send Email
$email_invoice_path=$file_location.$file_name;
require_once '../api/send-email-invoice.php';


?>