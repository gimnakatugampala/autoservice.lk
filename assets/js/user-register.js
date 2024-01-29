$(document).ready(function () {

    $("#btn-user-reg").click(function () {

       
        var email = $("#email").val();
        var password = $("#pass").val();
        var con_password = $("#con_pass").val();
    
    

        if(email == ""){
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
        }else if(password == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Password",
              });

              return

        }else if(con_password == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Confirm Password",
              });

              return

        }else if(con_password != password){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Passwords Do not Match",
              });

              return

        }

        console.log(email)
        console.log(password)
        console.log(con_password)

    

        //  SAVE DATA
        // $.ajax({
        //     type: "POST",
        //     url: "../api/station_register.php",
        //     data: {
        //       station_code:generateUUID(),
        //       station_name,
        //       email:email,
        //       password:con_password,
        //       lat:(lat).toString(),
        //       long:(long).toString(),
        //     },
        //     success: function (response) {
     
        //         console.log(response)

        //       if (response === "success") {
        //         window.location.href = "../auth/user-register.php";
        //         // console.log("Success")
    
        //       } else if (response == "User Exist"){
        //         Swal.fire({
        //             icon: "error",
        //             title: "Login failed",
        //             text: "Service Station Already Exist.",
        //           });

        //       }else {
        //         Swal.fire({
        //             icon: "error",
        //             title: "Login failed",
        //             text: "Please check your credentials.",
        //           });
        //       }

        //     },
        //     error:function (error) {
        //         console.log(error)
        //     }
        //   });


    

             
         })

})