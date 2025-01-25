@extends('layouts.app')

@section('title', 'إضافة زيارة')
@section('content')

<style>  
    .error {  
        color: red;  
    }  
</style>   
<style>

    .col-md-4{
        text-align: right;
    }
    </style> 


@if (session('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('success') }}
    </div>
@endif

<div>  
    <h2 class="text-center">إضافة زيارة</h2>  

    <!-- Display error message -->  
    @if(session('error'))  
        <div class="error">{{ session('error') }}</div>  
    @endif  

    <form action="{{ route('visits.add') }}" method="POST" style="text-align: right;" dir="rtl">  
        @csrf  
    
        <div class="container">  
            <div class="row mb-3">  
                
                <div class="col-md-4">  
                    <label for="Family_ID">رقم دفتر العائلة:</label>  
                    <input type="number" name="Family_ID" id="Family_ID" required class="form-control" autofocus>  
                </div> 

                <div class="col-md-4">  
                    <label for="Applicant_Name">العائلة</label>  
                    <input type="text" id="Applicant_Name" class="form-control" readonly>  
                </div>  
                
             

                <div class="col-md-4">  
                    <label for="Date">التاريخ:</label>  
                    <input type="date" name="Date" id="Date" class="form-control" value="{{ date('Y-m-d') }}" >  
                </div>  

              
                
                {{-- <div class="col-md-10" style="text-align: right;direction: rtl;">  
                    <label for="Comment">ملاحظات:</label>  
                    <input type="text" id="Comment" name="Comment" class="form-control">  
                </div>   --}}
            
            </div>  
            <div class="form-group row" style="text-align: right;direction: rtl;">  
                <label for="Visiting_Officer" class="col-md-2 col-form-label"> ملاحظات:</label>  
                <div class="col-md-4">  
                    <input type="text" name="Comment" id="Comment" required class="form-control">  
                </div>  
            </div>          
    
            {{-- <div class="row mb-3">   --}}
               
                <div class="form-group row" style="text-align: right;direction: rtl;">  
                    <label for="Visiting_Officer" class="col-md-2 col-form-label">موظف الجمعية:</label>  
                    <div class="col-md-4">  
                        <input type="text" name="Visiting_Officer" id="Visiting_Officer" required class="form-control">  
                    </div>  
                </div>                 
            {{-- </div>   --}}

            <hr>
            <br>
    
            <div id="checklistItems" class="row">  
                @foreach($checkLists as $index => $checkList)  
                    <div class="col-md-4 mb-3">  
                        <input type="checkbox" name="check_lists[{{ $index }}][Status]" value="1">  
                        <label>{{ $checkList->Name }}</label>  
                        <input type="hidden" name="check_lists[{{ $index }}][Check_List_ID]" value="{{ $checkList->id }}">  
                        <input name="check_lists[{{ $index }}][Comments]" placeholder="Comments" value="{{ $checkList->Comments ?? '.' }}" class="form-control">  
                    </div>  
                @endforeach  
            </div>  
    
            <div class="row">  
                <div class="col-md-12">  
                    <button type="submit" class="btn btn-primary">إضافة زيارة</button>  
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>  
            </div>  
        </div>  
    </form>  
    


 {{-- this Two scripts for get Applicant Name from Family Table    --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- updates the Applicant_Name field based on the selected Family_ID without reloading the page --}}
    <script>
        // Execute function when document is fully loaded
        $(document).ready(function() {
            // Listen for changes in the input field with ID 'Family_ID'
            $('#Family_ID').on('change', function() {
                // Get the value of the selected family ID
                var familyId = $(this).val();
    
                // Check if a valid family ID was entered
                if (familyId) {
                    // Send an AJAX request to retrieve the applicant name based on the family ID
                    $.ajax({
                        // Define the URL endpoint with the selected family ID appended to it
                        url: '{{ url("/get-applicant-name") }}/' + familyId,
                        type: 'GET', // Specify the request method as GET
                        dataType: 'json', // Set the expected response data format to JSON
    
                        // Function to handle a successful response
                        success: function(response) {
                            // Check if the response contains an 'Applicant_Name'
                            if (response.Applicant_Name) {
                                // Set the 'Applicant_Name' field with the name received from the server
                                $('#Applicant_Name').val(response.Applicant_Name);
                            } else {
                                // Display 'Not found' if 'Applicant_Name' is not available in the response
                                $('#Applicant_Name').val('Not found');
                            }
                        },
    
                        // Function to handle errors in the AJAX request
                        error: function() {
                            // Display an error message in the 'Applicant_Name' field if there was an issue fetching data
                            $('#Applicant_Name').val('لايوجد عائلة');
                        }
                    });
                } else {
                    // Clear the 'Applicant_Name' field if the 'Family_ID' is empty
                    $('#Applicant_Name').val('');
                }
            });
        });
    </script>
    
</div>
@endsection