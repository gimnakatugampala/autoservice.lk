$(document).ready(function () {
    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getServiceRecords());
    var ServiceRecordsBody = $("#tb_service_records");

    function getServiceRecords(){
        $.ajax({
          type: "POST",
          url: "../api/getservicerecords.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
    
           
            $("#service-records-vnumber").text(data.VehicleNumber);

            populateTableServiceRecords(data)
    
          },
          error: function () {},
        });


        function populateTableServiceRecords(data) {
            data.jobcards.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>${list.JOB_CARD_CODE}</td>`);
              row.append(`<td>${list.SERVICE_STATION_NAME}</td>`);
              row.append(`<td>${list.JOB_CARD_TYPE_NAME}</td>`);
              if(list.JOB_CARD_STATUS == "Canceled"){
                  row.append(`<td><span class="badge badge-danger">${list.JOB_CARD_STATUS}</span></td>`);
              }else if(list.JOB_CARD_STATUS == "Completed"){
                row.append(`<td><span class="badge badge-success">${list.JOB_CARD_STATUS}</span></td>`);
              }else if(list.JOB_CARD_STATUS == "Pending"){
                row.append(`<td><span class="badge badge-primary">${list.JOB_CARD_STATUS}</span></td>`);
              }
              row.append(`<td>${list.CREATED_DATE}</td>`);
              row.append(`<td>${list.COMPLETED_DATE == null ? "" : list.COMPLETED_DATE}</td>`);
              row.append(`<td>${list.CURRENT_MILEAGE == null ? "" : list.CURRENT_MILEAGE}</td>`);
              if(list.JOB_CARD_TYPE_ID != 1){
                row.append(` <td>
              <a href="../vehicle-search/service-record-details.php?code=${list.JOB_CARD_CODE}" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg">
                  <i class="fas fa-chart-line"></i>
              </button>
              </td>`);  
              }else{
                row.append(` <td>
                <a href="../vehicle-search/service-record-details.php?code=${list.JOB_CARD_CODE}" type="button" class="btn bg-gradient-primary"><i class="fas fa-eye"></i></a>
                </td>`);
              }
              row.append("</tr>");
             
              ServiceRecordsBody.append(row);
 
      
             
            });
          }
    
      }


    

})