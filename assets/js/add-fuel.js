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

               // SHOW LOADING BTN
        document.getElementById("btn_fuel_type").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

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
              Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Fuel Type added successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT ONLY after user clicks OK
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

})