$(document).ready(function () {

      $(".table.table-bordered.table-striped.tb_notification").on("click", ".notificationItem", function () {
        var VehicleNumber = $(this).data('vno');
        var VehicleOwner = $(this).data('vo');
        var VehicleOwnerPhone = $(this).data('phone');
        var JobCardID = $(this).data('jobcardid');

        Swal.fire({
            title: "Are you sure?",
            text: "This action will send an SMS to the Vehicle Owner!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Send Message!"
          }).then((result) => {
            if (result.isConfirmed) {
            // -------- SEND MESSAGE -----

                //  SEND SMS
                $.ajax({
                    type: "POST",
                    url: "../api/sendnotification-sms.php",
                    data: {
                        VehicleNumber,
                        VehicleOwner,
                        VehicleOwnerPhone:convertToInternationalFormat(VehicleOwnerPhone),
                        JobCardID
                    },
                    success: function (response) {

                        console.log(response)

                        if (response === "success") {

                            Swal.fire({
                            title: "SMS Sent!",
                            text: "SMS has been sent to the Vehicle Owner.",
                            icon: "success"
                            });

                            setTimeout(() => {
                                window.location.reload()
                            },1500)


                        }else {
                            Swal.fire({
                                icon: "error",
                                title: "Please Try Again",
                                text: "Something Went Wrong.",
                            });
                        }

                    },
                    error:function (error) {
                        console.log(error)
                    }
                });

            // -------- SEND MESSAGE -----


            }
          });
       


    

    
      })

      function convertToInternationalFormat(localNumber) {
        // Remove leading "0" and prepend "+94"
        return "94" + localNumber.slice(1);
      }


      

    
   


   
})