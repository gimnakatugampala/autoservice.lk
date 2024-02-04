$(document).ready(function () {

    $("#btn_add_repair").click(function () {
       
        var repair_name = $("#repair_name").val();
   

        if(repair_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Repair Name",
              });
              return
        }else{

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/addrepair.php",
                data: {
                    code:generateUUID(),
                    repair_name:repair_name
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                    window.location.href = "../repair/";
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