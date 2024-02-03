$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getVehicles());


   function getVehicles(){
       $.ajax({
         type: "POST",
         url: "../api/getvehicles.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let VehicleNumberElement = document.getElementById("vehicle_number");
           let EngineNumberElement = document.getElementById("engine_number");
           let VehicleManufacturerElement = document.getElementById("cmbvehiclemanufacturer");
           let VehicleCountryElement = document.getElementById("cmbvehiclecountry");
           let VehicleModelElement = document.getElementById("cmbvehiclemodel");
           let VehicleFuelTypeElement = document.getElementById("cmbvehiclefueltype");
           let VehicleOwnerElement = document.getElementById("cmbvehicleowner");
           let VehicleYearElement = document.getElementById("cmbvehicleyear");
           let ChassisNumberElement = document.getElementById("chassis_number");
           let VehicleColorElement = document.getElementById("vehicle_color");

       

        VehicleNumberElement.value = data.data_content[0].vehicle_number
        EngineNumberElement.value = data.data_content[0].engine_number
        VehicleManufacturerElement.value = data.data_content[0].vehicle_manufacturer_id
        VehicleCountryElement.value = data.data_content[0].vehicle_country_id
        VehicleModelElement.value = data.data_content[0].vehicle_model_id
        VehicleFuelTypeElement.value = data.data_content[0].vehicle_fuel_type_id
        VehicleOwnerElement.value = data.data_content[0].vehicle_owner_id
        VehicleYearElement.value = data.data_content[0].vehicle_year_manufacturer_id
        ChassisNumberElement.value = data.data_content[0].chassis_number
        VehicleColorElement.value = data.data_content[0].vehicle_color

   
           
   
         },
         error: function () {},
       });
   
     }
})