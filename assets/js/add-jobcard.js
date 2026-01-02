$(document).ready(function () {
    var dropdown = document.getElementById("cmbsearchvehicles");

    let vehicle;
    let current_mileage;
    let new_mileage;
    let paid_status;
    let job_card_type;
    let status;
    let notify;

    var rowVehicleReportData = [];

    var items = [];
    var WasherValues = []

    let jobCardCode;
    let invoiceCode;

    let serviceStationInfo;

    const currentDate = new Date();

    // Get day, month, and year
    const day = currentDate.getDate();
    const month = currentDate.getMonth() + 1; // Month is zero-based, so we add 1
    const year = currentDate.getFullYear();

    // Pad single-digit day and month with leading zero if needed
    const formattedDay = day < 10 ? `0${day}` : day;
    const formattedMonth = month < 10 ? `0${month}` : month;

    // Format date as "DD-MM-YYYY"
    const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

    const VAT = document.getElementById("in_vat_input");
    VAT.addEventListener("input", function () {
      displayCalculation()
    })
    

  
    //  Search Vehicle
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
        serviceStationInfo = data.station

        // Define vehicle images based on vehicle_class_id
    const vehicleImages = {
      1: "../assets/img/vehicle-img/light_motor_cycle.jpg",
      2: "../assets/img/vehicle-img/motor_cycles.jpg",
      3: "../assets/img/vehicle-img/three_wheeler.jpg",
      4: "../assets/img/vehicle-img/van.jpg",
      5: "../assets/img/vehicle-img/car.jpg",
      6: "../assets/img/vehicle-img/Light_Motor_Lorry.jpg",
      7: "../assets/img/vehicle-img/motor_lorry.jpg",
      8: "../assets/img/vehicle-img/Heavy_Motor_Lorry.jpg",
      9: "../assets/img/vehicle-img/light_bus.jpg",
      10: "../assets/img/vehicle-img/Hand_Tractors.jpg",
      11: "../assets/img/vehicle-img/Land_Vehicle.jpg",
      12: "../assets/img/vehicle-img/Special_purpose_Vehicle.jpg"
      
  };

  // Default image if no matching class is found
  let vehicleImage = vehicleImages[vehicle[0].vehicle_class_id] || "../assets/img/vehicle-img/default.jpg";

        $('#search-vehicle-content').html(`
        <div class="row my-4">
        <div class="col-md-5 mx-auto">
          <div class="card p-3 py-4 border border-dark text-center">
   
              <div class="mx-auto my-2">


              <img 
                src="${vehicleImage}"
                style="width: 80px; height: 80px; border-radius: 50%;object-fit: cover;"
                alt="Profile Image"
              />

                <div class="d-flex align-items-center">

                <span class="m-0 p-0 d-flex align-items-center text-secondary mr-2">


                    <span class="mr-1">Color: </span>
                    <div class="border inline" style="width:11px;height:11px;background-color:${data.vehicles[0].vehicle_color};border-radius:50%" ></div>
                  </span>

                  <span class="h4 m-0 p-0"><b>${data.vehicles[0].vehicle_number}</b></span>
                </div>

                <p class="m-0 p-0 text-secondary">${data.vehicles[0].first_name} ${data.vehicles[0].last_name}</p>
                <p class="m-0 p-0 text-secondary">+94 ${removeLeadingZeros(data.vehicles[0].phone)}</p>
                <p class="m-0 p-0 text-secondary">Prev Mileage : ${data.vehicles[0].current_mileage == null ? 0 : data.vehicles[0].current_mileage} KM</p>
              </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="current-mileage">Current Mileage (KM) <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="current-mileage" placeholder="Current Mileage">
            </div>
            </div>

            <div class="col-md-4 mx-auto">
            <div class="form-group">
            <label for="new-mileage">Next Mileage (KM) <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="new-mileage" placeholder="Next Mileage">
            </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                <label>Paid Status <span class="text-danger">*</span></label>
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
                <label>Job Card Type <span class="text-danger">*</span></label>
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
            <label>Status <span class="text-danger">*</span></label>
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
    // ---------------------------------------
    $("#job-card-step-1").click(function () {

    
      current_mileage = $("#current-mileage").val();
      new_mileage = $("#new-mileage").val();
      paid_status = $("#cmbpaidstatus").val();
      job_card_type = $("#cmbjobcardtype").val();
      status = $("#cmbstatus").val();
      notify = $('input[name="customRadio"]:checked').val();
    
      
      console.log(vehicle)


      if(vehicle == null){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Select Vehicle",
        });
        return
      }else if(current_mileage == ""){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Enter Current Mileage",
        });
        return
      }else if(new_mileage == ""){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Enter New Mileage",
        });
        return
      }else if(paid_status == null){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Select Paid Status",
        });
        return
      }else if(job_card_type == null){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Select Job Card Type",
        });
        return
      }else if(status == null){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Select Status",
        });
        return
      }else if(notify == null){
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Select Notification Time",
        });
        return
      }else{

        //  ----- SHOW / HIDE Vehicle report based on joib card type
        if(job_card_type == "6" || job_card_type == "3" || job_card_type == "5"){
          getVehicleReport()
        }else{
          $('#vehicle-report-container').html(`Report Not Available`)
        }

      // --------------- Set Washer in Step 3 -----------
      if(job_card_type != "2" && job_card_type != "3"){

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
            console.log(job_card_type)

 
            // ---------------
            populateWasherTable(data[0])
            // ---------------
          },
          error: function () {},
        });
        
      }else{
        $('#washer-part-container').html(`Washer Not Available`)
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

         // ---------------- INVOICE DETAILS ----------------
         jobCardCode = generateUUID()
         invoiceCode = generateUUID()
         getInvoiceDetails(vehicle,serviceStationInfo)
         // ---------------- INVOICE DETAILS ----------------

      }


     

    })
     // ---------------------------------------
  // ---------------- Step 1 --------------



    // --------------- Step 2 ------------
     // ---------------------------------------
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
                            <tr data-category-id="${category.id}" data-subcategory-id="${subcategory.id}">
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
  
    rowVehicleReportData = []

    $('table tbody tr').each(function(index) {
        // Object to store the data for the current row
        var row = {};

        // Find the subcategory ID for this row
        var subcategoryId = $(this).data('subcategory-id');
        var categoryId = $(this).data('category-id');

        // Find the radio buttons within this row
        $(this).find('input[type="radio"]').each(function() {
            // Check if the radio button is checked
            if ($(this).is(':checked')) {
                // Store the subcategory ID and the value of the checked radio button
                row['categoryId'] = categoryId;
                row['subcategoryId'] = subcategoryId;
                row['value'] = $(this).val();
            }
        });

        if (!$.isEmptyObject(row)) {
        // Push the row object containing radio button values and subcategory ID into the rowVehicleReportData array
        rowVehicleReportData.push(row);
    }
    });

  
    
    stepper.next()
    
    console.log(rowVehicleReportData);
    
      
    })
     // ---------------------------------------
    // --------------- Step 2 ------------

    // --------------- Step 3 ------------
     // ---------------------------------------
    function populateWasherTable(data) {
    // Clear previous content
    $('#washer-part-container').html('');
    

    if (!data) {
        $('#washer-part-container').html('<p class="text-danger">No washer package found for this vehicle class.</p>');
        return;
    }

    $('#washer-part-container').html(`
      <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Washer Package Name</th>
                    <th>QTY</th>
                    <th>Unit Price (LKR)</th>
                    <th>Discount (LKR)</th>
                    <th>Total (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="rowBody">
                    <td style='display:none;' class='rowID'>${data.id}</td>
                    <td style='display:none;' class='rowCode'>${data.code}</td>
                    <td>Wash (${data.code})</td>
                    <td>   
                        <input value="1" type="number" class="form-control wash-qty">
                    </td>
                    <td>   
                        <input value="${data.price}" type="number" class="form-control wash-unit-price">
                    </td>
                    <td>   
                        <input value="0" type="number" class="form-control wash-discount">
                    </td>
                    <td>   
                        <p class="h6 font-weight-bold wash-total">0.00</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4><b>Total - LKR <span id="wash-final-total">0.00</span>/=</b></h4>
      </div>
    `);

    var row = $(".rowBody");
    var item = {
      rowCode: row.find(".rowCode")[0],
        rowID: row.find(".rowID")[0],
        quantityInput: row.find(".wash-qty")[0],
        priceInput: row.find(".wash-unit-price")[0],
        discountInput: row.find(".wash-discount")[0],
        totalCell: row.find(".wash-total")[0],
    };
    
    items = []; 
    items.push(item);

    // Attach listeners
    [item.quantityInput, item.priceInput, item.discountInput].forEach(input => {
        input.addEventListener("input", calculateWasherTotal);
    });

    calculateWasherTotal();
}

   function calculateWasherTotal() {
    let grandTotal = 0;
    WasherValues = []; // Clear array to avoid accumulating duplicates on every keystroke

    items.forEach(function (item) {
        var rowID = item.rowID.innerText;
        var quantity = parseFloat(item.quantityInput.value) || 0;
        var price = parseFloat(item.priceInput.value) || 0;
        var discount = parseFloat(item.discountInput.value) || 0;

        var itemTotal = (quantity * price) - discount;
        item.totalCell.textContent = itemTotal.toFixed(2);
        
        grandTotal += itemTotal;

        // Push clean data into the global array used for the API
        WasherValues.push({
            washerID: rowID,
            price: price,
            quantity: quantity,
            discount: discount
        });
    });

    $("#wash-final-total").text(grandTotal.toFixed(2));
}

    $("#job-card-step-3").click(function () {
      console.log(items)
      console.log(WasherValues)
      stepper.next()
    })
     // ---------------------------------------
    // --------------- Step 3 ------------


    //  ---------------------- Step 4 -------------
     // ---------------------------------------
    var dropdownServicePackage = document.getElementById("cmbservicepackages");
    var tableBodyServicePackage = $("#table-jobcard-service-packages");

    var service_packages_items = [];
    var selected_service_packages = [];

    // Fuel Type
    var service_packages_items_fuel = [];
    // Filter Type
    var service_packages_items_filter = [];

    let counterId =0;

    // Selected Fuel Type
    var selected_fuel = []
    // Selected Filter Type
    var selected_filter = []



    dropdownServicePackage.addEventListener("change", function () {
      var servicePackageId = dropdownServicePackage.value;
      $.ajax({
        type: "POST",
        url: "../api/checkservicepackage.php",
        data: { 
          servicePackageId: servicePackageId
        },
        dataType: "json",
        success: function (data) {

            console.log(data)
            // console.log(data.servicePackage[0])
          // ---------------
          let foundServicePackage = selected_service_packages.some(servicep => servicep.id == servicePackageId);
  
            if(foundServicePackage){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Service Package Already Exist",
              });
              return
  
            }else{
              counterId += 1;
              console.log(job_card_type)

              // if(job_card_type == 3){
                populateTableServicePackage(data,counterId);
                selected_service_packages.push(data.servicePackage[0])
              // }
                
               
              // console.log(data)
            }
  
          // ---------------
        },
        error: function () {},
      });
  
      // Get All the Repairs List
      function populateTableServicePackage(data,counterId) {
        console.log(data)

        data.servicePackage.forEach(function (plist) {
          var row = $(`<tr data-widget="expandable-table" aria-expanded="false">
          <td class='rowServicePackageID' style='display:none;'>${plist.id}</td>
          <td class='rowServicePackageCode' style='display:none;'>${plist.code}</td>
          <td class='rowServicePackageName' style='display:none;'>${plist.package_name}</td>
          <td>${counterId}</td>
          <td>${plist.package_name}</td>
          <td>
          <button data-id="${plist.id}" type="button" class="btn bg-gradient-danger deleteServicePackageItem"><i class="fas fa-trash"></i></button>
          </td>
      </tr>
      <tr class="expandable-body">
          <td colspan="5">
          <p class="m-0 p-0">
              <div class="row">
              <div class="col-md-6">
                  <table class="table table-sm table-striped">
                  <thead>
                      <tr>
                      <th>#</th>
                      <th>Lubricant Type</th>
                      <th>Price</th>
                      <th>Select</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                  ${data.fuelArry.map((fuel, fuelIndex) => `
                    <tr>
                    <td class='rowFuelID' style='display:none;'>${fuel.id}</td>
                    <td class='rowServicePackageID' style='display:none;'>${plist.id}</td>
                    <td class='rowServicePackageCode' style='display:none;'>${plist.code}</td>
                    <td class='rowServicePackageName' style='display:none;'>${plist.package_name}</td>
                        <td>${fuelIndex + 1}</td>
                        <td>${fuel.name}</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LKR</span>
                                </div>
                                <input value="${fuel.price}" type="text" class="form-control FuelPrice">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input fuel-radio" type="radio" id="fuelRadio${counterId + 1}_${fuelIndex + 1}" name="fuelRadio${counterId + 1}">
                                <label for="fuelRadio${counterId + 1}_${fuelIndex + 1}" class="custom-control-label"></label>
                            </div>
                        </td>
                    </tr>
                `).join('')}

              
                  
                      
                  </tbody>
                  </table>
              </div>

              <div class="col-md-6">
                  <table class="table table-sm table-striped">
                  <thead>
                      <tr>
                      <th>#</th>
                      <th>Filter Type</th>
                      <th>Price</th>
                      <th>Select</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                  ${data.filterArry.map((filter, filterIndex) => `
                  <tr>
                    <td class='rowFilterID' style='display:none;'>${filter.id}</td>
                    <td class='rowServicePackageID' style='display:none;'>${plist.id}</td>
                    <td class='rowServicePackageCode' style='display:none;'>${plist.code}</td>
                    <td class='rowServicePackageName' style='display:none;'>${plist.package_name}</td>
                      <td>${filterIndex + 1}</td>
                      <td>${filter.name}</td>
                      <td>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">LKR</span>
                              </div>
                              <input value="${filter.price}" type="text" class="form-control FilterPrice">
                              <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="custom-control custom-radio">
                              <input class="custom-control-input filter-radio" type="radio" id="filterRadio${counterId + 1}_${filterIndex + 1}" name="filterRadio${counterId + 1}">
                              <label for="filterRadio${counterId + 1}_${filterIndex + 1}" class="custom-control-label"></label>
                          </div>
                      </td>
                  </tr>
              `).join('')}

                  </tbody>
                  </table>
              </div>
              </div>

          </p>
          </td>
      </tr>`);
   
      
          
          tableBodyServicePackage.append(row);
        
  
          var item = {
            rowServicePackageID: row.find(".rowServicePackageID")[0],
            rowServicePackageCode: row.find(".rowServicePackageCode")[0],
            rowServicePackageName: row.find(".rowServicePackageName")[0]
          };
          service_packages_items.push(item);

          // -------------- Fuel Type --------------
          var itemFuel = {
            rowServicePackageID: row.find(".rowServicePackageID")[0],
            rowServicePackageCode: row.find(".rowServicePackageCode")[0],
            rowServicePackageName: row.find(".rowServicePackageName")[0],
            rowFuelID: row.find(".rowFuelID")[0],
            FuelPrice: row.find(".FuelPrice")[0]
          };
          service_packages_items_fuel.push(itemFuel);

          // -------------- Filter Type
          var itemFilter = {
            rowServicePackageID: row.find(".rowServicePackageID")[0],
            rowServicePackageCode: row.find(".rowServicePackageCode")[0],
            rowServicePackageName: row.find(".rowServicePackageName")[0],
            rowFilterID: row.find(".rowFilterID")[0],
            FilterPrice: row.find(".FilterPrice")[0]
          };

          service_packages_items_filter.push(itemFilter);
  

        });


      }
  
    });

    // --------------- Calculate Price
    function calculateServicePackageTotal() {
      // -- Fuel Type
      let totalAmount=0;

      selected_filter.forEach((filter) =>{
        totalAmount += Number.parseInt(filter.price)
      })

      selected_fuel.forEach((fuel) =>{
        totalAmount += Number.parseInt(fuel.price)
      })
  
      $("#service-package-total").text(totalAmount.toFixed(2));

      console.log(selected_filter)
      console.log(selected_fuel)

  
    }

    // ------------- Selected Lubricant Type -------
    $(document).on('change', '.fuel-radio', function() {
      if ($(this).is(':checked')) {
          const ServicePackageId = $(this).closest('tr').find('.rowServicePackageID').text();
          const selectedPrice = $(this).closest('tr').find('.FuelPrice').val();
          const ServicePackageName = $(this).closest('tr').find('.rowServicePackageName').text()
          const ServicePackageCode = $(this).closest('tr').find('.rowServicePackageCode').text()
          const selectedId = $(this).closest('tr').find('.rowFuelID').text();
          console.log('Selected Service Package ID:', ServicePackageId);
          console.log('Selected Price:', selectedPrice);
          console.log('Selected Fuel ID:', selectedId);
          console.log("Fuel Type");
          console.log(ServicePackageCode);

          selected_fuel = selected_fuel.filter(item => !(item.ServicePackageId == ServicePackageId));


          let i = {
            ServicePackageId,
            ServicePackageName,
            ServicePackageCode,
            price:selectedPrice,
            typeId:selectedId
          }

          selected_fuel.push(i)

          calculateServicePackageTotal()
          
      }
  });
  
    // ------------- Selected Filter Type -------
    $(document).on('change', '.filter-radio', function() {
      if ($(this).is(':checked')) {
         const ServicePackageId = $(this).closest('tr').find('.rowServicePackageID').text();
          const selectedPrice = $(this).closest('tr').find('.FilterPrice').val();
          const selectedId = $(this).closest('tr').find('.rowFilterID').text();
          const ServicePackageCode = $(this).closest('tr').find('.rowServicePackageCode').text()
          const ServicePackageName = $(this).closest('tr').find('.rowServicePackageName').text()
          console.log('Selected Service Package ID:', ServicePackageId);
          console.log('Selected Price:', selectedPrice);
          console.log('Selected Filter ID:', selectedId);
          console.log();
          

          selected_filter = selected_filter.filter(item => !(item.ServicePackageId == ServicePackageId));

    
          let i = {
            ServicePackageId,
            ServicePackageName,
            ServicePackageCode,
            price:selectedPrice,
            typeId:selectedId
          }

          selected_filter.push(i)
          calculateServicePackageTotal()
      }
  });

    $("#tableServicePackage").on("click", ".deleteServicePackageItem", function () {
      var listItem = $(this).data('id');  

      let indexToRemove = selected_service_packages.findIndex(item => item.id == listItem);

      if (indexToRemove != -1) {
        selected_service_packages.splice(indexToRemove, 1);
      }

      //  --------------- Delete From Fuel Type Arr
      let indexToRemoveFuel = selected_fuel.findIndex(item => item.ServicePackageId == listItem);

      if (indexToRemoveFuel != -1) {
        selected_fuel.splice(indexToRemoveFuel, 1);
      }
      //  --------------- Delete From Filter Type Arr
      let indexToRemoveFilter = selected_filter.findIndex(item => item.ServicePackageId == listItem);

      if (indexToRemoveFilter != -1) {
        selected_filter.splice(indexToRemoveFilter, 1);
      }

  

      $(this).closest('tr').remove();

  

        console.log(selected_fuel)
        console.log(selected_filter)

        calculateServicePackageTotal()

  
  
    })

    $("#job-card-step-4").click(function () {
      stepper.next()
      console.log(selected_fuel)
      console.log(selected_filter)
    })
     // ---------------------------------------
    //  ---------------------- Step 4 -------------

    // --------------- Step 5 ------------
     // ---------------------------------------
    var dropdownRepair = document.getElementById("cmbrepair");
    var tableBodyRepair = $("#table-jobcard-repair");
    var repair_items = [];
    var selected_repairs = [];


    dropdownRepair.addEventListener("change", function () {
      var repairId = dropdownRepair.value;
      $.ajax({
        type: "POST",
        url: "../api/checkrepair.php",
        data: { 
          repairId: repairId,
          vehicleClassId: vehicle[0].vehicle_class_id
        },
        dataType: "json",
        success: function (data) {

            console.log(data)

            if(data.length == 0){
              return
            }
  
          // ---------------
          let foundRepairs = selected_repairs.some(repair => repair.id == repairId);
  
            if(foundRepairs){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Repair Already Exist",
              });
              return
  
            }else{
              populateTableRepairs(data);
              // console.log(data)
              selected_repairs.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });
  
      // Get All the Repairs List
      function populateTableRepairs(data) {
        console.log(data)

        data.forEach(function (plist) {
          var row = $("<tr>");
          row.append(`<td class='rowID' style='display:none;'>${plist.id}</td>`);
          row.append(`<td class='rowCode' style='display:none;'>${plist.code}</td>`);
          row.append(`<td class='rowName' style='display:none;'>${plist.name}</td>`);
          row.append(`<td>1.</td>`);
          row.append(`<td>${plist.name}</td>`);
          row.append(`<td>  
                <div class="input-group">
                <input value="1" type="text" class="form-control hours">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
                </div>
            </td>`);
          row.append(`<td>  
            <div class="input-group">
            <input value="${plist.price}" type="text" class="form-control unit-price">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
            </div>
          </td>`);
          row.append(`<td>  
          <div class="input-group">
          <input value="0" type="text" class="form-control discount">
          <div class="input-group-append">
              <span class="input-group-text">.00</span>
          </div>
          </div>
          </td>`);
          row.append(`<td>  
          <p class="h6 repair-total">400.00</p>
        </td>`);
          row.append(`<td>  
          <button data-id="${plist.id}" type="button" class="btn bg-gradient-danger deleteRepairItem"><i class="fas fa-trash"></i></button>
          </td>`);
          tableBodyRepair.append(row);
  
          // Add the new item to the items array
          var item = {
            rowCode: row.find(".rowCode")[0],
            rowName: row.find(".rowName")[0],
            rowID: row.find(".rowID")[0],
            HoursInput: row.find(".hours")[0],
            UnitPriceInput: row.find(".unit-price")[0],
            discountInput: row.find(".discount")[0],
            totalCell: row.find(".repair-total")[0],
          };
          repair_items.push(item);
  
          item.HoursInput.addEventListener("input", calculateRepairTotal);
          item.UnitPriceInput.addEventListener("input", calculateRepairTotal);
          item.discountInput.addEventListener("input", calculateRepairTotal);
  
          calculateRepairTotal();
        });


      }
  
    });

    function calculateRepairTotal() {
      var totalAmount = 0;
      var to = 0;
      var dis = 0;
      repair_items.forEach(function (item) {
        var hours = item.HoursInput.value == "" ? 0 :parseFloat(item.HoursInput.value);
        var unitPrice = item.UnitPriceInput.value == "" ? 0 : parseFloat(item.UnitPriceInput.value);
        var discount = item.discountInput.value == "" ? 0 : parseFloat(item.discountInput.value);
  
        var itemTotal = hours * unitPrice - discount;
        item.totalCell.textContent = itemTotal.toFixed(2);
  
        totalAmount += itemTotal;
        dis += discount;
  
      });
      $("#repair-final-total").text(totalAmount.toFixed(2));

      // calculateDisplay()
      // $("#dis").text(dis.toFixed(2));
  
      // $("#topaid").text(to.toFixed(2));
    }

    $("table.repairTable").on("click", ".deleteRepairItem", function () {
      var listItem = $(this).data('id');
      console.log(listItem)
  
      let indexToRemove = selected_repairs.findIndex(item => item.id == listItem);
  
      if (indexToRemove !== -1) {
        selected_repairs.splice(indexToRemove, 1);
      }
  
      // Items Array
      let indexToRemoveItems = repair_items.findIndex(item => item.rowID.innerText == listItem);
  
      if (indexToRemoveItems !== -1) {
        repair_items.splice(indexToRemoveItems, 1);
      }

      // -------------------- CALCULATE ---------------------------

      calculateRepairTotal()
      // ---------------------- CALCULATE -------------------------


      $(this).closest('tr').remove();
  
    })
   
    $("#job-card-step-5").click(function () {
      console.log("Job Card 5")
      stepper.next()
    })
     // ---------------------------------------
    // --------------- Step 5 ------------




    //  ------------------------------- Step 6 --------------------------
    var dropdownProducts = document.getElementById("cmbproducts");
    var tableBodyProducts = $("#table-jobcard-products");

    var products_items = [];
    var selected_products = [];

    dropdownProducts.addEventListener("change", function () {
      var productId = dropdownProducts.value;
      $.ajax({
        type: "POST",
        url: "../api/checkproduct.php",
        data: { productId: productId },
        dataType: "json",
        success: function (data) {

            console.log(data)

            if(data.length == 0){
              return
            }
  
          // // ---------------
          let foundSales = selected_products.some(product => product.id == productId);
  
          if(foundSales){

            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Product Already Exist",
            });
            return

          }else{
            populateTableProducts(data);
            console.log(data)
            selected_products.push(data[0])
            return
          }
  
          // ---------------
        },
        error: function () {},
      });
  
      function populateTableProducts(data) {
        data.forEach(function (plist,index) {
          var row = $("<tr>");
          row.append(`<td class='rowProductID' style='display:none;'>${plist.id}</td>`);
          row.append(`<td class='rowProductCode' style='display:none;'>${plist.code}</td>`);
          row.append(`<td class='rowProductName' style='display:none;'>${plist.product_name}</td>`);
          row.append(`<td>${index + 1}.</td>`);
          row.append(`<td>${plist.product_name}</td>`);
          row.append(`<td>  
          <div class="input-group">
          <input value="${plist.quantity}" type="text" class="form-control quantityQty">
          <div class="input-group-append">
              <span class="input-group-text">.00</span>
          </div>
          </div>
          </td>`);
          row.append(` <td>  
          <div class="input-group">
          <input value="${plist.selling_price}" type="text" class="form-control unitPriceProduct">
          <div class="input-group-append">
              <span class="input-group-text">.00</span>
          </div>
          </div>
        </td>`);
          row.append(`<td>  
          <div class="input-group">
          <input value="0" type="text" class="form-control discountProduct">
          <div class="input-group-append">
              <span class="input-group-text">.00</span>
          </div>
          </div>
        </td>`);
          row.append(`<td>  
          <p class="h6 totalProduct">400.00</p>
          </td>`);
          row.append(`<td><button data-id="${plist.id}" type="button" class="btn bg-gradient-danger deleteProductsItem"><i class="fas fa-trash"></i></button></td>`);
          tableBodyProducts.append(row);
  
        //   // Add the new item to the items array
          var item = {
            rowID: row.find(".rowProductID")[0],
            rowCode: row.find(".rowProductCode")[0],
            rowName: row.find(".rowProductName")[0],
            quantityInput: row.find(".quantityQty")[0],
            priceInput: row.find(".unitPriceProduct")[0],
            discountInput: row.find(".discountProduct")[0],
            totalCell: row.find(".totalProduct")[0],
          };
          products_items.push(item);
  
          item.quantityInput.addEventListener("input", calculateProductTotal);
          item.priceInput.addEventListener("input", calculateProductTotal);
          item.discountInput.addEventListener("input", calculateProductTotal);
  
          calculateProductTotal();
        });
      }
  
    });

    function calculateProductTotal() {
      var totalAmount = 0;
  
      var dis = 0;
      products_items.forEach(function (item) {
        var quantity = item.quantityInput.value == "" ? 0 :parseFloat(item.quantityInput.value);
        var price = item.priceInput.value == "" ? 0 : parseFloat(item.priceInput.value);
        var discount = item.discountInput.value == "" ? 0 : parseFloat(item.discountInput.value);
  
        var itemTotal = quantity * price - discount;
        item.totalCell.textContent = itemTotal.toFixed(2);
  
        totalAmount += itemTotal;
        dis += discount;
      });
      $("#total-final-product").text(totalAmount.toFixed(2));

      // calculateDisplay()
      // $("#dis").text(dis.toFixed(2));
  
      // $("#topaid").text(to.toFixed(2));
    }

    $("table.productsTable").on("click", ".deleteProductsItem", function () {
      var listItem = $(this).data('id');
      console.log(listItem)
  
      let indexToRemove = selected_products.findIndex(item => item.id == listItem);
  
      if (indexToRemove !== -1) {
        selected_products.splice(indexToRemove, 1);
      }
  
      // Items Array
      let indexToRemoveItems = products_items.findIndex(item => item.rowID.innerText == listItem);
  
      if (indexToRemoveItems !== -1) {
        products_items.splice(indexToRemoveItems, 1);
      }

      // -------------------- CALCULATE ---------------------------

      calculateProductTotal()
      // ---------------------- CALCULATE -------------------------


      $(this).closest('tr').remove();
  
    })

    $("#job-card-step-6").click(function () {
  

      // ------------------------- Service Package  --------------------
      console.log(service_packages_items)
      console.log(service_packages_items_fuel)
      console.log(service_packages_items_filter)
      console.log(selected_fuel)
      console.log(selected_filter)
      // ------------------------- Service Package  --------------------

      // ------------------------- Repair Package  --------------------
      console.log(repair_items)
      console.log(selected_repairs)

      // ------------------------- Washer  --------------------
      console.log(items)
      console.log(WasherValues)
      // ------------------------- Washer  --------------------

      // ------------------------- Products  --------------------
      console.log(products_items)
      console.log(selected_products)
      // ------------------------- Products  --------------------

      getInvoiceDetails(vehicle,serviceStationInfo)


      stepper.next()
    })

    //  ------------------------------- Step 6 --------------------------



    // -------------------------- Step 7 ----------------------------
    function getInvoiceDetails(vehicle,serviceStationInfo) {
      
      $("#in_vehicle_no").text(`${vehicle[0].vehicle_number}`);
      $("#in_jobcard_no").text(`${jobCardCode}`);
      $("#in_invoice_no").text(`${invoiceCode}`);
      $("#in_vehicle_owner").text(`${vehicle[0].first_name} ${vehicle[0].last_name}`);
      $("#in_address").text(`${vehicle[0].address}`);
      $("#in_contact_number").text(`${vehicle[0].phone}`);
      $("#in_model").text(`${vehicle[0].vehicle_model_name}`);
      $("#in_make").text(`${vehicle[0].vehicle_make_name}`);
      $("#in_current_mileage").text(`${current_mileage} KM`);
      $("#in_next_mileage").text(`${new_mileage} KM`);
      $("#in_chassis_no").text(`${vehicle[0].chassis_number}`);
      $("#in_engine_no").text(`${vehicle[0].engine_number}`);
      $("#in_payment_method").text(`${vehicle[0].engine_number}`);
      $("#in_station_name").text(`${serviceStationInfo[0].service_name}`);
      $("#in_station_address").text(`${serviceStationInfo[0].address == null ? "NULL" : `${serviceStationInfo[0].address} ${serviceStationInfo[0].street} ${serviceStationInfo[0].city}`}`);
      $("#in_station_phone").text(`${serviceStationInfo[0].phone == null ? "NULL" : serviceStationInfo[0].phone}`);
      $("#in_station_email").text(`${serviceStationInfo[0].email == null ? "NULL" : serviceStationInfo[0].email}`);
      $('#in_station_logo').attr('src', serviceStationInfo[0].logo == null ? "" : `../uploads/stations/${serviceStationInfo[0].logo}`);
      
      if(job_card_type == "1"){
        $("#in_job_card_type").text(`Washer Only`);
      }else if(job_card_type == "2"){
        $("#in_job_card_type").text(`Repair Only`);
      }else if(job_card_type == "3"){
        $("#in_job_card_type").text(`Service Only`);
      }else if(job_card_type == "4"){
        $("#in_job_card_type").text(`Washer & Repair Only`);
      }else if(job_card_type == "5"){
        $("#in_job_card_type").text(`Washer & Service Only`);
      }else if(job_card_type == "6"){
        $("#in_job_card_type").text(`ALL`);
      }


      $("#in_opening_date").text(`${formattedDate}`);
      


      // Calculate Sub Total
      calculateSubtotal()

      // Total
      displayCalculation()

      
      //  ---------- LOAD Table
      $('#tb_jobcard_items').html(`
          ${items.map((wash) => {
              return `
              <tr>
              <td>${wash.rowCode.innerText}</td>
              <td class="text-uppercase">Wash</td>
              <td>${wash.quantityInput.value}</td>
              <td>${wash.priceInput.value}</td>
              <td>${wash.discountInput.value}</td>
              <td>${wash.totalCell.innerText}</td>
          </tr>
                  `;
          }).join('')}

          ${repair_items.map((repair) => {
            return `
            <tr>
            <td>${repair.rowCode.innerText}</td>
            <td class="text-uppercase">${repair.rowName.innerText}</td>
            <td>${repair.HoursInput.value}</td>
            <td>${repair.UnitPriceInput.value}</td>
            <td>${repair.discountInput.value}</td>
            <td>${repair.totalCell.innerText}</td>
        </tr>
                `;
        }).join('')}

        ${products_items.map((product) => {
          return `
          <tr>
          <td>${product.rowCode.innerText}</td>
          <td class="text-uppercase">${product.rowName.innerText}</td>
          <td>${product.quantityInput.value}</td>
          <td>${product.priceInput.value}</td>
          <td>${product.discountInput.value}</td>
          <td>${product.totalCell.innerText}</td>
      </tr>
              `;
      }).join('')}

      ${service_packages_items.map((spitems) => {

         // Get the service package ID
      const servicePackageId = spitems.rowServicePackageID.innerText;

      // Initialize variables for fuel and filter totals
      let fuelTotal = 0;
      let filterTotal = 0;

      // Calculate fuel total
      service_packages_items_fuel.forEach((fuelItem) => {
          if (fuelItem.rowServicePackageID.innerText  == servicePackageId) {
              fuelTotal += parseFloat(fuelItem.FuelPrice.value);
          }
      });

      // Calculate filter total
      service_packages_items_filter.forEach((filterItem) => {
          if (filterItem.rowServicePackageID.innerText  == servicePackageId) {
              filterTotal += parseFloat(filterItem.FilterPrice.value);
          }
      });

      // Calculate total
      const total = fuelTotal + filterTotal;

        return `
        <tr>
        <td>${spitems.rowServicePackageCode.innerText}</td>
        <td class="text-uppercase">${spitems.rowServicePackageName.innerText}</td>
        <td>1</td>
        <td>1</td>
        <td>0</td>
        <td>${Number.parseFloat(total).toFixed(2)}</td>
    </tr>
            `;
    }).join('')}


      `);


    }


    function calculateSubtotal() {

      // Initialize total variable
      let grandTotal = 0;

      // Calculate total for 'items'
      grandTotal += items.reduce((total, wash) => {
          return total + parseFloat(wash.totalCell.innerText);
      }, 0);

      // Calculate total for 'repair_items'
      grandTotal += repair_items.reduce((total, repair) => {
          return total + parseFloat(repair.totalCell.innerText);
      }, 0);

      // Calculate total for 'products_items'
      grandTotal += products_items.reduce((total, product) => {
          return total + parseFloat(product.totalCell.innerText);
      }, 0);

      // Calculate total for 'service_packages_items'
      grandTotal += service_packages_items.reduce((total, spitems) => {
          // Get the service package ID
          const servicePackageId = spitems.rowServicePackageID.innerText;

          // Initialize variables for fuel and filter totals
          let fuelTotal = 0;
          let filterTotal = 0;
          let totalCal = 0;

          // Calculate fuel total
          service_packages_items_fuel.forEach((fuelItem) => {
              if (fuelItem.rowServicePackageID.innerText == servicePackageId) {
                  fuelTotal += parseFloat(fuelItem.FuelPrice.value);
              }
          });

          // Calculate filter total
          service_packages_items_filter.forEach((filterItem) => {
              if (filterItem.rowServicePackageID.innerText == servicePackageId) {
                  filterTotal += parseFloat(filterItem.FilterPrice.value);
              }
          });

          // Calculate total
           totalCal = fuelTotal + filterTotal;

          return total + parseFloat(totalCal);
      }, 0);


      $("#in_subtotal").text(`${grandTotal}`);
      
      
    }

    function displayCalculation(){
      const VAT_value = VAT.value === "" ? 0 : parseFloat(VAT.value);
      const subtotal = parseFloat($("#in_subtotal").text());
      const final = subtotal + (subtotal * VAT_value / 100);
      $("#in_vat").text(`${VAT_value}`);
      $("#in_total").text(final.toFixed(2));
      
      
    }

    $("#submit_jobcard").click(function () {


       // SHOW LOADING BTN
       document.getElementById("submit_jobcard").style.display = "none"
       document.getElementById("btn-loading").style.display = "inline-block"
       
        if(job_card_type == "1"){

          $.ajax({
            type: "POST",
            url: "../api/add-jobcardwasher.php",
            data: {
                jobcardcode:jobCardCode,
                jobcardInvoicecode:invoiceCode,
                status:status,
                paid_status:paid_status,
                job_card_type:job_card_type,
                vehicle_id:vehicle[0].vehicle_id,
                vehicle_owner_id:vehicle[0].vehicle_owner_id,
                vat:VAT.value,
                vehicle_number:vehicle[0].vehicle_number,
                washers:JSON.stringify(WasherValues),
                vehicleDetails:JSON.stringify(vehicle),
                
                station:JSON.stringify(serviceStationInfo)
            },
            success: function (response) {
              
                console.log(response)
  
            if (response === "success") {
            Swal.fire({
                icon: "success",
                title: "Job Card Created!",
                text: "The job card has been added successfully.",
                confirmButtonColor: "#007bff",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../job-cards/";
                }
            });  
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Please Try Again",
                    text: "Something Went Wrong",
                });
            }
  
            },
            error:function (error) {
                console.log(error)
            }
        });


        }else if(job_card_type == "2"){

              const repairArr = repair_items.map(repair => ({
                repairID:repair.rowID.innerText,
                repairCode:repair.rowCode.innerText,
                repairName:repair.rowName.innerText,
                hours:repair.HoursInput.value,
                price:repair.UnitPriceInput.value,
                discount:repair.discountInput.value,
                total: repair.totalCell.innerText
            }));

            const productArr = products_items.map(product => ({
              productID:product.rowID.innerText,
              productCode:product.rowCode.innerText,
              productName:product.rowName.innerText,
              qty:product.quantityInput.value,
              price:product.priceInput.value,
              discount:product.discountInput.value,
              total: product.totalCell.innerText
          }));





          $.ajax({
            type: "POST",
            url: "../api/add-jobcardrepair.php",
            data: {
                jobcardcode:jobCardCode,
                jobcardInvoicecode:invoiceCode,
                status:status,
                paid_status:paid_status,
                job_card_type:job_card_type,
                vehicle_id:vehicle[0].vehicle_id,
                vehicle_owner_id:vehicle[0].vehicle_owner_id,
                vat:VAT.value,
                vehicle_number:vehicle[0].vehicle_number,
                repairs:JSON.stringify(repairArr),
                products:JSON.stringify(productArr),
                vehicleDetails:JSON.stringify(vehicle),
                station:JSON.stringify(serviceStationInfo)
                
            },
            success: function (response) {
              
                console.log(response)
  
                if (response === "success") {
                  window.location.href = "../job-cards/";    
              }else {
                  Swal.fire({
                      icon: "error",
                      title: "Please Try Again",
                      text: "Something Went Wrong",
                  });
              }
  
            },
            error:function (error) {
                console.log(error)
            }
        });



        }else if(job_card_type == "3"){

          // console.log(rowVehicleReportData)

          // --------------------- Vehicle Report --------------

          function isEmpty(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        }

        let VehicleReportArr;
        

         VehicleReportArr = rowVehicleReportData.map(obj => {
            
            if (isEmpty(obj)) {
                return {
                    categoryId: 0,
                    subcategoryId: 0,
                    value: 0
                };
            } else {
                // Otherwise, return the object as it is
                return obj;
            }
        });

        console.log(VehicleReportArr)
   

        // --------------------- Vehicle Report --------------

          let NextDate;

        if(notify == "2"){
          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 2);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

          NextDate = formattedDate
        }else if(notify == "4"){

          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 4);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
          console.log(formattedDate);

          NextDate = formattedDate

        }else if(notify == "6"){
          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 6);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

          NextDate = formattedDate

        }
        ;
   

          $.ajax({
            type: "POST",
            url: "../api/add-jobcardservice.php",
            data: {
                jobcardcode:jobCardCode,
                jobcardInvoicecode:invoiceCode,
                status:status,
                paid_status:paid_status,
                job_card_type:job_card_type,
                vehicle_id:vehicle[0].vehicle_id,
                vehicle_owner_id:vehicle[0].vehicle_owner_id,
                vat:VAT.value,
                vehicle_number:vehicle[0].vehicle_number,
                notifyMonth:notify,
                notifyDate:NextDate,
                current_mileage,
                new_mileage,
                fuels:JSON.stringify(selected_fuel),
                filters:JSON.stringify(selected_filter),
                vehicle_reports:JSON.stringify(VehicleReportArr),
                selectedServicePackages:JSON.stringify(service_packages_items),
                vehicleDetails:JSON.stringify(vehicle),
                station:JSON.stringify(serviceStationInfo)
            },
            success: function (response) {
              
                console.log(response)
  
                if (response === "success") {
                  window.location.href = "../job-cards/";    
              }else {
                  Swal.fire({
                      icon: "error",
                      title: "Please Try Again",
                      text: "Something Went Wrong",
                  });
              }
  
            },
            error:function (error) {
                console.log(error)
            }
        });

        }else if(job_card_type == "4"){

          const repairArr = repair_items.map(repair => ({
            repairID:repair.rowID.innerText,
            repairCode:repair.rowCode.innerText,
            repairName:repair.rowName.innerText,
            hours:repair.HoursInput.value,
            price:repair.UnitPriceInput.value,
            discount:repair.discountInput.value,
            total: repair.totalCell.innerText
        }));

        const productArr = products_items.map(product => ({
          productID:product.rowID.innerText,
          productCode:product.rowCode.innerText,
          productName:product.rowName.innerText,
          qty:product.quantityInput.value,
          price:product.priceInput.value,
          discount:product.discountInput.value,
          total: product.totalCell.innerText
      }));


          $.ajax({
            type: "POST",
            url: "../api/add-jobcardwasher-repair.php",
            data: {
                jobcardcode:jobCardCode,
                jobcardInvoicecode:invoiceCode,
                status:status,
                paid_status:paid_status,
                job_card_type:job_card_type,
                vehicle_id:vehicle[0].vehicle_id,
                vehicle_owner_id:vehicle[0].vehicle_owner_id,
                vat:VAT.value,
                vehicle_number:vehicle[0].vehicle_number,
                washers:JSON.stringify(WasherValues),
                repairs:JSON.stringify(repairArr),
                products:JSON.stringify(productArr),
                vehicleDetails:JSON.stringify(vehicle),
                station:JSON.stringify(serviceStationInfo)
            },
            success: function (response) {
              
                console.log(response)
  
                if (response === "success") {
                  window.location.href = "../job-cards/";    
              }else {
                  Swal.fire({
                      icon: "error",
                      title: "Please Try Again",
                      text: "Something Went Wrong",
                  });
              }
  
            },
            error:function (error) {
                console.log(error)
            }
        });

        }else if(job_card_type == "5"){

          // --------------------- Vehicle Report --------------

          function isEmpty(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        }

        let VehicleReportArr;
        

         VehicleReportArr = rowVehicleReportData.map(obj => {
            
            if (isEmpty(obj)) {
                return {
                    categoryId: 0,
                    subcategoryId: 0,
                    value: 0
                };
            } else {
                // Otherwise, return the object as it is
                return obj;
            }
        });

        console.log(VehicleReportArr)

        // --------------------- Vehicle Report --------------

          let NextDate;

        if(notify == "2"){
          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 2);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

          NextDate = formattedDate
        }else if(notify == "4"){

          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 4);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
          console.log(formattedDate);

          NextDate = formattedDate

        }else if(notify == "6"){
          const currentDate = new Date();
  
          // Add 2 months to the current date
          currentDate.setMonth(currentDate.getMonth() + 6);
  
          // Get day, month, and year from the new date
          const day = currentDate.getDate();
          const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
          const year = currentDate.getFullYear();
  
          // Pad single-digit day and month with leading zero if needed
          const formattedDay = day < 10 ? `0${day}` : day;
          const formattedMonth = month < 10 ? `0${month}` : month;
  
          // Format date as "DD-MM-YYYY"
          const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;

          NextDate = formattedDate

        }

          $.ajax({
            type: "POST",
            url: "../api/add-jobcardwasher-service.php",
            data: {
                jobcardcode:jobCardCode,
                jobcardInvoicecode:invoiceCode,
                status:status,
                paid_status:paid_status,
                job_card_type:job_card_type,
                vehicle_id:vehicle[0].vehicle_id,
                vehicle_owner_id:vehicle[0].vehicle_owner_id,
                vat:VAT.value,
                vehicle_number:vehicle[0].vehicle_number,
                notifyMonth:notify,
                notifyDate:NextDate,
                current_mileage,
                new_mileage,
                selectedServicePackages:JSON.stringify(service_packages_items),
                fuels:JSON.stringify(selected_fuel),
                filters:JSON.stringify(selected_filter),
                vehicle_reports:JSON.stringify(VehicleReportArr),
                washers:JSON.stringify(WasherValues),
                vehicleDetails:JSON.stringify(vehicle),
                station:JSON.stringify(serviceStationInfo)
            },
            success: function (response) {
              
                console.log(response)
  
                if (response === "success") {
                  window.location.href = "../job-cards/";    
              }else {
                  Swal.fire({
                      icon: "error",
                      title: "Please Try Again",
                      text: "Something Went Wrong",
                  });
              }
  
            },
            error:function (error) {
                console.log(error)
            }
        });


        }else if(job_card_type == "6"){

          //  ------------------- Repair ---------------------
          const repairArr = repair_items.map(repair => ({
            repairID:repair.rowID.innerText,
            repairCode:repair.rowCode.innerText,
            repairName:repair.rowName.innerText,
            hours:repair.HoursInput.value,
            price:repair.UnitPriceInput.value,
            discount:repair.discountInput.value,
            total: repair.totalCell.innerText
        }));

        const productArr = products_items.map(product => ({
          productID:product.rowID.innerText,
          productCode:product.rowCode.innerText,
          productName:product.rowName.innerText,
          qty:product.quantityInput.value,
          price:product.priceInput.value,
          discount:product.discountInput.value,
          total: product.totalCell.innerText
      }));

             // --------------------- Vehicle Report --------------

             function isEmpty(obj) {
              return Object.keys(obj).length === 0 && obj.constructor === Object;
          }
  
          let VehicleReportArr;
          
  
           VehicleReportArr = rowVehicleReportData.map(obj => {
              
              if (isEmpty(obj)) {
                  return {
                      categoryId: 0,
                      subcategoryId: 0,
                      value: 0
                  };
              } else {
                  // Otherwise, return the object as it is
                  return obj;
              }
          });
  
          console.log(VehicleReportArr)
  
          // --------------------- Vehicle Report --------------
  
            let NextDate;
  
          if(notify == "2"){
            const currentDate = new Date();
    
            // Add 2 months to the current date
            currentDate.setMonth(currentDate.getMonth() + 2);
    
            // Get day, month, and year from the new date
            const day = currentDate.getDate();
            const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
            const year = currentDate.getFullYear();
    
            // Pad single-digit day and month with leading zero if needed
            const formattedDay = day < 10 ? `0${day}` : day;
            const formattedMonth = month < 10 ? `0${month}` : month;
    
            // Format date as "DD-MM-YYYY"
            const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
  
            NextDate = formattedDate
          }else if(notify == "4"){
  
            const currentDate = new Date();
    
            // Add 2 months to the current date
            currentDate.setMonth(currentDate.getMonth() + 4);
    
            // Get day, month, and year from the new date
            const day = currentDate.getDate();
            const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
            const year = currentDate.getFullYear();
    
            // Pad single-digit day and month with leading zero if needed
            const formattedDay = day < 10 ? `0${day}` : day;
            const formattedMonth = month < 10 ? `0${month}` : month;
    
            // Format date as "DD-MM-YYYY"
            const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
            console.log(formattedDate);
  
            NextDate = formattedDate
  
          }else if(notify == "6"){
            const currentDate = new Date();
    
            // Add 2 months to the current date
            currentDate.setMonth(currentDate.getMonth() + 6);
    
            // Get day, month, and year from the new date
            const day = currentDate.getDate();
            const month = currentDate.getMonth() + 1; // Adding 1 since months are 0-indexed
            const year = currentDate.getFullYear();
    
            // Pad single-digit day and month with leading zero if needed
            const formattedDay = day < 10 ? `0${day}` : day;
            const formattedMonth = month < 10 ? `0${month}` : month;
    
            // Format date as "DD-MM-YYYY"
            const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
  
            NextDate = formattedDate
  
          }
  
            $.ajax({
              type: "POST",
              url: "../api/add-jobcard-all.php",
              data: {
                  jobcardcode:jobCardCode,
                  jobcardInvoicecode:invoiceCode,
                  status:status,
                  paid_status:paid_status,
                  job_card_type:job_card_type,
                  vehicle_id:vehicle[0].vehicle_id,
                  vehicle_owner_id:vehicle[0].vehicle_owner_id,
                  vat:VAT.value,
                  vehicle_number:vehicle[0].vehicle_number,
                  notifyMonth:notify,
                  notifyDate:NextDate,
                  current_mileage,
                  new_mileage,
                  selectedServicePackages:JSON.stringify(service_packages_items),
                  fuels:JSON.stringify(selected_fuel),
                  filters:JSON.stringify(selected_filter),
                  vehicle_reports:JSON.stringify(VehicleReportArr),
                  washers:JSON.stringify(WasherValues),
                  repairs:JSON.stringify(repairArr),
                  products:JSON.stringify(productArr),
                  vehicleDetails:JSON.stringify(vehicle),
                  station:JSON.stringify(serviceStationInfo)
              },
              success: function (response) {
                
                  console.log(response)
    
                  if (response === "success") {
                    window.location.href = "../job-cards/";    
                }else {
                    Swal.fire({
                        icon: "error",
                        title: "Please Try Again",
                        text: "Something Went Wrong",
                    });
                }
    
              },
              error:function (error) {
                  console.log(error)
              }
          });
  

        }


    })
    
    // -------------------------- Step 7 ----------------------------


  });
  
  