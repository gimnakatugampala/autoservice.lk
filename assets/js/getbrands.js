$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getVehicles());


   function getVehicles(){
       $.ajax({
         type: "POST",
         url: "../api/getbrands.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let BrandNameElement = document.getElementById("brand_name");


           BrandNameElement.value = data.data_content[0].brand_name

   
         },
         error: function () {},
       });
   
     }
})