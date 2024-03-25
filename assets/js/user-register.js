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

         // SHOW LOADING BTN
         document.getElementById("btn-user-reg").style.display = "none"
         document.getElementById("btn-loading").style.display = "block"
 
    

        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/user-register.php",
            data: {
              station_code:generateUUID(),
              email:email,
              password:con_password
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../vehicles/";
                // console.log("Success")
    
              } else if (response == "User Exist"){
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "User Already Exist.",
                  });


                   // SHOW LOADING BTN
                document.getElementById("btn-user-reg").style.display = "block"
                document.getElementById("btn-loading").style.display = "none"

              }else if (response == "Email is Invalid"){
                Swal.fire({
                    icon: "error",
                    title: "Register failed",
                    text: "Email is Invalid.",
                  });


                  // SHOW LOADING BTN
                  document.getElementById("btn-user-reg").style.display = "block"
                  document.getElementById("btn-loading").style.display = "none"

              }else {
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "Please check your credentials.",
                  });


                   // SHOW LOADING BTN
                document.getElementById("btn-user-reg").style.display = "block"
                document.getElementById("btn-loading").style.display = "none"
              }

            },
            error:function (error) {
                console.log(error)
            }
          });


    

             
         })

})