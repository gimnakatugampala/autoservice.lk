$(document).ready(function () {

    $("#btn_add_employee").click(function () {
       
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var nic = $("#nic").val().toUpperCase();
        var phone_number = $("#phone_number").val();
        var other_phone_number = $("#other_phone_number").val();
        var dob = $("#dob").val();
        var pass = $("#pass").val();
        var con_pass = $("#con_pass").val();

     

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
        }else if(nic == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter National Identity Card",
              });

              return

        }else if(phone_number == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Phone Number",
              });

              return

        }else if(dob == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter DOB",
              });

              return
        }else if(pass == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Password",
              });
              return

        }else if(con_pass == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Confirm Password",
              });
              return

        }else if(pass != con_pass){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Passwords Do not Match",
              });
              return

        }else{

            console.log(first_name)
            console.log(last_name)
            console.log(email)
            console.log(nic)
            console.log(phone_number)
            console.log(other_phone_number)
            console.log(dob)
            console.log(pass)
            console.log(con_pass)


             //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/add-employee.php",
            data: {
                code:generateUUID(),
                first_name:first_name,
                last_name:last_name,
                email:email,
                nic:nic,
                phone_number:phone_number.replace(/\s/g, ''),
                other_phone_number:other_phone_number.replace(/\s/g, ''),
                dob:dob,
                pass:pass,
                con_pass:con_pass
            },
            success: function (response) {
    
                console.log(response)

            // if (response === "success") {
            //     window.location.href = "../vehicle-owners/";
            //     // console.log("Success")
    
            // }else {
            //     Swal.fire({
            //         icon: "error",
            //         title: "Error",
            //         text: "Vehicle Owner Already Exist.",
            //     });
            // }

            },
            error:function (error) {
                console.log(error)
            }
        });


            console.log(first_name)
            console.log(last_name)
            console.log(email)
            console.log(nic)
            console.log(phone_number.replace(/\s/g, ''))
            console.log(other_phone_number.replace(/\s/g, ''))
        }


             
         })

})