$(document).ready(function () {

    $("#station_register_btn").click(function () {
        var station_name = $("#station_name").val();
        var station_logo = $("#station_logo")[0];
        var email = $("#email").val();
        var password = $("#password").val();
        var con_password = $("#con_password").val();

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

        }

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
        console.log(con_password)

    })

    // Swal.fire({
    //     icon: "error",
    //     title: "Error",
    //     text: "Please Enter your Username",
    //   });

})