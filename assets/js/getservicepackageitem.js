$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getVehicles());


   function getVehicles(){
       $.ajax({
         type: "POST",
         url: "../api/getservicepackageitem.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let ServicePackageItemElement = document.getElementById("service_package_item");

           ServicePackageItemElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})