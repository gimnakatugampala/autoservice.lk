$(document).ready(function () {

    $("#btn_add_service_package_item").click(function () {

        var service_package_item = $("#service_package_item").val();
   

        if(service_package_item == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Service Package Item",
              });
              return
        }else{

             // SHOW LOADING BTN
        document.getElementById("btn_add_service_package_item").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/add-service-package-item.php",
                data: {
                    code:generateUUID(),
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

})