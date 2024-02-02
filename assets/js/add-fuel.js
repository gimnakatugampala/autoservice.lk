$(document).ready(function () {

    $("#btn_fuel_type").click(function () {
       
        var fuel_type = $("#fuel_type").val();
   

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
                url: "../api/add-fuel.php",
                data: {
                    code:generateUUID(),
                    fuel_type:fuel_type
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                    window.location.href = "../service-packages/fuel-types.php";
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

})