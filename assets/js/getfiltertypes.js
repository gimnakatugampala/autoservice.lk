$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getFilterTypes());

    $("#btn_update_filter").click(function () {
       
      var filter_type = $("#filter_type").val();
      var dataIdValue = $(this).data("id");
 

      if(filter_type == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Filter Type",
            });
            return
      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editfiltertype.php",
              data: {
                  id:dataIdValue,
                  filter_type:filter_type
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {
                  window.location.href = "../service-packages/filter-types.php";
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


   function getFilterTypes(){
       $.ajax({
         type: "POST",
         url: "../api/getfiltertypes.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let FilterTypeElement = document.getElementById("filter_type");
           var buttonElement = document.getElementById("btn_update_filter");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           FilterTypeElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})