$(document).ready(function () {

    $("#station_register_btn").click(function () {
        var station_name = $("#station_name").val();
        var station_logo = $("#station_logo")[0];
        var email = $("#email").val();
        var password = $("#password").val();
        var con_password = $("#con_password").val();
        var lat = ""
        var long = ""

        console.log(station_logo)
        

        if(station_name == ""){
             Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Station Name",
              });

              return

        }else if(station_logo.files.length == 0){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Station Logo",
              });

              return

        }else if(email == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Station Email",
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

    

        fetch('https://ipapi.co/json/')
        .then(response => {
            return response.json();
        })
        .then(data => {
            // console.log('IP API Response:', data);
            lat = data.latitude
            long = data.longitude
        })
        .then(() => {

    console.log(generateUUID())
    console.log(station_name)
    console.log(email)
    console.log((lat).toString())

        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/station_register.php",
            data: {
              station_code:generateUUID(),
              station_name,
              email:email,
              password:con_password,
              lat:(lat).toString(),
              long:(long).toString(),
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../auth/user-register.php";
                // console.log("Success")
    
              } else if (response == "User Exist"){
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "Service Station Already Exist.",
                  });

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



        

        // if (station_logo.files.length > 0) {
        //     var selectedFile = station_logo.files[0];
        //     console.log("Selected File:", selectedFile);
        // } else {
        //     console.log("No file selected.");
        // }

        // console.log(station_name)
        // console.log(station_logo)
        // console.log(email)
        // console.log(password)
        // console.log(con_password)

             
         })


      

    // Swal.fire({
    //     icon: "error",
    //     title: "Error",
    //     text: "Please Enter your Username",
    //   });

})