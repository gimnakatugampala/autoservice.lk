$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getSuppliers());

    $("#btn_update_supplier").click(function () {
       
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var phone_number = $("#phone_number").val();
      var other_phone_number = $("#other_phone_number").val();
      var address = $("#address").val();
      var dataIdValue = $(this).data("id");
     
 

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
      }else{

      //  SAVE DATA
      $.ajax({
          type: "POST",
          url: "../api/editsupplier.php",
          data: {
              id:dataIdValue,
              first_name:first_name,
              last_name:last_name,
              email:email,
              phone_number:phone_number.replace(/\s/g, ''),
              other_phone_number:other_phone_number.replace(/\s/g, ''),
              address:address
          },
          success: function (response) {
  
              console.log(response)

          if (response === "success") {
              window.location.href = "../suppliers/";
              // console.log("Success")
  
          }else if(response == "Supplier Exist"){

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Supplier Already Exist.",
            });
          }else {

              Swal.fire({
                icon: "error",
                title: "Please Try Again",
                text: "Something Went Wrong",
            });
          }

          },
          error:function (error) {
              console.log(error)
          }
      });


      }


      

           
       })


   function getSuppliers(){
       $.ajax({
         type: "POST",
         url: "../api/getsuppliers.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FirstNameElement = document.getElementById("first_name");
           let LastNameElement = document.getElementById("last_name");
           let EmailElement = document.getElementById("email");
           let PhoneNumberElement = document.getElementById("phone_number");
           let OtherPhoneNumberElement = document.getElementById("other_phone_number");
           let AddressElement = document.getElementById("address");
           var buttonElement = document.getElementById("btn_update_supplier");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           FirstNameElement.value = data.data_content[0].first_name
           LastNameElement.value = data.data_content[0].last_name
           EmailElement.value = data.data_content[0].email
           PhoneNumberElement.value = data.data_content[0].phone
           OtherPhoneNumberElement.value = data.data_content[0].otherphone
           AddressElement.value = data.data_content[0].address

   
         },
         error: function () {},
       });
   
     }
})