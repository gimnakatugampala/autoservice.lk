$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getVehicles());

    $("#btn_edit_vehicle").click(function () {
  
      var vehicle_number = $("#vehicle_number").val();
      var engine_number = $("#engine_number").val();
      var cmbvehicleclass = $("#cmbvehicleclass").val();
      var vehicle_img = $("#vehicle_img").val();
      var cmbvehiclemanufacturer = $("#cmbvehiclemanufacturer").val();
      var cmbvehiclecountry = $("#cmbvehiclecountry").val();
      var cmbvehiclemodel = $("#cmbvehiclemodel").val();
      var cmbvehiclefueltype = $("#cmbvehiclefueltype").val();
      var cmbvehicleowner = $("#cmbvehicleowner").val();
      var cmbvehicleyear = $("#cmbvehicleyear").val();
      var chassis_number = $("#chassis_number").val();
      var vehicle_color = $("#vehicle_color").val();
      var dataIdValue = $(this).data("id");

      if(vehicle_number == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Vehicle Number.",
          });
          return
      }else if(engine_number == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Enter Engine Number.",
          });
          return
      }else if(chassis_number == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Enter Chassis Number.",
          });
          return
      }else if(vehicle_color == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Enter Vehicle Color.",
          });
          return
      }else{


          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editvehicle.php",
              data: {
              id:dataIdValue,
              vehicle_number:vehicle_number,
              engine_number:engine_number,
              vehicleclass:cmbvehicleclass,
              vehiclemanufacturer:cmbvehiclemanufacturer,
              vehiclecountry:cmbvehiclecountry,
              vehiclemodel:cmbvehiclemodel,
              vehiclefueltype:cmbvehiclefueltype,
              vehicleowner:cmbvehicleowner,
              vehicleyear:cmbvehicleyear,
              chassis_number:chassis_number,
              vehicle_color:vehicle_color
              },
              success: function (response) {
      
                  console.log(response)

                if (response === "success") {

                  window.location.href = "../vehicles/";
      
                }else if(response == "Vehicle Exist"){

                  Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Vehicle Already Exist.",
                    });

                }else {
                  Swal.fire({
                      icon: "error",
                      title: "Something Went Wrong",
                      text: "Please Try Again.",
                    });
                }

              },
              error:function (error) {
                  console.log(error)
              }
          });

      }

  })


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
           var buttonElement = document.getElementById("btn_edit_vehicle");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
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