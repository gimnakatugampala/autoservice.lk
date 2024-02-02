$(document).ready(function () {

    $("#btn_add_washer").click(function () {
       
        var vehicleclass = $("#cmbvehicleclass").val();
        var price = $("#price").val();
 
       


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
            url: "../api/addwasher.php",
            data: {
                code:generateUUID(),
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


        

             
         })

})