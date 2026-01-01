$(document).ready(function () {

    $("#add-vehicle-owner-btn").click(function () {

      
       
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var nic = $("#nic").val().toUpperCase();
        var phone_number = $("#phone_number").val();
        var other_phone_number = $("#other_phone_number").val();
        var address = $("#address").val();
        var city = $("#city").val();

        // console.log(first_name)
        // console.log(last_name)
        // console.log(email)
        // console.log(nic)
        // console.log(phone_number)
        // console.log(other_phone_number)
        // console.log(address)
        // console.log(city)

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

        }else if(address == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Address",
              });

              return
        }else if(city == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter City",
              });

              return
        }else{

             console.log(first_name)
        console.log(last_name)
        console.log(email)
        console.log(nic)
        console.log(phone_number.replace(/\s/g, ''))
        console.log(other_phone_number.replace(/\s/g, ''))
        console.log(address)
        console.log(city)

           // SHOW LOADING BTN
       document.getElementById("add-vehicle-owner-btn").style.display = "none"
       document.getElementById("btn-loading").style.display = "inline-block"


        //  SAVE DATA
        $.ajax({
            type: "POST",
            url: "../api/add-vehicle-owner.php",
            data: {
                code:generateUUID(),
                first_name:first_name,
                last_name:last_name,
                email:email,
                nic:nic,
                phone_number:phone_number.replace(/\s/g, ''),
                other_phone_number:other_phone_number.replace(/\s/g, ''),
                address:address,
                city:city
            },
            success: function (response) {
    
                console.log(response)

            if (response === "success") {
              Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Vehicle owner added successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT after confirmation
                                window.location.href = "../vehicle-owners/";
                            }
                        });
    
            }else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Vehicle Owner Already Exist.",
                });

                document.getElementById("add-vehicle-owner-btn").style.display = "inline-block"
                document.getElementById("btn-loading").style.display = "none"
            }

            },
            error:function (error) {
                console.log(error)
            }
        });
        }


        

             
         })

})