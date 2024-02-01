$(document).ready(function () {
  

    $("#btn_add_vehicle").click(function () {
  
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
                url: "../api/add-vehicle.php",
                data: {
                code:generateUUID(),
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


            // console.log(vehicle_img)
            // console.log(vehicle_number)
            // console.log(engine_number)
            // console.log(cmbvehicleclass)
            // console.log(cmbvehiclemanufacturer)
            // console.log(cmbvehiclecountry)
            // console.log(cmbvehiclemodel)
            // console.log(cmbvehiclefueltype)
            // console.log(cmbvehicleowner)
            // console.log(cmbvehicleyear)
            // console.log(chassis_number)
            // console.log(vehicle_color)
        }

    })


})