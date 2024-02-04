$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getCategory());

    $("#btn_update_category").click(function () {
       
      var category_name = $("#category_name").val();
      var dataIdValue = $(this).data("id");
 

      if(category_name == ""){
          Swal.fire({
              icon: "error",
              title: "Error",
              text: "Please Enter Category Name",
            });
            return
      }else{

          //  SAVE DATA
          $.ajax({
              type: "POST",
              url: "../api/editcategory.php",
              data: {
                  id:dataIdValue,
                  category_name:category_name
              },
              success: function (response) {
      
                  console.log(response)

              if (response === "success") {
                  window.location.href = "../products/category-list.php";
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


   function getCategory(){
       $.ajax({
         type: "POST",
         url: "../api/getcategory.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let CategoryNameElement = document.getElementById("category_name");
           var buttonElement = document.getElementById("btn_update_category");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           CategoryNameElement.value = data.data_content[0].name

   
         },
         error: function () {},
       });
   
     }
})