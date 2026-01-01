$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getFuelTypes());

    // Update
    $("#btn_update_fuel").click(function () {
       
      var fuel_type = $("#fuel_type").val();
      var dataIdValue = $(this).data("id");
 

      if(fuel_type == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Fuel Type",
            });
            return
      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editfueltype.php",
              data: {
                  id:dataIdValue,
                  fuel_type:fuel_type
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {
                Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: "Fuel Type updated successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT only after user clicks OK
                                window.location.href = "../service-packages/fuel-types.php";
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


   function getFuelTypes(){
       $.ajax({
         type: "POST",
         url: "../api/getfueltypes.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FuelTypElement = document.getElementById("fuel_type");
           var buttonElement = document.getElementById("btn_update_fuel");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           FuelTypElement.value = data.data_content[0].name
   


   
 
   
         },
         error: function () {},
       });
   
     }
})