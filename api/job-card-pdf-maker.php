<?php                

require_once '../includes/db_config.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';


// Production
// $file_location = $_SERVER['DOCUMENT_ROOT']."/invoices/"; 

// Development
$file_location = $_SERVER['DOCUMENT_ROOT']."autoservice/uploads/invoices/"; 

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

        <tr><td colspan="5" align="center"> <img  width="50" height="50" src="../uploads/stations/IMG-65cba69ec76876.46044841.png"></td></tr>
        <tr><td colspan="2" align="center"><b>Pistona Automotive Solutions (Pvt) Ltd</b></td></tr>
        <tr><td colspan="2" align="center">ADDRESS: 385/45, Major Wasantha gunarathne mw  kadawatha</td></tr>
        <tr><td colspan="2" align="center">CONTACT: 0117600800 Fax : 0112948098</td></tr>
        <tr><td colspan="2" align="center">EMAIL: pistonaautomotivesolutions@gmail.com</td></tr>
        <tr><td colspan="2" align="center"><b>Invoice</b></td></tr>
    
        <p>------------------------------------------------------------------------------------------------------------------------------</p>
    
    
        <tr>
        <td><b>JOB CARD NO</b>:JMW435</td>
        <td align="right"><b>INVOICE NO</b>:FD4BSEIJL7XJBEZF6FWC</td>
        </tr>
    
        <tr>
        <td><b>CUSTOMER NAME</b>:GIMNA KATUGAMPALA</td>
        <td align="right"><b>INVOICE DATE</b>:45646</td>
        </tr>


        <tr>
        <td><b>ADDRESS</b>:GIMNA KATUGAMPALA</td>
        <td align="right"><b>VEHICLE NO</b>:45646</td>
        </tr>

     
     
    
        <tr>
        <td><b>CONTACT NO</b>:0764961707</td>
        <td align="right"><b>OPENING DATE</b>:03-03-2024</td>
        </tr>


        <tr>
        <td><b>VAT NO</b>:7</td>
        <td align="right"><b>CLOSING DATE</b>:03-03-2024</td>
        </tr>

        <tr>
        <td><b>MODEL CODE</b>:MC0125</td>
        <td align="right"><b>NXT SERV.MILEAGE</b>:1200 KM</td>
        </tr>

        <tr>
        <td><b>MAKE CODE</b>:HONDA</td>
        <td align="right"><b>CHASSIS NO</b>: ERT436</td>
        </tr>

        <tr>
        <td><b>CURRENT MILEAGE</b>:19,809.00</td>
        <td align="right"><b>ENGINE NO</b>:SDFWER</td>
        </tr>

       
        </table>
        </table>
        
             
               
        
     
        <p>------------------------------------------------------------------------------------------------------------------------------</p>
           
    
            <!-- Table row -->
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
                    <tr>
                    <td>00-93987-3</td>
                    <td class="text-uppercase">oil filter-micro mtw 62 (c-809)</td>
                    <td>1.5</td>
                    <td>999.98</td>
                    <td>1999.98</td>
                    <td>999.998</td>
                    </tr>
                    
                    </tbody>
                </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    
    
    
    
            <table cellpadding="0" cellspacing="0">
            <table style="width:100%;">
            <tr>
            <td align="right"><b>Subtotal:</b>LKR 250.30</td>
            </tr>
    
            <tr>
            <td align="right"><b>VAT (%) :</b>56</td>
            </tr>
    
            <tr>
            <td align="right"><b>Total Amount :</b>LKR 265.24</td>
            </tr>
    
    
           
            </table>
        </table>
        </div>
        
   
        '; 
$pdf->writeHTML($content);
$pdf->Output($file_location.$file_name, 'F'); // D means download


?>