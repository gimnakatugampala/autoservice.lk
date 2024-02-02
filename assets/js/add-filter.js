$(document).ready(function () {

    $("#btn_filter_type").click(function () {
       
        var filter_type = $("#filter_type").val();
   

        if(filter_type == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Filter Type",
              });
              return
        }else{

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/add-filter.php",
                data: {
                    code:generateUUID(),
                    filter_type:filter_type
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                    window.location.href = "../service-packages/filter-types.php";
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