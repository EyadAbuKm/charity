
//يقوم هذا الكود بتهيئة جدول DataTable 
// مع ميزة البحث والتصدير إلى Excel
// مع إمكانية الفلترة في كل حقل من الجدول


$(document).ready(function() {
    // Initialize DataTable
    var table = $('#table').DataTable({

          // Set default ordering by date column in descending order
          "order": [[0, "desc"], [1, "desc"]],
     
          // Define column alignment to center for all columns
           "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
           ],
        dom: 'Bfrtip',
        buttons: [ 'excel']
        
      //  lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
       // lengthChange: true
    });

    // Apply the search
    $('#table thead tr:eq(1) th').each(function(i) {
        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
});
