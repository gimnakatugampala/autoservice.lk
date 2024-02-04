$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getServicePackageItem());

    $("#btn_update_service_package_item").click(function () {
       
      var service_package_item = $("#service_package_item").val();
      var dataIdValue = $(this).data("id");
 

      if(service_package_item == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Service Package Item",
            });
            return
      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editservicepackageitem.php",
              data: {
                  id:dataIdValue,
                  service_package_item:service_package_item
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {
                  window.location.href = "../service-packages/service-package-items.php";
                  // console.log("Success")
      
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


   function getServicePackageItem(){
       $.ajax({
         type: "POST",
         url: "../api/getservicepackageitem.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let ServicePackageItemElement = document.getElementById("service_package_item");
           var buttonElement = document.getElementById("btn_update_service_package_item");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           ServicePackageItemElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})