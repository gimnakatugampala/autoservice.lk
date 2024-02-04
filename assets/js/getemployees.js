$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getEmployees());

    // Update
    $("#btn_update_employee").click(function () {

      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var nic = $("#nic").val().toUpperCase();
      var phone_number = $("#phone_number").val();
      var other_phone_number = $("#other_phone_number").val();
      var dob = $("#dob").val();
      var pass = $("#pass").val();
      var con_pass = $("#con_pass").val();
      var cmbusertypes = $("#cmbusertypes").val();
      var dataIdValue = $(this).data("id");

   
console.log(dataIdValue)
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
      }else if(cmbusertypes == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Select User Type",
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


           //  SAVE DATA
      $.ajax({
          type: "POST",
          url: "../api/editemployee.php",
          data: {
              id:dataIdValue,
              first_name:first_name,
              last_name:last_name,
              email:email,
              nic:nic,
              phone_number:phone_number.replace(/\s/g, ''),
              other_phone_number:other_phone_number.replace(/\s/g, ''),
              dob:dob,
              user_type:cmbusertypes,
              pass:pass,
              con_pass:con_pass
          },
          success: function (response) {
  
              console.log(response)

          if (response === "success") {
              window.location.href = "../employees/";
  
          }else if(response == "Employee Exist"){

              Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Employee Already Exist.",
                });

            }else {
              Swal.fire({
                  icon: "error",
                  title: "Something Went Wrong",
                  text: "Please Try Again.",
                });
            }

          },
          error:function (error) {
              console.log(error)
          }
      });

      }

    



    });

   function getEmployees(){
       $.ajax({
         type: "POST",
         url: "../api/getemployees.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FirstNameElement = document.getElementById("first_name");
           let LastNameElement = document.getElementById("last_name");
           let NICElement = document.getElementById("nic");
           let EmailElement = document.getElementById("email");
           let PhoneNumberElement = document.getElementById("phone_number");
           let OtherPhoneNumberElement = document.getElementById("other_phone_number");
           let DOBElement = document.getElementById("dob");
           let UserTypesElement = document.getElementById("cmbusertypes");
           var buttonElement = document.getElementById("btn_update_employee");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           FirstNameElement.value = data.data_content[0].first_name
           LastNameElement.value = data.data_content[0].last_name
           NICElement.value = data.data_content[0].nic
           EmailElement.value = data.data_content[0].email
           PhoneNumberElement.value = data.data_content[0].contact_number
           OtherPhoneNumberElement.value = data.data_content[0].emergency_number
           DOBElement.value = data.data_content[0].dob
           UserTypesElement.value = data.data_content[0].user_type_id


   
           
   
         },
         error: function () {},
       });
   
     }
})