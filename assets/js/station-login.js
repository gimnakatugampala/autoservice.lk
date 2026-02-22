$(document).ready(function () {

    $("#btn_station_login").click(function () {

       
        var email = $("#email").val();
        var password = $("#password").val();

        // 1. GET RECAPTCHA RESPONSE
        var recaptchaResponse = grecaptcha.getResponse();

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

        }else if(recaptchaResponse.length == 0){
            Swal.fire({
                icon: "error",
                title: "Robot Check",
                text: "Please verify that you are not a robot.",
            });
            return;
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
              password:password,
              'g-recaptcha-response': recaptchaResponse
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../auth/user-login.php";
                // console.log("Success")
    
              }else {
                    // RESET RECAPTCHA ON FAILURE
                    grecaptcha.reset();

                    let errorText = "Please check your credentials.";
                    if (response === "captcha_failed") {
                        errorText = "Robot verification failed. Please try again.";
                    }

                    Swal.fire({
                        icon: "error",
                        title: "Login failed",
                        text: errorText,
                    });

                    // RESTORE BUTTONS
                    document.getElementById("btn_station_login").style.display = "block";
                    document.getElementById("btn-loading").style.display = "none";
                }
            },
            error:function (error) {
               grecaptcha.reset();
                console.log(error);
                document.getElementById("btn_station_login").style.display = "block";
                document.getElementById("btn-loading").style.display = "none";
            }
          });

             
         })

})