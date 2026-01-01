$(document).ready(function () {

    document.addEventListener('DOMContentLoaded', getStationProfileDetails());

    function getStationProfileDetails() {
     
        // 
        $.ajax({
            type: "POST",
            url: "../api/getstationprofile.php",
            success: function (data) {
                console.log(JSON.parse(data))
                populateProfile(JSON.parse(data))
         }
        })
    
        function populateProfile(data) {
         
            const StationNameElement = document.getElementById("station_name");
            const PhoneNumberElement = document.getElementById("phone_number");
            const OtherPhoneNumberElement = document.getElementById("other_phone_number");
            const AddressElement = document.getElementById("address");
            const StreetElement = document.getElementById("street");
            const CityElement = document.getElementById("city");


            StationNameElement.value = data[0].service_name
            PhoneNumberElement.value = data[0].phone == null ? "" : data[0].phone
            OtherPhoneNumberElement.value = data[0].other_phone == null ? "" : data[0].other_phone
            AddressElement.value = data[0].address == null ? "" : data[0].address
            StreetElement.value = data[0].street == null ? "" : data[0].street
            CityElement.value = data[0].city == null ? "" : data[0].city

        }
    }



    $("#update_station_info").click(function () {
 

        var station_name = $("#station_name").val();
        var phone_number = $("#phone_number").val();
        var other_phone_number = $("#other_phone_number").val();
        var address = $("#address").val();
        var street = $("#street").val();
        var city = $("#city").val();
   

        if(station_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Station Name",
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
        }else if(street == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Street",
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

            console.log(station_name)
            console.log(phone_number)
            console.log(other_phone_number)
            console.log(address)
            console.log(street)
            console.log(city )

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/add-station-profile.php",
                data: {
                    station_name,
                    phone_number:phone_number.trim(),
                    other_phone_number:other_phone_number.trim(),
                    address,
                    street,
                    city
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {

                    Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Station profile updated successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect after user clicks OK
                                window.location.href = "../vehicles/";
                            }
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

})