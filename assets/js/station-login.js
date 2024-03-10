$(document).ready(function () {

    $("#btn_station_login").click(function () {

       
        var email = $("#email").val();
        var password = $("#password").val();

        console.log(email)
        console.log(password)
    
    

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

        }


        // SHOW LOADING BTN
        document.getElementById("btn_station_login").style.display = "none"
        document.getElementById("btn-loading").style.display = "block"


        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/station-login.php",
            data: {
              email:email,
              password:password
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../auth/user-login.php";
                // console.log("Success")
    
              }else {
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "Please check your credentials.",
                  });

                  // SHOW LOADING BTN
              document.getElementById("btn_station_login").style.display = "block"
              document.getElementById("btn-loading").style.display = "none"
              }

            },
            error:function (error) {
                console.log(error)
            }
          });

             
         })

})