$(document).ready(function () {

    $("#btn_add_product").click(function () {
       
        var product_name = $("#product_name").val();
        var productcategory = $("#cmbproductcategory").val();
        var productbrand = $("#cmbproductbrand").val();
        var product_warrenty = $("#product_warrenty").val();
        var product_quantity = $("#product_quantity").val();
        var availablity = $("#cmbavailablity").val();
        var selling_price = $("#selling_price").val();
        var buying_price = $("#buying_price").val();
   

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

            // SHOW LOADING BTN
        document.getElementById("btn_add_product").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/add-product.php",
                data: {
                    code:generateUUID(),
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
                            title: "Success!",
                            text: "Product added successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT ONLY after user clicks OK
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

})