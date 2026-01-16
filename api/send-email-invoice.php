<?php
// Load Composer's autoloader
require_once('../vendor/autoload.php');



use GuzzleHttp\Client;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;

// Initialize Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path to where .env is
$dotenv->load();

$apiKey = $_ENV['BREVO_API_KEY'];

// 1. Setup Configuration
// Replace 'YOUR_BREVO_API_KEY' with your actual API key from Brevo Dashboard
$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);

$apiInstance = new TransactionalEmailsApi(new Client(), $config);
$sendSmtpEmail = new SendSmtpEmail();

try {
    // 2. Sender and Recipient
    $sendSmtpEmail['sender'] = [
        'name'  => 'autoservice.lk', 
        'email' => 'no-reply@autoserviceapp.online'
    ];
    
    $sendSmtpEmail['to'] = [
        [
            'email' => $data_vehicle[0]["email"], 
            'name'  => $data_vehicle[0]["first_name"] . ' ' . $data_vehicle[0]["last_name"]
        ]
    ];

    // 3. Content
    $sendSmtpEmail['subject'] = '[Invoice]['.$data_vehicle[0]['vehicle_number'].'] '.$data_station[0]["service_name"];

    $serviceName = $data_station[0]["service_name"];
    $customerName = $data_vehicle[0]["first_name"] . ' ' . $data_vehicle[0]["last_name"];
    $vehicleNo = $data_vehicle[0]['vehicle_number'];
    $currentYear = date("Y");
    
    $sendSmtpEmail['htmlContent'] = '
      <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; background-color: #f6f9fc; color: #444;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f6f9fc; padding: 20px 0;">
            <tr>
                <td align="center">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e1e8ed;">
                        
                        <tr>
                            <td style="background-color: #2c3e50; padding: 30px 40px; text-align: left;">
                                <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600; letter-spacing: -0.5px;">'.$serviceName.'</h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 40px;">
                                <h2 style="color: #2c3e50; font-size: 20px; margin-top: 0;">Service Invoice Attached</h2>
                                <p style="line-height: 1.6; color: #555;">Dear <strong>'.$customerName.'</strong>,</p>
                                <p style="line-height: 1.6; color: #555;">We appreciate your business. Please find the attached digital invoice for the services completed on your vehicle.</p>
                                
                                <div style="background-color: #f8fafc; border-left: 4px solid #3498db; padding: 15px 20px; margin: 25px 0;">
                                    <p style="margin: 5px 0; font-size: 14px; color: #7f8c8d;">Vehicle Number</p>
                                    <p style="margin: 0; font-size: 18px; font-weight: bold; color: #2c3e50;">'.$vehicleNo.'</p>
                                </div>

                                <p style="line-height: 1.6; color: #555;">If you have any questions regarding your service or this invoice, please don\'t hesitate to reply to this email or visit our service center.</p>
                                
                                <p style="margin-top: 30px; line-height: 1.6; color: #555;">Best regards,<br>
                                <span style="font-weight: 600; color: #2c3e50;">The Team at '.$serviceName.'</span></p>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color: #f8fafc; padding: 20px 40px; text-align: center; border-top: 1px solid #e1e8ed;">
                                <p style="font-size: 12px; color: #95a5a6; margin: 0;">
                                    &copy; '.$currentYear.' '.$serviceName.' | Managed via autoservice.lk
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';

    // 4. Handle Attachment
    // The API requires the file to be encoded in Base64
    if (file_exists($email_invoice_path)) {
        $fileContent = base64_encode(file_get_contents($email_invoice_path));
        $sendSmtpEmail['attachment'] = [
            [
                'content' => $fileContent,
                'name'    => basename($email_invoice_path)
            ]
        ];
    }

    // 5. Send the Email
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    
    // Optional: Log success
    // echo "Email sent successfully. Message ID: " . $result->getMessageId();

} catch (Exception $e) {
    echo 'Exception when sending email: ', $e->getMessage(), PHP_EOL;
}