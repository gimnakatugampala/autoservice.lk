$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getFuelTypes());


   function getFuelTypes(){
       $.ajax({
         type: "POST",
         url: "../api/getfueltypes.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FuelTypElement = document.getElementById("fuel_type");


       

           FuelTypElement.value = data.data_content[0].name
   


   
           
   
         },
         error: function () {},
       });
   
     }
})