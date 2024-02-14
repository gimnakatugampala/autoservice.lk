$(document).ready(function () {
    var dropdown = document.getElementById("cmbsearchvehicles");
    // var ServicePackagetableBody = $("#tbpackageitem");


  
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
     
            //   populateTableServicePackageItem(data);
            //   services.push(data[0])
           
            
  
          // ---------------
        },
        error: function () {},
      });
   
    //   // Get All the Sales List
    //   function populateTableServicePackageItem(data) {
    //     data.forEach(function (list) {
    //       var row = $("<tr>");
    //       row.append(`<td class="serviceID" style='display:none;'>${list.id}</td>`);
    //       row.append(`<td>${list.name}</td>`);
    //       row.append(`<td><a data-id="${list.id}" type="button" class="btn bg-gradient-danger deleteItem"><i class="fas fa-trash"></i></a></td>`);
    //       row.append("</tr>");
         
    //       ServicePackagetableBody.append(row);
  
    //       // Add the new item to the items array
    //       var item = {
    //         rowID: row.find(".serviceID")[0],
    //         // quantityInput: row.find(".quantity")[0],
    //         // priceInput: row.find(".price")[0],
    //         // discountInput: row.find(".discount")[0],
    //         // totalCell: row.find(".total")[0],
    //       };
    //       itemsService.push(item);
  
    //       // item.quantityInput.addEventListener("input", calculateTotal);
    //       // item.priceInput.addEventListener("input", calculateTotal);
    //       // item.discountInput.addEventListener("input", calculateTotal);
  
         
    //     });
    //   }
  
    });

    

//   // Add Service Package
//     $("#btn_add_service_package").click(function () {
//     });
  

  
  
  });
  
  