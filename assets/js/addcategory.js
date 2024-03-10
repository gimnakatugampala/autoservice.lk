$(document).ready(function () {

    $("#btn_add_category").click(function () {
       
        var category_name = $("#category_name").val();
   

        if(category_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Category Name",
              });
              return
        }else{


            // SHOW LOADING BTN
        document.getElementById("btn_add_category").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/addcategory.php",
                data: {
                    code:generateUUID(),
                    category_name:category_name
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                    window.location.href = "../products/category-list.php";
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