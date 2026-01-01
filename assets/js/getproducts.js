$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    // Load dropdowns first, then get product data
    loadDropdowns().then(() => {
        getProducts();
    });

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
                    id: dataIdValue,
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
                                window.location.href = "../products/";
                            }
                        });
      
              }else {
                  Swal.fire({
                      icon: "error",
                      title: "Please Try Again",
                      text: "Something Went Wrong: " + response,
                  });
              }

              },
              error:function (error) {
                  console.log(error)
                  Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Failed to update product",
                  });
              }
          });
      }
    });

  function loadDropdowns() {
        // IMPORTANT: All functions inside here must return the $.ajax object
        return Promise.all([
            loadProductCategories(),
            loadProductBrands(),
            loadAvailability()
        ]);
    }

    function loadProductCategories() {
        return $.ajax({
            type: "POST",
            url: "../api/cmb/productcategorylist.php",
            dataType: "json",
            success: function (data) {
                var categorySelect = $("#cmbproductcategory");
                categorySelect.empty().append('<option value="" disabled selected>-- Choose Category --</option>');
                $.each(data, function (key, value) {
                    categorySelect.append('<option value="' + value.id + '">' + value.name + "</option>");
                });
            }
        });
    }

    function loadProductBrands() {
        return $.ajax({
            type: "POST",
            url: "../api/cmb/productbrand.php",
            dataType: "json",
            success: function (data) {
                var brandSelect = $("#cmbproductbrand");
                brandSelect.empty().append('<option value="" disabled selected>-- Choose Brand --</option>');
                $.each(data, function (key, value) {
                    brandSelect.append('<option value="' + value.id + '">' + value.brand_name + "</option>");
                });
            }
        });
    }

    function loadAvailability() {
        // ADDED 'return' here to make it a promise
        return $.ajax({
            type: "POST",
            url: "../api/cmb/productavailability.php",
            dataType: "json",
            success: function (data) {
                console.log(data)
                var availabilitySelect = $("#cmbavailablity");
                availabilitySelect.empty().append('<option value="" disabled selected>-- Choose Availability --</option>');
                $.each(data, function (key, value) {
                    availabilitySelect.append('<option value="' + value.id + '">' + value.availability + "</option>");
                });
            }
        });
    }

    // Get Product Data
    function getProducts(){
        if (!myParam) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No product code provided",
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "../api/getproducts.php",
            data: { code: myParam },
            dataType: "json",
            success: function (data) {
                console.log("Product data:", data);

                if (data.data_content && data.data_content.length > 0) {
                    let productData = data.data_content[0];
                    
                    // Store product ID in button
                    var buttonElement = $("#btn_update_product");
                    buttonElement.attr("data-id", productData.id);
                    
                    // Populate form fields
                    $("#product_name").val(productData.product_name);
                    $("#cmbproductcategory").val(productData.product_category_id);
                    $("#cmbproductbrand").val(productData.product_brand_id);
                    $("#product_warrenty").val(productData.warrenty);
                    $("#product_quantity").val(productData.quantity);
                    $("#cmbavailablity").val(productData.product_availability_id);
                    $("#selling_price").val(productData.selling_price);
                    $("#buying_price").val(productData.buying_price);
                    
                    console.log("Product ID set:", productData.id);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Product not found",
                    }).then(() => {
                        window.location.href = "../products/";
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading product:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to load product data",
                });
            }
        });
    }
});