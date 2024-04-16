$(document).ready(function () {
  // Get The Code From URL
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get('code');

  document.addEventListener('DOMContentLoaded', getServiceRecords());
  var ServiceRecordsBody = $("#tb_service_records");

  function getServiceRecords() {
      $.ajax({
          type: "POST",
          url: "../api/getservicerecords.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
              console.log(data);

              $("#service-records-vnumber").text(data.VehicleNumber);

              populateTableServiceRecords(data);

          },
          error: function () {},
      });


      function populateTableServiceRecords(data) {
          data.jobcards.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>${list.JOB_CARD_CODE}</td>`);
              row.append(`<td>${list.SERVICE_STATION_NAME}</td>`);
              row.append(`<td>${list.JOB_CARD_TYPE_NAME}</td>`);
              if (list.JOB_CARD_STATUS == "Canceled") {
                  row.append(`<td><span class="badge badge-danger">${list.JOB_CARD_STATUS}</span></td>`);
              } else if (list.JOB_CARD_STATUS == "Completed") {
                  row.append(`<td><span class="badge badge-success">${list.JOB_CARD_STATUS}</span></td>`);
              } else if (list.JOB_CARD_STATUS == "Pending") {
                  row.append(`<td><span class="badge badge-primary">${list.JOB_CARD_STATUS}</span></td>`);
              }
              row.append(`<td>${list.CREATED_DATE}</td>`);
              row.append(`<td>${list.COMPLETED_DATE == null ? "" : list.COMPLETED_DATE}</td>`);
              row.append(`<td>${list.CURRENT_MILEAGE == null ? "" : list.CURRENT_MILEAGE}</td>`);
              if (list.JOB_CARD_TYPE_ID != 1) {
                  row.append(` <td>
            <a href="../vehicle-search/service-record-details.php?code=${list.JOB_CARD_CODE}" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
            <button  type="button" class="btn btn-warning view-service-records-details" data-toggle="modal" data-target="#modal-lg" data-job-card-id="${list.JOB_CARD_ID}">
                <i class="fas fa-chart-line"></i>
            </button>
            </td>`);
              } else {
                  row.append(` <td>
              <a href="../vehicle-search/service-record-details.php?code=${list.JOB_CARD_CODE}" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
              </td>`);
              }
              row.append("</tr>");

              ServiceRecordsBody.append(row);
          });
      }

  }

  // Click event handler for view-service-records-details
  $(document).on('click', '.view-service-records-details', function () {

   

      // Get the job card code associated with the clicked button
      var jobCardId = $(this).data('job-card-id');

      getVehicleReport(jobCardId)

      // Do something with the job card code, such as opening a modal or loading more details
      console.log("Viewing details for job card: " + jobCardId);
      // Example: Open modal
      $('#modal-lg').modal('show');
  });


  function getVehicleReport(jobCardId){

    $.ajax({
      type: "POST",
      url: "../api/getvehiclereportservicerecords.php",
      data: { jobCardId: jobCardId },
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
                        ${data.job_card_vehicle_report
                            .filter(subcategory => subcategory.vehicle_condition_category_id == category.id).map(subcategory => {
                          return `
                          <tr data-category-id="${category.id}" data-subcategory-id="${subcategory.id}">
                                  <td>${subcategory.sub_category}</td>
                                  <input type="hidden" value="${subcategory.id}">
                                  <td> 
                                      <div class="form-check">
                                          <input value="1" class="form-check-input" type="radio" name="radio${subcategory.id}" ${subcategory.value_id == "1" ? "checked" : ""} ${shouldDisable(subcategory.value_id, 1)}>
                                          <label class="form-check-label">Worse</label>
                                      </div>
                                  </td>
                                  <td> 
                                      <div class="form-check">
                                          <input value="2" class="form-check-input" type="radio" name="radio${subcategory.id}" ${subcategory.value_id == "2" ? "checked" : ""} ${shouldDisable(subcategory.value_id, 2)}>
                                          <label class="form-check-label">Bad</label>
                                      </div>
                                  </td>
                                  <td> 
                                      <div class="form-check">
                                          <input value="3" class="form-check-input" type="radio" name="radio${subcategory.id}" ${subcategory.value_id == "3" ? "checked" : ""} ${shouldDisable(subcategory.value_id, 3)}>
                                          <label class="form-check-label">Ok</label>
                                      </div>
                                  </td>
                                  <td> 
                                      <div class="form-check">
                                          <input value="4" class="form-check-input" type="radio" name="radio${subcategory.id}" ${subcategory.value_id == "4" ? "checked" : ""} ${shouldDisable(subcategory.value_id, 4)}>
                                          <label class="form-check-label">Good</label>
                                      </div>
                                  </td>
                                  <td> 
                                      <div class="form-check">
                                          <input value="5" class="form-check-input" type="radio" name="radio${subcategory.id}" ${subcategory.value_id == "5" ? "checked" : ""} ${shouldDisable(subcategory.value_id, 5)}>
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
    
    function shouldDisable(valueId, desiredId) {
        return valueId != desiredId ? "disabled" : "";
    }
    
    }

  }

});
