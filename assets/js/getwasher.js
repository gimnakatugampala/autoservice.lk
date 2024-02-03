$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getVehicles());


   function getVehicles(){
       $.ajax({
         type: "POST",
         url: "../api/getwasher.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let VehicleClassElement = document.getElementById("cmbvehicleclass");
           let PriceElement = document.getElementById("price");

    
           VehicleClassElement.value = data.data_content[0].vehicle_type_id
           PriceElement.value = data.data_content[0].price

        

   
         },
         error: function () {},
       });
   
     }
})