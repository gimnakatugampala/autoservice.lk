$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getCategory());


   function getCategory(){
       $.ajax({
         type: "POST",
         url: "../api/getcategory.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let CategoryNameElement = document.getElementById("category_name");


           CategoryNameElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})