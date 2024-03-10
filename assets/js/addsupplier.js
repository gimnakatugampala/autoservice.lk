$(document).ready(function () {

    $("#btn_add_supplier").click(function () {
       
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var phone_number = $("#phone_number").val();
        var other_phone_number = $("#other_phone_number").val();
        var address = $("#address").val();
       
   

        if(first_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter First Name",
              });
              return
        }else if(last_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Last Name",
              });

              return
        }else if(email == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Email",
              });

              return

        }else if(!validateEmail(email)){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Valid Email",
              });

              return
        }else if(phone_number == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Phone Number",
              });

              return

        }else if(address == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Address",
              });

              return
        }else{

            // SHOW LOADING BTN
        document.getElementById("btn_add_supplier").style.display = "none"
        document.getElementById("btn-loading").style.display = "inline-block"

        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/addsupplier.php",
            data: {
                code:generateUUID(),
                first_name:first_name,
                last_name:last_name,
                email:email,
                phone_number:phone_number.replace(/\s/g, ''),
                other_phone_number:other_phone_number.replace(/\s/g, ''),
                address:address
            },
            success: function (response) {
    
                console.log(response)

            if (response === "success") {
                window.location.href = "../suppliers/";
                // console.log("Success")
    
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Supplier Already Exist.",
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