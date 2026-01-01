$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getProducts());

    $("#btn_update_product").click(function () {
       
      var product_name = $("#product_name").val();
      var productcategory = $("#cmbproductcategory").val();
      var productbrand = $("#cmbproductbrand").val();
      var product_warrenty = $("#product_warrenty").val();
      var product_quantity = $("#product_quantity").val();
      var availablity = $("#cmbavailablity").val();
      var selling_price = $("#selling_price").val();
      var buying_price = $("#buying_price").val();
      var dataIdValue = $(this).data("id");
 

      if(product_name == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Product Name",
            });
            return
      }else if(productcategory == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Select Product Category",
            });
            return

      }else if(productbrand == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Select Product Brand",
            });
            return

      }else if(product_warrenty == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Product Warrenty",
            });
            return

      }else if(product_quantity == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Product Quantity",
            });
            return

      }else if(availablity == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Select Product Availability",
            });
            return

      }else if(selling_price == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Product Selling Price",
            });
            return

      }else if(buying_price == ""){

          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Product Buying Price",
            });
            return

      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editproduct.php",
              data: {
                  id:dataIdValue,
                  product_name:product_name,
                  productcategory:productcategory,
                  productbrand:productbrand,
                  product_warrenty:product_warrenty,
                  product_quantity:product_quantity,
                  availablity:availablity,
                  selling_price:Number.parseFloat(selling_price),
                  buying_price:Number.parseFloat(buying_price)
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {
                Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: "Product updated successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT only after user clicks OK
                                window.location.href = "../products/";
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
      }


      

           
       })


   function getProducts(){
       $.ajax({
         type: "POST",
         url: "../api/getproducts.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let ProductNameElement = document.getElementById("product_name");
           let ProductCategoryElement = document.getElementById("cmbproductcategory");
           let ProductBrandElement = document.getElementById("cmbproductbrand");
           let ProductWarrentyElement = document.getElementById("product_warrenty");
           let ProductQuantityElement = document.getElementById("product_quantity");
           let AvailabilityElement = document.getElementById("cmbavailablity");
           let SellingPriceElement = document.getElementById("selling_price");
           let BuyingPriceElement = document.getElementById("buying_price");
           var buttonElement = document.getElementById("btn_update_product");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           ProductNameElement.value = data.data_content[0].product_name
           ProductCategoryElement.value = data.data_content[0].product_category_id
           ProductBrandElement.value = data.data_content[0].product_brand_id
           ProductWarrentyElement.value = data.data_content[0].warrenty
           ProductQuantityElement.value = data.data_content[0].quantity
           AvailabilityElement.value = data.data_content[0].product_availability_id
           SellingPriceElement.value = data.data_content[0].selling_price
           BuyingPriceElement.value = data.data_content[0].buying_price
        

   
         },
         error: function () {},
       });
   
     }
})