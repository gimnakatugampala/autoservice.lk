$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getRepairs());

    var tbbody = $("#tbeditrepair");
    var items = [];
   

    function populateTableRepair(data) {
        data.forEach(function (list) {
            // console.log(list)
            var row = $("<tr>");
            row.append("<td class='repairID' style='display:none;'>" + list.repair_id + "</td>");
            row.append("<td class='rowID' style='display:none;'>" + list.id + "</td>");
            row.append(`<td>${list.name}</td>`);
            row.append(`<td><input value="${list.price}" type="text" class="form-control price" placeholder="LKR"></td>`);
            tbbody.append(row);

            var item = {
                repairID:row.find(".repairID")[0],
                rowID:row.find(".rowID")[0],
                priceInput: row.find(".price")[0],
            }

            items.push(item);


        })
    }


   function getRepairs(){
       $.ajax({
         type: "POST",
         url: "../api/getrepairs.php",
         data: { code: myParam },
         dataType: "json",
         success: function (data) {
           console.log(data);
   
           let RepairNameElement = document.getElementById("repair_name");
           var buttonElement = document.getElementById("btn_update_repair");
        
           buttonElement.setAttribute("data-id", data.data_content[0].id);
           RepairNameElement.value = data.data_content[0].name
       
            populateTableRepair(data.manage_repairs)
   
         },
         error: function () {},
       });
   
     }


     $("#btn_update_repair").click(function () {
        var data = [];

        var dataIdValue = $(this).data("id");
        $(".price").each(function () {
            var ID = $(this).closest("tr").find(".rowID").text();
            var repairID = $(this).closest("tr").find(".repairID").text();
            var price = $(this).closest("tr").find(".price").val();

            data.push({
                price: price == "" ? 0 : price,
                ID:ID,
                repairID
              });
        })

        console.log(data)
        console.log(dataIdValue)
       
        var repair_name = $("#repair_name").val();
   

        if(repair_name == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Repair Name",
              });
              return
        }else{

            //  SAVE DATA
            $.ajax({
                type: "POST",
                url: "../api/editrepair.php",
                data: {
                    id:dataIdValue,
                    repair_name:repair_name,
                    manage_repair:JSON.stringify(data)
                },
                success: function (response) {
        
                    console.log(response)

                if (response.trim() === "success") {
                  Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: "Repair updated successfully!",
                            confirmButtonColor: "#007bff",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // REDIRECT only after user clicks OK
                                window.location.href = "../repair/";
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