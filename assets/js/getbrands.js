$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getBrands());

    $("#btn_update_brand").click(function () {
       
      var brand_name = $("#brand_name").val();
      var dataIdValue = $(this).data("id");
 

      if(brand_name == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Brand Name",
            });
            return
      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editbrand.php",
              data: {
                  id:dataIdValue,
                  brand_name:brand_name
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {

                Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: "Brand updated successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT only after user clicks OK
                                window.location.href = "../products/brand-list.php";
                            }
                        });

                 
                  // console.log("Success")
      
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


   function getBrands(){
       $.ajax({
         type: "POST",
         url: "../api/getbrands.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let BrandNameElement = document.getElementById("brand_name");
           var buttonElement = document.getElementById("btn_update_brand");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           BrandNameElement.value = data.data_content[0].brand_name

   
         },
         error: function () {},
       });
   
     }
})