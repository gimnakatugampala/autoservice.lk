$(document).ready(function () {
    var dropdown = document.getElementById("cmbpackageitems");
    var ServicePackagetableBody = $("#tbpackageitem");

    var dropdownfreeserviceitems = document.getElementById("cmbpackageitems2");
    var FreeServicePackagetableBody = $("#tbfreepackageitem");

    var dropdownFuelType = document.getElementById("cmbfueltype");
    var FuelTypeTableBody = $("#tbfueltype");

    var dropdownFilter = document.getElementById("cmbfiltertype");
    var FilterTypeTableBody = $("#tbfiltertype");
  
 
    var items = [];
    var services = [];
    var free_services = []
    var fuel_types = []
    var filter_types = []


  
    //  Package Select - Service Package Items
    dropdown.addEventListener("change", function () {
      
      var selectID = dropdown.value;
      console.log(selectID)
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
          row.append("<td style='display:none;'>" + list.id + "</td>");
          row.append(`<td>${list.name}</td>`);
          row.append(`<td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>`);
          row.append("</tr>");
         
          ServicePackagetableBody.append(row);
  
          // Add the new item to the items array
          // var item = {
          //   rowID: row.find(".rowID")[0],
          //   quantityInput: row.find(".quantity")[0],
          //   priceInput: row.find(".price")[0],
          //   discountInput: row.find(".discount")[0],
          //   totalCell: row.find(".total")[0],
          // };
          // items.push(item);
  
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
          row.append("<td style='display:none;'>" + list.id + "</td>");
          row.append(`<td>${list.name}</td>`);
          row.append(`<td><button type="button" class="btn bg-gradient-danger"><i class="fas fa-trash"></i></button></td>`);
          row.append("</tr>");
         
          FreeServicePackagetableBody.append(row);
  
          // Add the new item to the items array
          // var item = {
          //   rowID: row.find(".rowID")[0],
          //   quantityInput: row.find(".quantity")[0],
          //   priceInput: row.find(".price")[0],
          //   discountInput: row.find(".discount")[0],
          //   totalCell: row.find(".total")[0],
          // };
          // items.push(item);
  
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
          row.append("<td style='display:none;'>" + list.id + "</td>");
          row.append(`<td>${list.name}</td>`);
          row.append(`<td class="w-50">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">LKR</span>
              </div>
              <input type="text" class="form-control">
              <div class="input-group-append">
                  <span class="input-group-text">.00</span>
              </div>
              </div>
          </td>`);
          row.append("</tr>");
         
          FuelTypeTableBody.append(row);
  
          // Add the new item to the items array
          // var item = {
          //   rowID: row.find(".rowID")[0],
          //   quantityInput: row.find(".quantity")[0],
          //   priceInput: row.find(".price")[0],
          //   discountInput: row.find(".discount")[0],
          //   totalCell: row.find(".total")[0],
          // };
          // items.push(item);
  
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
          row.append("<td style='display:none;'>" + list.id + "</td>");
          row.append(`<td>${list.name}</td>`);
          row.append(`<td class="w-50">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">LKR</span>
              </div>
              <input type="text" class="form-control">
              <div class="input-group-append">
                  <span class="input-group-text">.00</span>
              </div>
              </div>
          </td>`);
          row.append("</tr>");
         
          FilterTypeTableBody.append(row);
  
          // Add the new item to the items array
          // var item = {
          //   rowID: row.find(".rowID")[0],
          //   quantityInput: row.find(".quantity")[0],
          //   priceInput: row.find(".price")[0],
          //   discountInput: row.find(".discount")[0],
          //   totalCell: row.find(".total")[0],
          // };
          // items.push(item);
  
          // item.quantityInput.addEventListener("input", calculateTotal);
          // item.priceInput.addEventListener("input", calculateTotal);
          // item.discountInput.addEventListener("input", calculateTotal);
  
         
        });
      }
  
    });

  
    $("#btn_add_service_package").click(function () {
   

    });
  
 
  

  
    
  
  
  });
  
  