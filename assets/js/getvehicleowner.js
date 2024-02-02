$(document).ready(function () {

     // Get The Code From URL
     const urlParams = new URLSearchParams(window.location.search);
     const myParam = urlParams.get('code');
 
     document.addEventListener('DOMContentLoaded', getVehicleOwners());


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