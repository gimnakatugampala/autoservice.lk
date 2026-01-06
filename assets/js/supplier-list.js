$(document).ready(function () {
    // 1. Initialize DataTable
    if (!$.fn.DataTable.isDataTable('#example1')) {
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
    
    // 2. Initialize Tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // 3. DELETE BUTTON LOGIC
    $('body').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        // SweetAlert Confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request
                $.ajax({
                    url: '../api/delete-supplier.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'The supplier has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload page to update list
                                location.reload(); 
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong with the server.', 'error');
                    }
                });
            }
        });
    });
});