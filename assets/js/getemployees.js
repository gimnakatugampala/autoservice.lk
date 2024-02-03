$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getEmployees());


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