$(document).ready(function () {
    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getServiceRecords());
    var ServiceRecordsRepairBody = $("#tb_service_record_repair");
    var ServiceRecordsProductBody = $("#tb_service_record_products");
    var ServiceRecordsWasherBody = $("#tb_service_record_washer");
    var ServiceRecordsPackagesBody = $("#tb_service_record_packages");

    function getServiceRecords(){
        $.ajax({
          type: "POST",
          url: "../api/getservice-records-details.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
    
           
            // $("#service-records-vnumber").text(data.VehicleNumber);

            const combinedPackages = [];

            // Iterate through filterPackages
            data.filter_service_packages.forEach(filterPackage => {
                // Find matching service_package_id in fuel_service_packages
                const matchingFuelPackage = data.fuel_service_packages.find(fuelPackage => fuelPackage.service_package_id === filterPackage.service_package_id);
                if (matchingFuelPackage) {
                    // Add fuel_type_id and filter_type_id to combinedPackages
                    combinedPackages.push({
                        service_package_name: filterPackage.package_name,
                        filter_type_name: filterPackage.name,
                        fuel_type_name: matchingFuelPackage.name
                    });
                }
            });

            console.log(combinedPackages);
           
            populateTableServiceRecordsPackages(combinedPackages)
            populateTableServiceRecordsRepair(data)
            populateTableServiceRecordsProduct(data)
            populateTableServiceRecordsWasher(data)
    
          },
          error: function () {},
        });


        function populateTableServiceRecordsPackages(combinedPackages) {
            combinedPackages.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td>${list.service_package_name}</td>`);
              row.append(`<td>${list.fuel_type_name}</td>`);
              row.append(`<td>${list.filter_type_name}</td>`);
              row.append("</tr>");
             
              ServiceRecordsPackagesBody.append(row);
 
      
             
            });
          }


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