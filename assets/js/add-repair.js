$(document).ready(function () {

    var tbbody = $("#tbrepair");
    var items = [];

    // get All vehicle Classes
    $.ajax({
        type: "POST",
        url: "../api/getvehicleclassdata.php",
        success: function (data) {
            // console.log(JSON.parse(data))
            populateTableRepair(JSON.parse(data))
     }
    })

    function populateTableRepair(data) {
        data.forEach(function (list) {
            // console.log(list)
            var row = $("<tr>");
            row.append("<td class='rowID' style='display:none;'>" + list.id + "</td>");
            row.append(`<td>${list.name}</td>`);
            row.append(`<td><input type="text" class="form-control price" placeholder="LKR"></td>`);
            tbbody.append(row);

            var item = {
                rowID:row.find(".rowID")[0],
                priceInput: row.find(".price")[0],
            }

            items.push(item);


        })
    }



    $("#btn_add_repair").click(function () {
        var data = [];

        $(".price").each(function () {
            var ID = $(this).closest("tr").find(".rowID").text();
            var price = $(this).closest("tr").find(".price").val();

            data.push({
                price: price == "" ? 0 : price,
                ID:ID
              });
        })

        console.log(data)
       
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
                url: "../api/addrepair.php",
                data: {
                    code:generateUUID(),
                    repair_name:repair_name,
                    manage_repair:JSON.stringify(data)
                },
                success: function (response) {
        
                    console.log(response)

                if (response === "success") {
                    window.location.href = "../repair/";
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

})