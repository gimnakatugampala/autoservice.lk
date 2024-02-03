$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getWashers());

    // Update
    $("#btn_update_washer").click(function () {

      
      var vehicleclass = $("#cmbvehicleclass").val();
      var price = $("#price").val();
      var dataIdValue = $(this).data("id");

      console.log(dataIdValue);

    

      if(vehicleclass == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Select Vehicle Class",
            });
            return
      }else if(price == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Price",
            });

            return
      }else{

      //  SAVE DATA
      $.ajax({
          type: "POST",
          url: "../api/editwasher.php",
          data: {
              id:dataIdValue,
              vehicleclass:vehicleclass,
              price:Number.parseFloat(price)
          },
          success: function (response) {
  
              console.log(response)

          if (response === "success") {
              window.location.href = "../washer/";
              // console.log("Success")
  
          }else if(response == "Washer Exist"){
              Swal.fire({
                  icon: "error",
                  title: "Already Exist",
                  text: "Washer with the Vehicle Class Exist",
                });
  
                return
          }else {
              Swal.fire({
                  icon: "error",
                  title: "Please Try Again",
                  text: "Something Went Wrong.",
              });
          }

          },
          error:function (error) {
              console.log(error)
          }
      });


      }


    });


   function getWashers(){
       $.ajax({
         type: "POST",
         url: "../api/getwasher.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let VehicleClassElement = document.getElementById("cmbvehicleclass");
           let PriceElement = document.getElementById("price");
           var buttonElement = document.getElementById("btn_update_washer");

          buttonElement.setAttribute("data-id", data.data_content[0].id);
           VehicleClassElement.value = data.data_content[0].vehicle_type_id
           PriceElement.value = data.data_content[0].price

        

   
         },
         error: function () {},
       });
   
     }
})