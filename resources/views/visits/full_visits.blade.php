@extends('layouts.app')

@section('title', 'الزيارات')

@section('content')

<div class="card card-default">
    <div class="card-header" style="display: flex; justify-content: center;">
      <h2>تقرير الزيارات</h2>  
    </div> 

    <div class="container">  
    <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl" >
        <thead>  
            <tr>  
                <th>Family ID</th> 
                <th>ID</th>  
                <th>Date</th>
                <th>Family</th>  
                <th>Comment</th>  
                <th>Visiting Officer</th>  
                @foreach ($checklists as $checklist)
                    <th>{{ $checklist->Name }}</th>  
                @endforeach
            </tr> 
            <tr>  

                <th><input type="text" placeholder="Family ID" style="width: 100%;"></th>  
                <th></th>
                <th><input type="text" placeholder="Date" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Family" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Comments" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Officer" style="width: 100%;"></th>  
                @foreach ($checklists as $checklist)
                    <th> <input type="text" placeholder="{{ $checklist->Name }}" style="width: 150%;"></th>  
                @endforeach 
            </tr>  
        </thead>  
        <tbody>  
            @forelse($visits as $visit)  
                <tr>  
                    <td>{{ $visit->Family_ID }}</td>  
                    <td>{{ $visit->id }}</td>  
                    <td>{{ $visit->Date }}</td>  
                    <td>{{ $visit->family->Applicant_Name }}</td>  
                    <td>{{ $visit->Comment }}</td>  
                    <td>{{ $visit->Visiting_Officer }}</td>  
                    @foreach ($checklists as $checklist)
                        @php
                            // Find the corresponding checklist status for this visit and checklist
                            $checklistObj = $visit->visitsChecklists->firstWhere('Check_List_ID', $checklist->id);
                        @endphp
                        <td>
                            @if($checklistObj)
                                {{ $checklistObj->Status }} <br>  {{ $checklistObj->Comments }} <!-- Show the checklist status -->
                            @else
                                -  <!-- Show a default value if no checklist entry exists -->
                            @endif
                        </td>
                    @endforeach
                </tr>  
            @empty  
                <tr>
                    <td colspan="{{ 4 + count($checklists) }}" class="text-center">No visits found.</td>
                </tr>
            @endforelse  
        </tbody>  
    </table>  
</div>

@endsection


    @section('customJs')  
    
        
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    
            {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
        
            <script src="{{ asset('js/FamiliesTable.js') }}"></script> 
        
    
    @endsection
    