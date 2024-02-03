$(document).ready(function () {

     // Get The Code From URL
     const urlParams = new URLSearchParams(window.location.search);
     const myParam = urlParams.get('code');
 
     document.addEventListener('DOMContentLoaded', getVehicleOwners());

     // Update
    $("#update-vehicle-owner-btn").click(function () {

  
      
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var nic = $("#nic").val().toUpperCase();
      var phone_number = $("#phone_number").val();
      var other_phone_number = $("#other_phone_number").val();
      var address = $("#address").val();
      var city = $("#city").val();
      var dataIdValue = $(this).data("id");

// console.log(dataIdValue)
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

   


      //  SAVE DATA
      $.ajax({
          type: "POST",
          url: "../api/editvehicleowner.php",
          data: {
              id:dataIdValue,
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
                window.location.href = "../vehicle-owners/";
                // console.log("Success")
    
            }else if(response == "User Exist") {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Vehicle Owner Already Exist.",
                });
            }else{
              Swal.fire({
                icon: "error",
                title: "Please try Again",
                text: "Something Went Wrong.",
            });
            }

          },
          error:function (error) {
              console.log(error)
          }
      });

      }

    



    });


    function getVehicleOwners(){
        $.ajax({
          type: "POST",
          url: "../api/getvehicleowner.php",
          data: { code: myParam },
          dataType: "json",
          success: function (data) {
            console.log(data);
    
            let FirstNameElement = document.getElementById("first_name");
            let LastNameElement = document.getElementById("last_name");
            let EmailElement = document.getElementById("email");
            let NICElement = document.getElementById("nic");
            let PhoneNumberElement = document.getElementById("phone_number");
            let OtherPhoneNumberElement = document.getElementById("other_phone_number");
            let AddressElement = document.getElementById("address");
            let CityElement = document.getElementById("city");
            var buttonElement = document.getElementById("update-vehicle-owner-btn");
        
            buttonElement.setAttribute("data-id", data.data_content[0].id);
            FirstNameElement.value = data.data_content[0].first_name
            LastNameElement.value = data.data_content[0].last_name
            EmailElement.value = data.data_content[0].email
            NICElement.value = data.data_content[0].nic
            PhoneNumberElement.value = data.data_content[0].phone
            OtherPhoneNumberElement.value = data.data_content[0].other_phone
            AddressElement.value = data.data_content[0].address
            CityElement.value = data.data_content[0].city
    
            
    
          },
          error: function () {},
        });
    
      }
})