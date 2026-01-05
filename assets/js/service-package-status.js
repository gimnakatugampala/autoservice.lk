$(document).ready(function () {
    // 1. Initialize DataTable
    // Checks if table exists and is not already initialized to prevent errors
    if ($('#example1').length && !$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    // 2. Initialize Bootstrap Switch
    // This turns standard checkboxes into toggle switches
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    // 3. Handle Status Toggle Change
    $('body').on('switchChange.bootstrapSwitch', 'input[data-bootstrap-switch]', function (event, state) {
        // state is true (ON/Active) or false (OFF/Deleted)
        // Database logic: 0 = Active (Not Deleted), 1 = Deleted
        var isDeleted = state ? 0 : 1; 
        var packageId = $(this).data('id');
        console.log(isDeleted)
        $.ajax({
            url: '../api/update-package-status.php',
            type: 'POST',
            data: { 
                id: packageId, 
                is_deleted: isDeleted 
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    console.log('Status updated for ID: ' + packageId);
                    // Optional: Add a Toast/SweetAlert here for success message
                } else {
                    alert('Error updating status: ' + response.message);
                    // Revert switch state if server update failed
                    $(event.target).bootstrapSwitch('toggleState', true); 
                }
            },
            error: function() {
                alert('Server connection failed. Please check your internet connection.');
                // Revert switch state on connection error
                $(event.target).bootstrapSwitch('toggleState', true);
            }
        });
    });

    // 4. Initialize Tooltips
    $('[data-toggle="tooltip"]').tooltip();
});