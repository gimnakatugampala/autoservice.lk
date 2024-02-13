
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $repair_name = $_POST['repair_name'];
    $data = json_decode($_POST['manage_repair'], true);


        // Save Data
        $sql = "UPDATE repair SET 
        name = '$repair_name'
        WHERE id = '$id'";
        if ($conn->query($sql) == TRUE) {
        //     $repairPackageID = $conn->insert_id;

            // Manage Repair
            foreach ($data as $row) {
                $repairID = $row['repairID'];
                $vehicleClassID = $row['ID'];
                $price = $row['price'];

            $manageRepairSQL = "UPDATE manage_repair SET 
            price = '$price'
            WHERE repair_id = '$repairID' AND vehicle_class_id = '$vehicleClassID'";
            if ($conn->query($manageRepairSQL) !== true) {
                echo 'Error: ' . $manageRepairSQL . '<br>' . $conn->error;
                exit();
            }
        }

        echo "success";

        }else{
            echo $conn->error;
        }

  

        

}


?>