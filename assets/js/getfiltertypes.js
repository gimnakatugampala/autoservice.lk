$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getFilterTypes());


   function getFilterTypes(){
       $.ajax({
         type: "POST",
         url: "../api/getfiltertypes.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FilterTypeElement = document.getElementById("filter_type");


           FilterTypeElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})