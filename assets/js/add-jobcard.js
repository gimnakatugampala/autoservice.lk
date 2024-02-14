$(document).ready(function () {
    var dropdown = document.getElementById("cmbsearchvehicles");
    // var SearchVehicleContentDOM = $("#search-vehicle-content");


  
    //  Package Select - Service Package Items
    dropdown.addEventListener("change", function () {
      
      var selectID = dropdown.value;
      console.log(selectID)
      $.ajax({
        type: "POST",
        url: "../api/checksearchvehicle.php",
        data: { itemID: selectID },
        dataType: "json",
        success: function (data) {

        //   console.log(data)
  
          // ---------------
              populateSearchVehicleContent(data[0]);
          // ---------------
        },
        error: function () {},
      });
   
      // Fill Search Content Vehicle
      function populateSearchVehicleContent(data) {
        console.log(data)

        $('#search-vehicle-content').html(`
        <div class="row my-4">
        <div class="col-md-5 mx-auto">
          <div class="card p-3 py-4 border border-dark text-center">
   
              <div class="mx-auto my-2">

                <div class="d-flex align-items-center">

                  <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">
                    <span class="mr-1">Color: </span>
                    <div class="border inline" style="width:11px;height:11px;background-color:${data.vehicle_color};border-radius:50%" ></div>
                  </span>

                  <span class="h4 m-0 p-0"><b>${data.vehicle_number}</b></span>
                </div>

                <p class="m-0 p-0 text-secondary">Gimna Katugampala</p>
                <p class="m-0 p-0 text-secondary">+94 764961707</p>
                <p class="m-0 p-0 text-secondary">Prev Mileage : 56,000 KM</p>
              </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="exampleInputEmail1">Current Mileage (KM)</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Current Mileage">
            </div>
            </div>

            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="exampleInputEmail1">Next Mileage (KM)</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Next Mileage">
            </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                <label>Paid Status</label>
                <select id="cmbpaidstatus" class="custom-select">
                <!-- <option value="" selected disabled>Please Select</option> -->
                </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                <label>Status</label>
                <select id="cmbstatus" class="custom-select">
                    <!-- <option value="" selected disabled>Please Select</option> -->
                </select>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
            <label>Notify Me <span class="text-danger">*</span></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                <label for="customRadio2" class="custom-control-label">In 2 Months</label>
                </div>
            </div>
            <div class="col-md-4 mx-auto">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio" checked>
                <label for="customRadio4" class="custom-control-label">In 4 Months</label>
                </div>
            </div>
            <div class="col-md-4 mx-auto">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customRadio6" name="customRadio" checked>
                <label for="customRadio6" class="custom-control-label">In 6 Months</label>
                </div>
            </div>
            </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4 text-center">
            <div class="w-25">
            <p class="m-0 p-0"><b>This is not what your  looking for ?</b></p>
            <p class="m-0 p-0 text-secondary">You can create new vehicle</p>
            </div>
        </div>

        <div class="d-flex justify-content-center text-center my-2">
            <a href="../vehicles/add-vehicle.php" type="button" class="btn btn-outline-primary">Create Vehicle</a>
        </div>
        
        `);

      }
  
    });


  });
  
  