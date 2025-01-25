
   // Document ready function to ensure the DOM is fully loaded before executing any code
   $(document).ready(function() {
    // Initialize the DataTable with custom configuration options
    $('#table').DataTable({
            // Define column alignment to center for all columns
            "columnDefs": [
                { "className": "dt-center", "targets": "_all" }
        ],
    dom: 'Blfrtip', // Move the Excel button below the table
    buttons: ['excel'],
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    lengthChange: true
    }); 
    
});