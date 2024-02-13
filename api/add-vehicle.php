<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $vehicle_number = $_POST['vehicle_number'];
    $engine_number = $_POST['engine_number'];
    $vehicleclass = $_POST['vehicleclass'];
    $vehiclemanufacturer = $_POST['vehiclemanufacturer'];
    $vehiclecountry = $_POST['vehiclecountry'];
    $vehiclemodel = $_POST['vehiclemodel'];
    $vehiclefueltype = $_POST['vehiclefueltype'];
    $vehicleowner = $_POST['vehicleowner'];
    $vehicleyear = $_POST['vehicleyear'];
    $chassis_number = $_POST['chassis_number'];
    $vehicle_color = $_POST['vehicle_color'];

    $sql = "SELECT * FROM vehicle WHERE vehicle_number = '$vehicle_number'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "Vehicle Exist";        
    } else {


          // -------------------------------- SAVE DATA ---------------------------------
          if(isset($_FILES["my_image"])){
            $img_name = $_FILES["my_image"]["name"];
            $img_size = $_FILES["my_image"]["size"];
            $tmp_name = $_FILES["my_image"]["tmp_name"];
            $error = $_FILES["my_image"]["error"];

            if($error == 0){

                if($img_size > 1000000){
                    $em = "File Too Large";
                    $error = array('error'=>1,'em'=>$em);
                    echo json_encode($error);
                    exit();
                }else{
                    
                $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg","jpeg","png");
    
                if(in_array($img_ex_lc,$allowed_exs)){
    
                    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                    $img_upload_path= "../uploads/vehicles/".$new_img_name;
    
                    if (!file_exists('../uploads/vehicles/')) {
                        mkdir('../uploads/vehicles/');
                    }
    
                    move_uploaded_file($tmp_name,$img_upload_path);


                    // -------------------------- SAVE DATA ---------------------------

                        // Save Data
                        $sql = "INSERT INTO vehicle (code, 
                        vehicle_number,
                        vehicle_color,
                        engine_number,
                        chassis_number,
                        vehicle_owner_id,
                        vehicle_model_id,
                        vehicle_year_manufacturer_id,
                        vehicle_fuel_type_id,
                        vehicle_country_id,
                        vehicle_manufacturer_id,
                        vehicle_img,
                        vehicle_class_id
                        ) 
                        VALUES ('$code', 
                        '$vehicle_number',
                        '$vehicle_color',
                        '$engine_number',
                        '$chassis_number',
                        '$vehicleowner',
                        '$vehiclemodel',
                        '$vehicleyear',
                        '$vehiclefueltype',
                        '$vehiclecountry',
                        '$vehiclemanufacturer',
                        '$new_img_name',
                        '$vehicleclass')";
                        if ($conn->query($sql) === TRUE) {

                            echo "success";
                        }else{
                            echo $conn->error;
                        }

                    // -------------------------- SAVE DATA ---------------------------

           
    
                }else{
    
                    $em = "unknown file type";
                    $error = array('error'=>1,'em'=>$em);
                    echo json_encode($error);
                    exit();
    
                }
    
                // echo $img_ex_lc;
        
                }
        
            }else{
                $em = "unknown File";
        
                $error = array('error'=>1,'em'=>$em);
        
                echo json_encode($error);
                exit();
            }
    
    
        }else{

        // -------------------------- SAVE DATA ---------------------------

            // Save Data
            $sql = "INSERT INTO vehicle (code, 
            vehicle_number,
            vehicle_color,
            engine_number,
            chassis_number,
            vehicle_owner_id,
            vehicle_model_id,
            vehicle_year_manufacturer_id,
            vehicle_fuel_type_id,
            vehicle_country_id,
            vehicle_manufacturer_id,

            vehicle_class_id
            ) 
            VALUES ('$code', 
            '$vehicle_number',
            '$vehicle_color',
            '$engine_number',
            '$chassis_number',
            '$vehicleowner',
            '$vehiclemodel',
            '$vehicleyear',
            '$vehiclefueltype',
            '$vehiclecountry',
            '$vehiclemanufacturer',
            '$vehicleclass')";
            if ($conn->query($sql) === TRUE) {

                echo "success";
            }else{
                echo $conn->error;
            }

        // -------------------------- SAVE DATA ---------------------------
        }

        // -------------------------------- SAVE DATA ---------------------------------

        
   

    }


}


?>