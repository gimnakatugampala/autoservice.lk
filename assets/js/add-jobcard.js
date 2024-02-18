$(document).ready(function () {
    var dropdown = document.getElementById("cmbsearchvehicles");
    // var SearchVehicleContentDOM = $("#search-vehicle-content");

    document.addEventListener('DOMContentLoaded', getVehicleReport());

    let vehicle;
    let current_mileage;
    let new_mileage;
    let paid_status;
    let job_card_type;
    let status;
    let notify;

    var rowVehicleReportData = [];

  
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

          console.log(data)
  
          // ---------------
              populateSearchVehicleContent(data);
          // ---------------
        },
        error: function () {},
      });
   
      // Fill Search Content Vehicle
      function populateSearchVehicleContent(data) {
        console.log(data)
        // console.log(status.cmbstatus)

        vehicle = data.vehicles

        $('#search-vehicle-content').html(`
        <div class="row my-4">
        <div class="col-md-5 mx-auto">
          <div class="card p-3 py-4 border border-dark text-center">
   
              <div class="mx-auto my-2">

                <div class="d-flex align-items-center">

                  <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">
                    <span class="mr-1">Color: </span>
                    <div class="border inline" style="width:11px;height:11px;background-color:${data.vehicles[0].vehicle_color};border-radius:50%" ></div>
                  </span>

                  <span class="h4 m-0 p-0"><b>${data.vehicles[0].vehicle_number}</b></span>
                </div>

                <p class="m-0 p-0 text-secondary">${data.vehicles[0].first_name} ${data.vehicles[0].last_name}</p>
                <p class="m-0 p-0 text-secondary">+94 ${removeLeadingZeros(data.vehicles[0].phone)}</p>
                <p class="m-0 p-0 text-secondary">Prev Mileage : 56,000 KM</p>
              </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="current-mileage">Current Mileage (KM)</label>
            <input type="text" class="form-control" id="current-mileage" placeholder="Current Mileage">
            </div>
            </div>

            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="new-mileage">Next Mileage (KM)</label>
            <input type="text" class="form-control" id="new-mileage" placeholder="Next Mileage">
            </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                <label>Paid Status</label>
                <select id="cmbpaidstatus" class="custom-select">
                <option value="" selected disabled>Please Select</option>
                ${data.cmbpaidstatus.map((state) => {
                  return `<option value="${state.id}">${state.status}</option>`;
              }).join('')}
                </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                <label>Job Card Type</label>
                <select id="cmbjobcardtype" class="custom-select">
                    <option value="" selected disabled>Please Select</option> 
                    ${data.cmbjobtypes.map((state) => {
                      return `<option value="${state.id}">${state.type}</option>`;
                  }).join('')}
                </select>
                </div>
            </div>

            <div class="col-sm-4">
            <div class="form-group">
            <label>Status</label>
            <select id="cmbstatus" class="custom-select">
                <option value="" selected disabled>Please Select</option> 
                ${data.cmbstatus.map((state) => {
                  return `<option value="${state.id}">${state.status}</option>`;
              }).join('')}
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
                <input value="2" class="custom-control-input" type="radio" id="customRadio2" name="customRadio" >
                <label for="customRadio2" class="custom-control-label">In 2 Months</label>
                </div>
            </div>
            <div class="col-md-4 mx-auto">
            <div class="custom-control custom-radio">
                <input value="4" class="custom-control-input" type="radio" id="customRadio4" name="customRadio" >
                <label for="customRadio4" class="custom-control-label">In 4 Months</label>
                </div>
            </div>
            <div class="col-md-4 mx-auto">
            <div class="custom-control custom-radio">
                <input value="6" class="custom-control-input" type="radio" id="customRadio6" name="customRadio" >
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



    // ---------------- Step 1 --------------
    $("#job-card-step-1").click(function () {

    
      current_mileage = $("#current-mileage").val();
      new_mileage = $("#new-mileage").val();
      paid_status = $("#cmbpaidstatus").val();
      job_card_type = $("#cmbjobcardtype").val();
      status = $("#cmbstatus").val();
      notify = $('input[name="customRadio"]:checked').val();
    
      
      console.log(vehicle)


      // if(vehicle == null){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Select Vehicle",
      //   });
      //   return
      // }else if(current_mileage == ""){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Enter Current Mileage",
      //   });
      //   return
      // }else if(new_mileage == ""){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Enter New Mileage",
      //   });
      //   return
      // }else if(paid_status == null){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Select Paid Status",
      //   });
      //   return
      // }else if(job_card_type == null){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Select Job Card Type",
      //   });
      //   return
      // }else if(status == null){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Select Status",
      //   });
      //   return
      // }else if(notify == null){
      //   Swal.fire({
      //     icon: "error",
      //     title: "Error",
      //     text: "Please Select Notification Time",
      //   });
      //   return
      // }else{

      // --------------- Set Washer in Step 3 -----------
      if(job_card_type != "2" && job_card_type != "3"){

        console.log("Call Washer")
        $.ajax({
          type: "POST",
          data: {
            vehicle_class_id:vehicle[0].vehicle_class_id,
        },
          url: "../api/getwasherbyvehicleclassid.php",
          dataType: "json",
          success: function (data) {
  
            console.log(vehicle[0].vehicle_class_id)
            console.log(data)
    
            // ---------------
            populateWasherTable(data[0])
            // ---------------
          },
          error: function () {},
        });
        
      }else{
        $('#washer-part-container').html(``)
      }

      // --------------- Set Washer in Step 3 -----------

        stepper.next()

        console.log(current_mileage)
        console.log(new_mileage)
        console.log(paid_status)
        console.log(job_card_type)
        console.log(status)
        console.log(vehicle)
        console.log(notify)

      // }


     

    })
  // ---------------- Step 1 --------------

    // --------------- Step 2 ------------
    function getVehicleReport(){

      $.ajax({
        type: "POST",
        url: "../api/getvehiclereport.php",
        dataType: "json",
        success: function (data) {

          console.log(data)
  
          // ---------------
              populateVehicleReportContent(data);
          // ---------------
        },
        error: function () {},
      });

      // --- Populate Vehicle Report
      function populateVehicleReportContent(data){
          console.log(data)

          $('#vehicle-report-container').html(`
          ${data.vehicle_category.map((category) => {
              return `
                  <div class="col-md-10 table-responsive p-0 mx-auto my-2">
                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>${category.category}</th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          ${data.vehicle_subcategory.filter(subcategory => subcategory.vehicle_condition_category_id === category.id).map(subcategory => {
                            return `
                            <tr data-subcategory-id="${subcategory.id}">
                                    <td>${subcategory.sub_category}</td>
                                    <input type="hidden" value="${subcategory.id}">
                                    <td> 
                                        <div class="form-check">
                                            <input value="1" class="form-check-input" type="radio" name="radio${subcategory.id}">
                                            <label class="form-check-label">Worse</label>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-check">
                                            <input value="2" class="form-check-input" type="radio" name="radio${subcategory.id}">
                                            <label class="form-check-label">Bad</label>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-check">
                                            <input value="3" class="form-check-input" type="radio" name="radio${subcategory.id}">
                                            <label class="form-check-label">Ok</label>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-check">
                                            <input value="4" class="form-check-input" type="radio" name="radio${subcategory.id}">
                                            <label class="form-check-label">Good</label>
                                        </div>
                                    </td>
                                    <td> 
                                        <div class="form-check">
                                            <input value="5" class="form-check-input" type="radio" name="radio${subcategory.id}">
                                            <label class="form-check-label">Perfect</label>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                          </tbody>
                      </table>
                  </div>`;
          }).join('')}
      `);
      }

    }

    $("#job-card-step-2").click(function () {
    // Iterate over each row in the table
    $('table tbody tr').each(function(index) {
        // Object to store the data for the current row
        var row = {};

        // Find the subcategory ID for this row
        var subcategoryId = $(this).data('subcategory-id');

        // Find the radio buttons within this row
        $(this).find('input[type="radio"]').each(function() {
            // Check if the radio button is checked
            if ($(this).is(':checked')) {
                // Store the subcategory ID and the value of the checked radio button
                row['subcategoryId'] = subcategoryId;
                row['value'] = $(this).val();
            }
        });

        // Push the row object containing radio button values and subcategory ID into the rowVehicleReportData array
        rowVehicleReportData.push(row);
    });

    
    console.log(rowVehicleReportData);
    
      stepper.next()
    })
    // --------------- Step 2 ------------

    // --------------- Step 3 ------------
    function populateWasherTable(data) {
      $('#washer-part-container').html(`
      <div class="col-md-12">
        <table class="table table-striped">
        <thead>
            <tr>
            <th>#</th>
            <th>Washer Package Name</th>
            <th>QTY</th>
            <th>Unit Price (LKR)</th>
            <th>Discount (LKR)</th>
            <th>Total (LKR)</th>
            </tr>
        </thead>
        <tbody>

        <tr>
        <td>1.</td>
        <td>Wash</td>

        <td>  
            <div class="input-group">
            <input type="text" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            </div>
        </td>
        
        <td>  
            <div class="input-group">
            <input value="${data.price}" type="text" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            </div>
        </td>

        <td>  
            <div class="input-group">
            <input type="text" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            </div>
        </td>

        <td>  
            <p class="h6">400.00</p>
        </td>


        
        </tr>

        </tbody>
        </table>

        <h4><b>Total - LKR 14,000/=</b></h4>

    </div>

      `)
    }

    $("#job-card-step-3").click(function () {
      console.log("123")
    })
    // --------------- Step 3 ------------


  });
  
  