$(document).ready(function () {

    $("#btn_add_brand").click(function () {
       
        var brand_name = $("#brand_name").val();
   

        if(brand_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Brand Name",
              });
              return
        }else{

             // SHOW LOADING BTN
        document.getElementById("btn_add_brand").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/add-brand.php",
                data: {
                    code:generateUUID(),
                    brand_name:brand_name
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                  Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Brand added successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect ONLY after user clicks the OK button
                                window.location.href = "../products/brand-list.php";
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