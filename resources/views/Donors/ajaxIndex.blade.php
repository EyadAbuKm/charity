@extends('layouts.app')  

@section('title', 'التبرعات')  

@section('content')  


@if(session('success'))  
<div class="alert alert-success" style="width: 40%; margin: 0px auto; text-align: center;">  
    {{ session('success') }}  
</div>  
@endif  

@if(session('error'))  
<div class="alert alert-danger" style="width: 40%; margin: 0px auto; text-align: center;">  
    {{ session('error') }}  
</div>  
@endif  

<div class="card card-default">  
    <div class="card-header" style="display: flex; justify-content: center;">  
        <h2>التبرعات</h2>  
    </div>  

    <div class="card-body" style="overflow-x: scroll">  
        <table id="table" class="display" style="text-align: center; margin: 0px auto; width:100%" dir="rtl">  
            <tbody>  

            </tbody>  
        </table>  
    </div>  
</div>  

@endsection  

@section('customJs')  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">   
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">  

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>  

   
  
<script>
    $(document).ready(function() {  
        // Initialize DataTable with server-side processing  
        var table = $('#table').DataTable({  
            processing: true, // Show processing indicator  
            serverSide: true, // Enable server-side processing  
            ajax: {  
                url: '/Donors/Search', // URL to your Laravel route that handles the data  
                type: 'GET', // Change this to 'POST' if necessary 
               
                data: function(d) {  
                // Get the search value from the single search input  
                var searchValue = $('#global-search').val(); // Assume your input has an ID 'global-search'  

                // If there's a search value, add it to the request parameters  
                if (searchValue) {  
                    d.search = { value: searchValue };// This sends the search value to the server  
                }  
            },     
            },  
            columns: [  
            { data: 'date', title: 'التاريخ', orderable: true }, // Date column  
            { data: 'time', title: 'الوقت', orderable: true }, // Time column  
            { data: 'Name', title: 'الاسم', orderable: true }, // Name column  
            { data: 'Donation_Type', title: 'فئة التبرع', orderable: true }, // Donation category column  
            { data: 'DonationDetails', title: 'نوع التبرع', orderable: true }, // Donation type column  
            { data: 'Amount', title: 'المبلغ', orderable: true }, // Amount column  
            { data: 'Description', title: 'ملاحظات', orderable: true }, // Notes column  
            { data: 'Phone', title: 'هاتف', orderable: true }, // Phone column  
            // { data: 'edit', title: 'تحديث', orderable: false, searchable: false }, // Update column (typically a button)  
            // { data: 'delete', title: 'حذف', orderable: false, searchable: false } // Delete column (typically a button)  
            ],  
            order: [[0, "desc"], [1, "desc"]],  
            columnDefs: [  
                { className: "dt-center", targets: "_all" }  
            ],  
            dom: 'Bfrtip',  
            buttons: ['excel'],  
        });  
    
        // Apply the search  
        $('#table thead tr:eq(1) th').each(function(i) {  
            $('input', this).on('keyup change', function() {  
                if (table.column(i).search() !== this.value) {  
                    table.column(i).search(this.value).draw();  
                }  
            });  
        });  
    });
</script>


{{-- تنسيق قيم المبلغ عند تحميل الصفحة باستخدام JavaScript --}}
{{-- تنسيق القيم الرقمية الخاصة بالمبالغ في خلايا الجدول عند تحميل الصفحة --}}
 <script src="{{ asset('js/formatNumberTable.js') }}"></script>  
  
      
@endsection