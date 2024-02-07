$(document).ready(function () {

    $("#btn_add_purchase").click(function () {
       
        var suppliers = $("#cmbsuppliers").val();
        var purchase_date = $("#purchase-date").val();
        var paidstatus = $("#cmbpaidstatus").val();
        var paid_amount = $("#paid_amount").val();
        var status = $("#cmbstatus").val();

        console.log(suppliers)
        console.log(purchase_date)
        console.log(paidstatus)
        console.log(paid_amount)
        console.log(status)
        
   

        if(suppliers == null){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Select Supplier",
              });
              return
        }else if(purchase_date == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Select Purchase Date",
              });
              return
        }else if(paidstatus == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Select Paid Status",
              });
              return
        }else if(status == null){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Select Status",
              });
              return
        }else if(paid_amount == ""){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please Enter Paid Amount",
              });
              return
        }else{

            // SAVE DATA

        }

        

             
         })

})