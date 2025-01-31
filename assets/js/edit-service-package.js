$(document).ready(function () {
    var dropdown = document.getElementById("cmbpackageitems");
    var ServicePackagetableBody = $("#tbpackageitem");

    var dropdownfreeserviceitems = document.getElementById("cmbpackageitems2");
    var FreeServicePackagetableBody = $("#tbfreepackageitem");

    var dropdownFuelType = document.getElementById("cmbfueltype");
    var FuelTypeTableBody = $("#tbfueltype");

    var dropdownFilter = document.getElementById("cmbfiltertype");
    var FilterTypeTableBody = $("#tbfiltertype");

    var loadData;


     // Get The Code From URL
     const urlParams = new URLSearchParams(window.location.search);
     const myParam = urlParams.get('code');
 
     document.addEventListener('DOMContentLoaded', getDataServicePackages());
  
 
    var itemsService = [];
    var itemsFreeService = [];
    var itemsFuelType = [];
    var itemsFilterType = [];

    var services = [];
    var free_services = []
    var fuel_types = []
    var filter_types = []

  
  
    //  Package Select - Service Package Items
    dropdown.addEventListener("change", function () {
      
      var selectID = dropdown.value;
      // console.log(selectID)
      $.ajax({
        type: "POST",
        url: "../api/checkservicepackageitem.php",
        data: { itemID: selectID },
        dataType: "json",
        success: function (data) {

          console.log(data)
  
          // ---------------
          let foundSales = services.some(service => service.id == selectID);
  
            if(foundSales){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Service Item Already Exist",
              });
              return
  
            }else{
        
              populateTableServicePackageItem(data);
              services.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });
   
      // Get All the Sales List
      function populateTableServicePackageItem(data) {
        data.forEach(function (list) {
          var row = $("<tr>");
          row.append(`<td class="serviceID" style='display:none;'>${list.id}</td>`);
          row.append(`<td>${list.name}</td>`);
          row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
          row.append("</tr>");
         
          ServicePackagetableBody.append(row);
  
          // Add the new item to the items array
          var item = {
            rowID: row.find(".serviceID")[0],
            // quantityInput: row.find(".quantity")[0],
            // priceInput: row.find(".price")[0],
            // discountInput: row.find(".discount")[0],
            // totalCell: row.find(".total")[0],
          };
          itemsService.push(item);
  
          // item.quantityInput.addEventListener("input", calculateTotal);
          // item.priceInput.addEventListener("input", calculateTotal);
          // item.discountInput.addEventListener("input", calculateTotal);
  
         
        });
      }
  
    });

     //  Package Select - Free Service Package Items
     dropdownfreeserviceitems.addEventListener("change", function () {
       var selectID = dropdownfreeserviceitems.value;
      // console.log(selectID)
      $.ajax({
        type: "POST",
        url: "../api/checkservicepackageitem.php",
        data: { itemID: selectID },
        dataType: "json",
        success: function (data) {

          console.log(data)
  
          // ---------------
          let foundSales = free_services.some(service => service.id == selectID);
  
            if(foundSales){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Service Item Already Exist",
              });
              return
  
            }else{
              populateTableFreeServicePackageItem(data);
              free_services.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });

      // Get Free Service Items
      function populateTableFreeServicePackageItem(data) {
        data.forEach(function (list) {
          var row = $("<tr>");
          row.append(`<td class="serviceFreeID" style='display:none;'>${list.id}</td>`);
          row.append(`<td>${list.name}</td>`);
          row.append(`<td><a a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
          row.append("</tr>");
         
          FreeServicePackagetableBody.append(row);
  
          // Add the new item to the items array
          var item = {
            rowID: row.find(".serviceFreeID")[0],
          };
          itemsFreeService.push(item);
  
          // item.quantityInput.addEventListener("input", calculateTotal);
          // item.priceInput.addEventListener("input", calculateTotal);
          // item.discountInput.addEventListener("input", calculateTotal);
  
         
        });
      }

     })

     //  Package Select - Fuel Type
     dropdownFuelType.addEventListener("change", function () {
      
      var selectID = dropdownFuelType.value;
      // console.log(selectID)
      $.ajax({
        type: "POST",
        url: "../api/checkfueltype.php",
        data: { itemID: selectID },
        dataType: "json",
        success: function (data) {

          console.log(data)
  
          // ---------------
          let foundSales = fuel_types.some(fuel_type => fuel_type.id == selectID);
  
            if(foundSales){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Fuel Type Already Exist",
              });
              return
  
            }else{
              populateTableFuelType(data);
              fuel_types.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });
   
      // Get All the Sales List
      function populateTableFuelType(data) {
        data.forEach(function (list) {
          var row = $("<tr>");
          row.append(`<td class="fuelTypeID" style='display:none;'>${list.id}</td>`);
          row.append(`<td>${list.name}</td>`);
          row.append(`<td class="w-50">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">LKR</span>
              </div>
              <input  type="text" class="form-control fuel-type-price">
              <div class="input-group-append">
                  <span class="input-group-text">.00</span>
              </div>
              </div>
          </td>`);
          row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
          row.append("</tr>");
         
          FuelTypeTableBody.append(row);
  
          // Add the new item to the items array
          var item = {
            rowID: row.find(".fuelTypeID")[0],
            FuelPrice: row.find(".fuel-type-price")[0]
          };
          itemsFuelType.push(item);
  
          // item.quantityInput.addEventListener("input", calculateTotal);
          // item.priceInput.addEventListener("input", calculateTotal);
          // item.discountInput.addEventListener("input", calculateTotal);
  
         
        });
      }
  
    });

    //  Package Select - Filter Type
    dropdownFilter.addEventListener("change", function () {
      
      var selectID = dropdownFilter.value;
      // console.log(selectID)
      $.ajax({
        type: "POST",
        url: "../api/checkfiltertype.php",
        data: { itemID: selectID },
        dataType: "json",
        success: function (data) {

          console.log(data)
  
          // ---------------
          let foundSales = filter_types.some(filter_type => filter_type.id == selectID);
  
            if(foundSales){
  
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Filter Type Already Exist",
              });
              return
  
            }else{
              populateTableFilterType(data);
              filter_types.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });
   
      // Get All the Sales List
      function populateTableFilterType(data) {
        data.forEach(function (list) {
          var row = $("<tr>");
          row.append(`<td class="filterTypeId" style='display:none;'>${list.id}</td>`);
          row.append(`<td>${list.name}</td>`);
          row.append(`<td class="w-50">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">LKR</span>
              </div>
              <input type="text" class="form-control filter-type-price">
              <div class="input-group-append">
                  <span class="input-group-text">.00</span>
              </div>
              </div>
          </td>`);
          row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
          row.append("</tr>");
         
          FilterTypeTableBody.append(row);
  
          // Add the new item to the items array
          var item = {
            rowID: row.find(".filterTypeId")[0],
            FilterTypePrice: row.find(".filter-type-price")[0]
          };
          itemsFilterType.push(item);
  
          // item.quantityInput.addEventListener("input", calculateTotal);
          // item.priceInput.addEventListener("input", calculateTotal);
          // item.discountInput.addEventListener("input", calculateTotal);
  
         
        });
      }
  
    });

  // Add Service Package
    $("#update_service_package_btn").click(function () {

      var dataServices = []
      var dataFreeServices = []
      var dataFuelTypes = []
      var dataFilterTypes = []
   
      var service_package_name = $("#service_package_name").val();
      var vehicleclass = $("#cmbvehicleclass").val();

  

      
      // Service Packages
      $(".serviceID").each(function () {
        var serviceID = $(this).closest("tr").find("td:nth-child(1)").text();
        // console.log(serviceID)
        dataServices.push({
          serviceID
        })
      })


      // Free Service Packages
      $(".serviceFreeID").each(function () {
      var serviceID = $(this).closest("tr").find("td:nth-child(1)").text();
      // console.log(serviceID)
      dataFreeServices.push({
        serviceID
      })
    })

    // Fuel Type 
    $(".fuelTypeID").each(function () {
      var FuelTypeID = $(this).closest("tr").find("td:nth-child(1)").text();
      var Price = $(this).closest("tr").find(".fuel-type-price").val();
      // console.log(FuelTypeID)
      dataFuelTypes.push({
        FuelTypeID,
        Price: Price == "" ? 0 : Price
      })
    })

     // filterTypeId Type 
     $(".filterTypeId").each(function () {
      var FilterTypeID = $(this).closest("tr").find("td:nth-child(1)").text();
      var Price = $(this).closest("tr").find(".filter-type-price").val();
      // console.log(FuelTypeID)
      dataFilterTypes.push({
        FilterTypeID,
        Price: Price == "" ? 0 : Price
      })
    })

    if(service_package_name == ""){

      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Please Enter Service Package Name",
      });
      return

    }else if(vehicleclass == null){

      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Please Select Vehicle Class",
      });
      return

    }else if(dataServices.length == 0){

      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Select At Least One Service Package Item",
      });
      return

    }else if(dataFuelTypes.length == 0){

      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Select At Least One Fuel Type",
      });
      return

    }else if(dataFilterTypes.length == 0){

      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Select At Least One Filter Type",
      });
      return

    }

    console.log(service_package_name)
    console.log(vehicleclass)    
    console.log(dataServices)
    console.log(dataFreeServices)
    console.log(dataFuelTypes)
    console.log(dataFilterTypes)

    console.log("-------------------------")
    
    console.log(services)
    console.log(free_services)
    console.log(fuel_types)
    console.log(filter_types)
    console.log("-------------------------")
    console.log(itemsService)
    console.log(itemsFreeService)
    console.log(itemsFuelType)
    console.log(itemsFilterType)
    console.log(loadData)

    //  SAVE DATA
    $.ajax({
      type: "POST",
      url: "../api/editservicepackage.php",
      data: {
      service_package_id:loadData.id.id,
      service_package_name,
      vehicleclass,
      services:JSON.stringify(dataServices),
      free_services:JSON.stringify(dataFreeServices),
      fuel_types:JSON.stringify(dataFuelTypes),
      filter_types:JSON.stringify(dataFilterTypes)
      },
      success: function (response) {

          console.log(response)

        if (response === "success") {

          window.location.href = "../service-packages/";

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


    

    });
  
    // Delete Service Package Item
    $("#tbpackageitem").on("click", ".deleteItem", function () {
      var listItem = $(this).data('id');
      console.log(listItem)
      console.log(services)
      console.log(itemsService)

      
      let indexToRemove = services.findIndex(item => item.id == listItem);

      if (indexToRemove != -1) {
        services.splice(indexToRemove, 1);
      }

    

      $(this).closest('tr').remove();

        // // // Items Array
        let indexToRemoveItems = itemsService.findIndex(item => item.rowID.innerText == listItem);

        if (indexToRemoveItems != -1) {
          itemsService.splice(indexToRemoveItems, 1);
        }
  
    })


     // Delete Free Service Package Item
     $("#tbfreepackageitem").on("click", ".deleteItem", function () {
      var listItem = $(this).data('id');
      console.log(listItem)
      console.log(free_services)
      console.log(itemsFreeService)

      
      let indexToRemove = free_services.findIndex(item => item.id == listItem);

      if (indexToRemove != -1) {
        free_services.splice(indexToRemove, 1);
      }

  

       $(this).closest('tr').remove();

        // Items Array
        let indexToRemoveItems = itemsFreeService.findIndex(item => item.rowID.innerText == listItem);

        if (indexToRemoveItems != -1) {
          itemsFreeService.splice(indexToRemoveItems, 1);
        }
  
    })

      // Delete Fuel Type
      $("#tbfueltype").on("click", ".deleteItem", function () {
        var listItem = $(this).data('id');
        // console.log(listItem)
        // console.log(free_services)
        // console.log(itemsFreeService)

        
        let indexToRemove = fuel_types.findIndex(item => item.id == listItem);

        if (indexToRemove != -1) {
          fuel_types.splice(indexToRemove, 1);
        }

    

        $(this).closest('tr').remove();

          // Items Array
          let indexToRemoveItems = itemsFuelType.findIndex(item => item.rowID.innerText == listItem);

          if (indexToRemoveItems != -1) {
            itemsFuelType.splice(indexToRemoveItems, 1);
          }
    
      })

      // Delete Filter Type
      $("#tbfiltertype").on("click", ".deleteItem", function () {
        var listItem = $(this).data('id');
        // console.log(listItem)
        // console.log(free_services)
        // console.log(itemsFreeService)

        
        let indexToRemove = filter_types.findIndex(item => item.id == listItem);

        if (indexToRemove != -1) {
          filter_types.splice(indexToRemove, 1);
        }

    

        $(this).closest('tr').remove();

          // Items Array
          let indexToRemoveItems = itemsFilterType.findIndex(item => item.rowID.innerText == listItem);

          if (indexToRemoveItems != -1) {
            itemsFilterType.splice(indexToRemoveItems, 1);
          }
    
      })
  
    
      function getDataServicePackages(){
        $.ajax({
          type: "POST",
          url: "../api/getservicepackages.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
  
            loadData = data;


           
            data.service_packages_items.forEach(item => {
              services.push(item);
          });

            data.free_service_packages_items.forEach(item => {
              free_services.push(item);
          });

          data.fuel_types.forEach(item => {
            fuel_types.push(item);
        });

        data.filter_types.forEach(item => {
          filter_types.push(item);
      });
           
            // Service Packages
              data.service_packages_items.forEach(function (list) {
                var row = $("<tr>");
                row.append(`<td class="serviceID" style='display:none;'>${list.id}</td>`);
                row.append(`<td>${list.name}</td>`);
                row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
                row.append("</tr>");
               
                ServicePackagetableBody.append(row);
        
                // Add the new item to the items array
                var item = {
                  rowID: row.find(".serviceID")[0]
                };
                itemsService.push(item);
  
            
        
              
        
               
              });
            

            // Free Service Packages
            data.free_service_packages_items.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td class="serviceFreeID" style='display:none;'>${list.id}</td>`);
              row.append(`<td>${list.name}</td>`);
              row.append(`<td><a a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
              row.append("</tr>");
             
              FreeServicePackagetableBody.append(row);
      
              // Add the new item to the items array
              var item = {
                rowID: row.find(".serviceFreeID")[0],
              };
              itemsFreeService.push(item);
      
            
      
             
            });

            // Fuel Types
            data.fuel_types.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td class="fuelTypeID" style='display:none;'>${list.id}</td>`);
              row.append(`<td>${list.name}</td>`);
              row.append(`<td class="w-50">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">LKR</span>
                  </div>
                  <input value="${list.price}" type="text" class="form-control fuel-type-price">
                  <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                  </div>
                  </div>
              </td>`);
              row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
              row.append("</tr>");
             
              FuelTypeTableBody.append(row);
      
              // Add the new item to the items array
              var item = {
                rowID: row.find(".fuelTypeID")[0],
                FuelPrice: row.find(".fuel-type-price")[0]
              };
              itemsFuelType.push(item);
      
              // item.quantityInput.addEventListener("input", calculateTotal);
              // item.priceInput.addEventListener("input", calculateTotal);
              // item.discountInput.addEventListener("input", calculateTotal);
      
             
            });

            // Filter Types
            data.filter_types.forEach(function (list) {
              var row = $("<tr>");
              row.append(`<td class="filterTypeId" style='display:none;'>${list.id}</td>`);
              row.append(`<td>${list.name}</td>`);
              row.append(`<td class="w-50">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">LKR</span>
                  </div>
                  <input value="${list.price}" type="text" class="form-control filter-type-price">
                  <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                  </div>
                  </div>
              </td>`);
              row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
              row.append("</tr>");
             
              FilterTypeTableBody.append(row);
      
              // Add the new item to the items array
              var item = {
                rowID: row.find(".filterTypeId")[0],
                FilterTypePrice: row.find(".filter-type-price")[0]
              };
              itemsFilterType.push(item);
      
              // item.quantityInput.addEventListener("input", calculateTotal);
              // item.priceInput.addEventListener("input", calculateTotal);
              // item.discountInput.addEventListener("input", calculateTotal);
      
             
            });
  
            let ServicePackageNameElement = document.getElementById("service_package_name");
            let VehicleClassElement = document.getElementById("cmbvehicleclass");
        

          ServicePackageNameElement.value = data.data_content[0].package_name
          VehicleClassElement.value = data.data_content[0].vehicle_type_id
  
  
          },
          error: function () {},
        });
  
      }


      
  
  
  });
  
  