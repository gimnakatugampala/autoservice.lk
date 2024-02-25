$(document).ready(function () {
    var dropdown = document.getElementById("cmbsearchvehicles");


    //  Search Vehicle
    dropdown.addEventListener("change", function () {
      
        var selectID = dropdown.value;
        console.log(selectID)
        $.ajax({
          type: "POST",
          url: "../api/searchvehicle.php",
          data: { itemID: selectID },
          dataType: "json",
          success: function (data) {
  
            console.log(data)
            
    
            // ---------------
                populateSearchVehicleContent(data);
            // ---------------
          },
          error: function () {},
        });
     
        // Fill Search Content Vehicle
        function populateSearchVehicleContent(data) {

          $('#search-vehicle-content').html(`
          <div class="row">

          <div class="col-md-10 mx-auto">
            <a href="../vehicle-search/service-records.php?code=${data[0].VEHICLE_CODE}" type="button" class="btn bg-gradient-secondary float-right"><i class="fas fa-history"></i> View Service Records</a>
          </div>

          <div class="col-md-10 mx-auto">
              <img class="border"  width="280" height="200" src="${data[0].vehicle_img == null ? '../dist/img/system/car_img.png' : `../uploads/vehicles/${data[0].vehicle_img}`}" alt="Vehicle">
          </div>

          <div class="col-md-9 mx-auto my-2">
            <div class="d-flex align-items-center justify-content-evenly">
              <span class="text-secondary mx-1"><b>${data[0].vehicle_color}</b></span>
              <div class="border inline mx-1" style="width:11px;height:11px;background-color:${data[0].vehicle_color};border-radius:50%" ></div>
              <span class="h4 m-0 p-0"><b>${data[0].vehicle_number}</b></span>
            </div>
          </div>

          <div class="col-md-10 mx-auto my-4">

          <div class="row">
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Vehicle Code</b></h6>
                <p class="text-muted m-0 p-0">${data[0].VEHICLE_CODE}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Vehicle Owner</b></h6>
                <p class="text-muted m-0 p-0">${data[0].first_name} ${data[0].last_name}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Vehicle Make</b></h6>
                <p class="text-muted m-0 p-0">${data[0].vehicle_make_name}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Model</b></h6>
                <p class="text-muted m-0 p-0">${data[0].vehicle_model_name}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Manufacturer Country</b></h6>
                <p class="text-muted m-0 p-0">${data[0].COUNTRY_NAME}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Vehicle Class</b></h6>
                <p class="text-muted m-0 p-0">${data[0].VEHICLE_CLASS}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Fuel Type</b></h6>
                <p class="text-muted m-0 p-0">${data[0].VEHICLE_FUEL_TYPE}</p>
            </div>
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase m-0 p-0"><b>Year Of Manufacturer</b></h6>
                <p class="text-muted m-0 p-0">${data[0].VEHICLE_YEAR}</p>
            </div>
          </div>

          </div>

          </div>
          `);
  
        }
    
      });

})