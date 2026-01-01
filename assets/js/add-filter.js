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


                  // SHOW LOADING BTN
        document.getElementById("btn_filter_type").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

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
                  Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Filter Type added successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT ONLY AFTER CLICKING OK
                                window.location.href = "../service-packages/filter-types.php";
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