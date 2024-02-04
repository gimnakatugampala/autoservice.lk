$(document).ready(function () {

    // Get The Code From URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('code');

    document.addEventListener('DOMContentLoaded', getRepairs());

    var tbbody = $("#tbeditrepair");
    var items = [];

    // get All vehicle Classes
    $.ajax({
        type: "POST",
        url: "../api/getvehicleclassdata.php",
        success: function (data) {
            // console.log(JSON.parse(data))
            // populateTableRepair(JSON.parse(data))
     }
    })

    function populateTableRepair(data) {
        data.forEach(function (list) {
            console.log(list)
            var row = $("<tr>");
            row.append("<td class='rowID' style='display:none;'>" + list.id + "</td>");
            row.append(`<td>${list.name}</td>`);
            row.append(`<td><input value="${list.price}" type="text" class="form-control price" placeholder="LKR"></td>`);
            tbbody.append(row);

            var item = {
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
})