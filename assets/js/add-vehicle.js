$(document).ready(function () {
  

    $("#btn_add_vehicle").click(function () {
        console.log("12")
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

        console.log(vehicle_img)
        console.log(vehicle_number)
        console.log(engine_number)
        console.log(cmbvehicleclass)
        console.log(cmbvehiclemanufacturer)
        console.log(cmbvehiclecountry)
        console.log(cmbvehiclemodel)
        console.log(cmbvehiclefueltype)
        console.log(cmbvehicleowner)
        console.log(cmbvehicleyear)
        console.log(chassis_number)
        console.log(vehicle_color)
    })


})