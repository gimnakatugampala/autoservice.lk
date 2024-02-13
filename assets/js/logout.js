$(document).ready(function () {

    $("#stationLogout").click(function (e) {
        e.preventDefault();
        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/logout.php",
            data: {
              type:"station"
            },
            success: function (response) {
     
                console.log(response)

              if (response === "success") {
                window.location.href = "../";
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



    $("#employeeLogout").click(function (e) {
        e.preventDefault();
        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/logout.php",
            data: {
                type:"employee"
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
                }

            },
            error:function (error) {
                console.log(error)
            }
            });

                
        })

})