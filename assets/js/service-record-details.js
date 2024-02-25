$(document).ready(function () {
    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getServiceRecords());
    var ServiceRecordsRepairBody = $("#tb_service_record_repair");
    var ServiceRecordsProductBody = $("#tb_service_record_products");
    var ServiceRecordsWasherBody = $("#tb_service_record_washer");

    function getServiceRecords(){
        $.ajax({
          type: "POST",
          url: "../api/getservice-records-details.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
    
           
            // $("#service-records-vnumber").text(data.VehicleNumber);

            populateTableServiceRecordsRepair(data)
            populateTableServiceRecordsProduct(data)
            populateTableServiceRecordsWasher(data)
    
          },
          error: function () {},
        });


        function populateTableServiceRecordsRepair(data) {
            data.repairs.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>${list.name}</td>`);
              row.append(`<td>${list.hours}</td>`);
              row.append("</tr>");
             
              ServiceRecordsRepairBody.append(row);
 
      
             
            });
          }

          function populateTableServiceRecordsProduct(data) {
            data.products.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>${list.product_name}</td>`);
              row.append(`<td>${list.qty}</td>`);
              row.append("</tr>");
             
              ServiceRecordsProductBody.append(row);
      
             
            });
          }

          function populateTableServiceRecordsWasher(data) {
            data.washer.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>Washer</td>`);
              row.append(`<td>${list.qty}</td>`);
              row.append("</tr>");
             
              ServiceRecordsWasherBody.append(row);
      
             
            });
          }
    
      }


    

})