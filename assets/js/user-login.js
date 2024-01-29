$(document).ready(function () {

    $("#btn_user_login").click(function () {

       
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


        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/user-login.php",
            data: {
              email:email,
              password:password
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../vehicles/";
                // console.log("Success")
    
              }else {
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "Please check your credentials.",
                  });
              }

            },
            error:function (error) {
                console.log(error)
            }
          });

             
         })

})