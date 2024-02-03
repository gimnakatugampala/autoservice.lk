$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getProducts());


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