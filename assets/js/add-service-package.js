$(document).ready(function () {
    var dropdown = document.getElementById("cmbpackageitems");
    var ServicePackagetableBody = $("#tbpackageitem");
  
 
    var items = [];
    var services = [];
  
    //  Package Select
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
                text: "Product Already Exist",
              });
              return
  
            }else{
              populateTableSales(data);
              services.push(data[0])
              return
            }
  
          // ---------------
        },
        error: function () {},
      });
   
      // Get All the Sales List
      function populateTableSales(data) {
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

  
    $("#btn_add_service_package").click(function () {
   

    });
  
 
  

  
    
  
  
  });
  
  