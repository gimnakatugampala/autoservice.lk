$(document).ready(function () {

    var dropdownPO = document.getElementById("cmbproducts");
    var tableBodyPO = $("#tb_update_puchaseorder_products");

    const paidAmountInput = document.getElementById("paid_amount");
    const subtotal = document.getElementById("subtotal");
    const paid = document.getElementById("paid");
    const VAT = document.getElementById("vat");
    const to_be_paid = document.getElementById("to_be_paid");

    var loadData;


     // Get The Code From URL
     const urlParams = new URLSearchParams(window.location.search);
     const myParam = urlParams.get('code');

    
    document.addEventListener('DOMContentLoaded', getDataPurchaseOrder());


    // Calculate With the Paid Amount
    paidAmountInput.addEventListener("input", function () {
        calculateDisplay()
      });

      VAT.addEventListener("input", function () {
        calculateDisplay()
      })

    //   Calculate the Final Prices
      function calculateDisplay() {

        const inputText = paidAmountInput.value == "" ? 0 : paidAmountInput.value;
        const VAT_value = VAT.value == "" ? 0 : VAT.value
        paid.textContent = Number.parseFloat(inputText);

        var final_amount = Number.parseFloat(subtotal.textContent) - Number.parseFloat(inputText)

        to_be_paid.textContent = Number.parseFloat(final_amount) + (Number.parseFloat(final_amount) * Number.parseFloat(VAT_value) / 100)
        
      }
    


    var items = [];
    var selected_products = [];
  
    dropdownPO.addEventListener("change", function () {
      var productId = dropdownPO.value;

      $.ajax({
        type: "POST",
        url: "../api/checkproduct.php",
        data: { productId: productId },
        dataType: "json",
        success: function (data) {

            // console.log(data)
  
          // ---------------
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
  
      // Get All the Sales List
      function populateTableProducts(data) {
        data.forEach(function (plist) {
          var row = $("<tr>");
          row.append(`<td class='rowID' style='display:none;'>${plist.id}</td>`);
          row.append(`<td>${plist.product_name}</td>`);
          row.append(`<td><input value="${plist.quantity}" type="text" class="form-control quantity"></td>`);
          row.append(`<td><input value="${plist.buying_price}" type="text" class="form-control price"></td>`);
          row.append(`<td><input value="0" type="text" class="form-control discount"></td>`);
          row.append(`<td class="total"></td>`);
          row.append(`<td><button data-id="${plist.id}" type="button" class="btn bg-gradient-danger deleteProductItem"><i class="fas fa-trash"></i></button></td>`);
          tableBodyPO.append(row);
  
        //   // Add the new item to the items array
          var item = {
            rowID: row.find(".rowID")[0],
            quantityInput: row.find(".quantity")[0],
            priceInput: row.find(".price")[0],
            discountInput: row.find(".discount")[0],
            totalCell: row.find(".total")[0],
          };
          items.push(item);
  
          item.quantityInput.addEventListener("input", calculateTotal);
          item.priceInput.addEventListener("input", calculateTotal);
          item.discountInput.addEventListener("input", calculateTotal);
  
          calculateTotal();
        });
      }
  
    });

    function calculateTotal() {
        var totalAmount = 0;
        var to = 0;
        var dis = 0;
        items.forEach(function (item) {
          var quantity = item.quantityInput.value == "" ? 0 :parseFloat(item.quantityInput.value);
          var price = item.priceInput.value == "" ? 0 : parseFloat(item.priceInput.value);
          var discount = item.discountInput.value == "" ? 0 : parseFloat(item.discountInput.value);
    
          var itemTotal = quantity * price - discount;
          item.totalCell.textContent = itemTotal.toFixed(2);
    
          totalAmount += itemTotal;
          dis += discount;
    
          to = totalAmount - parseFloat(paid.textContent);
        });
        $("#subtotal").text(totalAmount.toFixed(2));

        calculateDisplay()
        // $("#dis").text(dis.toFixed(2));
    
        // $("#topaid").text(to.toFixed(2));
      }

    // Add Purchase
    $("#btn_update_purchase_order").click(function () {

    //     var data = [];
       
    //     var suppliers = $("#cmbsuppliers").val();
    //     var purchase_date = $("#purchase-date").val();
    //     var paidstatus = $("#cmbpaidstatus").val();
    //     var paid_amount = $("#paid_amount").val();
    //     var status = $("#cmbstatus").val();
    //     var paymentmethod = $("#cmbpaymentmethod").val();

    //     console.log(suppliers)
    //     console.log(purchase_date)
    //     console.log(paidstatus)
    //     console.log(paid_amount)
    //     console.log(status)
    //     console.log(items)
    //     console.log(selected_products)
    //     console.log(subtotal.textContent)

    //     $(".quantity").each(function () {
    //         var product = $(this).closest("tr").find("td:nth-child(1)").text();
    //         var quantity = $(this).closest("tr").find(".quantity").val();
    //         var price = $(this).closest("tr").find(".price").val();
    //         var discount = $(this).closest("tr").find(".discount").val();
      
    //         if(paid_amount == ""|| isNaN(paid_amount)){
    //             paid_amount = 0
    //         }
      
    //         console.log(paid_amount)
      
    //         data.push({
    //           product: product,
    //           quantity: quantity,
    //           price: price,
    //           discount: discount,
    //         });
    //       });
        

    //       console.log(data)
   

    //     if(suppliers == null){
    //         Swal.fire({
    //             icon: "error",
    //             title: "Error",
    //             text: "Please Select Supplier",
    //           });
    //           return
    //     }else if(purchase_date == ""){
    //         Swal.fire({
    //             icon: "error",
    //             title: "Error",
    //             text: "Please Select Purchase Date",
    //           });
    //           return
    //     }else if(paidstatus == ""){
    //         Swal.fire({
    //             icon: "error",
    //             title: "Error",
    //             text: "Please Select Paid Status",
    //           });
    //           return
    //     }else if(status == null){
    //         Swal.fire({
    //             icon: "error",
    //             title: "Error",
    //             text: "Please Select Status",
    //           });
    //           return
    //     }else if(paymentmethod == "" || paymentmethod == null){
    //       Swal.fire({
    //           icon: "error",
    //           title: "Error",
    //           text: "Please Select Payment Method",
    //         });
    //         return
    //   }else{

    //        //  SAVE DATA
    //        $.ajax({
    //         type: "POST",
    //         url: "../api/add-purchaseorder.php",
    //         data: {
    //             pocode:generateUUID(),
    //             picode:generateUUID(),
    //             suppliers,
    //             purchase_date,
    //             paidstatus,
    //             paid_amount:paid_amount == "" ? 0 : paid_amount,
    //             subtotal:subtotal.textContent == "" ? 0 : subtotal.textContent,
    //             vat:VAT.value == "" ? 0 : VAT.value,
    //             status,
    //             paymentmethod:paymentmethod,
    //             products:JSON.stringify(data)
             
    //         },
    //         success: function (response) {
    
    //             // console.log(response)

    //         if (response === "success") {
    //             window.location.href = "../purchase-order//";
    //             // console.log("Success")
    
    //         }else {
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Please Try Again",
    //                 text: "Something Went Wrong",
    //             });
    //         }

    //         },
    //         error:function (error) {
    //             console.log(error)
    //         }
    //     });

    //     }

        

             
         })

         // Delete Filter Type
      $("#tb_update_puchaseorder_products").on("click", ".deleteProductItem", function () {
        var listItem = $(this).data('id');
        // console.log(listItem)
        // console.log(free_services)
        // console.log(itemsFreeService)
      
        
        let indexToRemove = selected_products.findIndex(item => item.id == listItem);

        if (indexToRemove != -1) {
          selected_products.splice(indexToRemove, 1);
        }

    

        $(this).closest('tr').remove();

          // Items Array
          let indexToRemoveItems = items.findIndex(item => item.rowID.innerText == listItem);

          if (indexToRemoveItems != -1) {
            items.splice(indexToRemoveItems, 1);
          }

          calculateDisplay()
          calculateTotal()
    
      })


      function getDataPurchaseOrder(){
        $.ajax({
          type: "POST",
          url: "../api/getpurchaseorder.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
  
        //     loadData = data;
           
            // Products
            data.products.forEach(function (plist) {
                var row = $("<tr>");
                row.append(`<td class='rowID' style='display:none;'>${plist.id}</td>`);
                row.append(`<td>${plist.product_name}</td>`);
                row.append(`<td><input value="${plist.quantity}" type="text" class="form-control quantity"></td>`);
                row.append(`<td><input value="${plist.buying_price}" type="text" class="form-control price"></td>`);
                row.append(`<td><input value="0" type="text" class="form-control discount"></td>`);
                row.append(`<td class="total">${Number.parseFloat(plist.qty) * Number.parseFloat(plist.purchase_price) - Number.parseFloat(plist.discount)}</td>`);
                row.append(`<td><button data-id="${plist.id}" type="button" class="btn bg-gradient-danger deleteProductItem"><i class="fas fa-trash"></i></button></td>`);
                tableBodyPO.append(row);
        
              //   // Add the new item to the items array
                var item = {
                  rowID: row.find(".rowID")[0],
                  quantityInput: row.find(".quantity")[0],
                  priceInput: row.find(".price")[0],
                  discountInput: row.find(".discount")[0],
                  totalCell: row.find(".total")[0],
                };
                items.push(item);
        
                item.quantityInput.addEventListener("input", calculateTotal);
                item.priceInput.addEventListener("input", calculateTotal);
                item.discountInput.addEventListener("input", calculateTotal);
        
                calculateTotal();
              });
            

    
                const paidAmountInputElement = document.getElementById("paid_amount");
                const subtotalElement = document.getElementById("subtotal");
                // const paidElement = document.getElementById("paid");
                const VATElement = document.getElementById("vat");
                // const to_be_paidElement = document.getElementById("to_be_paid");


                const suppliers = document.getElementById("cmbsuppliers");
                const purchase_date = document.getElementById("purchase-date");
                const paidstatus = document.getElementById("cmbpaidstatus");
                const status = document.getElementById("cmbstatus");
                // const paymentmethod = document.getElementById("cmbpaymentmethod");



                paidAmountInputElement.value =  data.data_content[0].paid_amount
                suppliers.value =  data.data_content[0].supplier_id
                purchase_date.value =  data.data_content[0].purchase_order_date
                paidstatus.value =  data.data_content[0].paid_status_id
                status.value =  data.data_content[0].status_id

                subtotalElement.textContent = data.data_content[0].sub_total
                VATElement.value = data.data_content[0].vat_amount
                



                calculateDisplay()
         
                
  
  
          },
          error: function () {},
        });
  
      }

})