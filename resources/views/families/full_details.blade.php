@extends('layouts.app')

@section('title', 'معلومات أسرة محددة')

@section('content')


<!-- Check if there's an error message in the session -->  
@if (session('error'))  
<div style="color: red; text-align: center;">  
    {{ session('error') }}  
</div>  
@endif   

<!-- Family ID Input Form -->  
<div class="card card-default">
    <div class="card-header">
      
    </div> 

    <div class="form-container" style="padding-right: 20px;padding-left: 20px;">  
<form action="{{ route('families.full_details') }}" method="GET" style="text-align: center; margin-bottom: 20px;" >  
    <input type="text" name="Family_ID" placeholder="Enter Family ID" required autofocus>  
    <button type="submit">Search</button>  
</form>  

<br><br>
<!-- Family Details Table -->  
<h2 style="text-align: center;">بيانات العائلة</h2>  
<table id="family-table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
    <thead>  
        <tr>  
            <th>رقم دفتر العائلة</th>
                    <th>المحافظة</th>
                    <th>رقم الملف</th>
                    <th>تاريخ تقديم الطلب</th>
                    <th style="color:rgb(170, 19, 186);">مُقدّم الطلب</th>
                    <th>هاتف</th>
                    <th>رقم الجوال</th>
                    <th>العنوان في داريا</th>
                    <th>العنوان الحالي</th>
                    <th>حالة السكن</th>
                    <th>تصنيف الأسرة</th>
                    <th>الآجار الشهري</th>
                    <th>موارد إضافية</th>
                    <th>الملخص</th>
                    <th>ملاحظات</th>
                    <th>موظف الجمعية</th>  
        </tr>  
    </thead>  
    
    <tbody>  
        <tr>  
            <td>{{ $family->Family_ID }}</td>   
            <td>{{ $family->governorate->name }}</td>  
            <td>{{ $family->FIle_No }}</td>  
            <td>{{ \Carbon\Carbon::parse($family->Application_Date)->format('Y-m-d') }}</td>  
            <td>{{ $family->Applicant_Name }}</td>  
            <td>{{ $family->Tel_Number }}</td>  
            <td>{{ $family->Mob_Number }}</td>  
            <td>{{ $family->Daria_Address }}</td>  
            <td>{{ $family->Current_Address }}</td>  
            <td>{{ $family->homeStatus->status }}</td>  
            <td>{{ $family->familyRate->Rate }}</td> 
            <td>{{ $family->Monthly_Rent }}</td>  
            <td>{{ $family->Another_Resources }}</td>  
            <td>{{ $family->Summary }}</td>  
            <td>{{ $family->Notes }}</td>  
            <td>{{ $family->File_Editor_Name }}</td>          
        </tr>  
    </tbody>  
</table>

<!-- Family Members Table -->  
<h2 style="text-align: center;">أفراد العائلة</h2>  
<table id="members-table" class="display table-responsive" style="text-align: center; width:98%; margin: 0px auto;" dir="rtl">  
    <thead>  
        <tr>  
            <th>رقم دفتر العائلة</th>  
            <th>الاسم</th>  
            <th>اسم الأب</th>  
            <th>اسم الأم</th>  
            <th>تاريخ الميلاد</th>  
            <th>مكان الميلاد</th>  
            <th>الرقم الوطني</th>  
            <th>الوضع العائلي</th>  
            <th>الحالة الاجتماعية</th>  
            <th>المهنة</th>  
            <th>نوع السكن</th>  
            <th>الدخل الشهري</th>  
            <th>مستوى التعليم</th>  
            <th>المستوى الصحي</th>  
            <th>نوع المرض</th>  
            <th>الوضع الحياتي</th>  
            <th>تاريخ الوفاة</th>  
            <th>العمل</th>  
            <th>رقم الجوال</th>  
            <th>عنوان السكن</th>  
            <th>عنوان العمل</th>  
            <th>موظف الجمعية</th>  
            <th>تعديل</th>
            <th>حذف</th>
            <th>Actions</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach($familyMembers as $member)  
        <tr>  
            <td>{{ $member->Family_ID }}</td>  
            <td>{{ $member->Name }}</td>  
            <td>{{ $member->Father_Name }}</td>  
            <td>{{ $member->Mother_Name }}</td>  
            <td>{{ \Carbon\Carbon::parse($member->Date_Of_Birth)->format('Y-m-d') }}</td>  
            <td>{{ $member->Place_Of_Birth }}</td>  
            <td>{{ $member->ID_NO }}</td>  
            <td>{{ $member->memberStatus->Name }}</td>  
            <td>{{ $member->socialStatus->Name }}</td>  
            <td>{{ $member->Occupation }}</td>  
            <td>{{ $member->Accommodation }}</td>  
            <td>{{ $member->Monthly_Income }}</td>  
            <td>{{ $member->educationLevel->Name }}</td>  
            <td>{{ $member->healthyLevel->Name }}</td>  
            <td>{{ $member->typeOfDisease->Name }}</td>  
            <td>{{ $member->lifeStatus->Name }}</td>  
            <td>{{ $member->Date_Of_Death ? \Carbon\Carbon::parse($member->Date_Of_Death)->format('Y-m-d') : 'N/A' }}</td>  
            <td>{{ $member->workStatus->Name }}</td>  
            <td>{{ $member->Mob_Number }}</td>  
            <td>{{ $member->Home_Address }}</td>  
            <td>{{ $member->Work_Address }}</td>  
            <td>{{ $member->File_Emp_Name }}</td>  
            <td>  
                <td>
            {{-- <a href="/family_members/edit/{{ $member->ID }}"> <i class="fas fa-edit"></i> Edit </a> --}}
            <a href="{{ route('family_members.edit', $member->ID) }}" target="_blank">Edit</a>
            </td>
            

            <td>
                <form action="{{ route('family_members.Delete', $member->ID) }}" method="POST" target="_blank" onsubmit="return confirm('هل أنت متأكد من حذف سجل  {{ $member->Name }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>
                </form>
            </td>
                                                                        
           
        </tr>  
        @endforeach  

    </tbody>  
</table>  


<!-- Material Aid Table -->  
<h2 style="text-align: center;">الزيارات</h2>  
<table id="material-aid" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
      
    <thead>  
        <tr>  
            <th>ID</th>  
            <th>Date</th>  
            <th>Comment</th>  
            <th>Visiting Officer</th>  
            
            @foreach ($checklists as $checklist)
                <th>{{ $checklist->Name }}</th>  
            @endforeach
        </tr>  
    </thead>  
    <tbody>  
        @forelse($visits as $visit)
            <tr>
                <td>{{ $visit->id }}</td>
                <td>{{ $visit->Date }}</td>
                <td>{{ $visit->Comment }}</td>
                <td>{{ $visit->Visiting_Officer }}</td>
                <!-- Now we loop through the checklists for the current visit -->
                @foreach ($checklists as $checklist)
                    @php
                        // Find the corresponding checklist status for this visit and checklist
                        $checklistObj = $visit->visitsChecklists->firstWhere('Check_List_ID', $checklist->id);
                    @endphp
                    <td>
                        @if($checklistObj)
                            {{ $checklistObj->Status }}  <!-- Show the checklist status -->
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

<!-- Cash Aid Table -->  
<h2 style="text-align: center;">المساعدات المالية</h2>  
<table id="cash-aid-table" class="display" style="text-align: center; width:98%; margin: 0px auto;" dir="rtl">  
    <thead>  
        <tr>  
            <th>ID</th>  
            <th>رقم دفتر العائلة</th>  
            <th>التاريخ</th>  
            <th>المبلغ</th>  
            <th>ملاحظات</th>  
            <th>تعديل</th>  
            <th>حذف</th>
            {{-- <th>Actions</th> --}}
        </tr>  
    </thead>  
    <tbody>  
        @foreach($cashAids as $cashAid)  
        <tr>
            <td>{{ $cashAid->ID }}</td>   
            <td>{{ $cashAid->Family_ID }}</td>  
            <td>{{ \Carbon\Carbon::parse($cashAid->Date_)->format('Y-m-d') }}</td>  
            <td>{{ $cashAid->Amount }}</td>  
            <td>{{ $cashAid->Comment }}</td>  
        
<td>  
    <a href="/CashAid/edit/{{ $cashAid->ID }}" target="_blank"><i class="fas fa-edit" ></i> Edit</a>  
</td>  


<td>
    <form action="{{ route('CashAid.delete', $cashAid->ID) }}" method="POST" target="_blank" onsubmit="return confirm('هل أنت متأكد من حذف سجل  {{ $cashAid->ID }}?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>

    </form>
</td> 

        </tr>    
        @endforeach  
    </tbody>  
</table>  

<!-- Material Aid Table -->  
<h2 style="text-align: center;">المساعدات العينية</h2>  
<table id="material-aid" class="display" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
      
    <thead>  
        <tr>  
            <th>ID</th>  
            <th>رقم دفتر العائلة</th>  
            <th>التاريخ</th>  
            <th>نوع المساعدة</th>  
            <th>المبلغ</th>  
            <th>ملاحظات</th>  
            <th>تعديل</th>  
            <th>حذف</th>  
            {{-- <th>Actions</th>   --}}
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($materialAids as $materialAid)  
            <tr>  
                <td>{{ $materialAid->ID }}</td>  
                <td>{{ $materialAid->Family_ID }}</td>  
                <td>{{ \Carbon\Carbon::parse($materialAid->Date)->format('Y-m-d') }}</td> <!-- Ensure date is formatted -->  
                <td>{{ $materialAid->typeOfMaterialAid->Name }}</td>  
                <td>{{ $materialAid->Amount }}</td>  
                <td>{{ $materialAid->Comment }}</td>  
                <td>  
                    <a href="/MaterialAid/edit/{{ $materialAid->ID }}" target="_blank"><i class="fas fa-edit"></i> Edit</a>  
                </td>  
                <td>  
                    <form action="{{ route('MaterialAid.delete', $materialAid->ID) }}" method="POST" target="_blank" style="display:inline;">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>  
                    </form>  
                </td>  
            </tr>  
        @endforeach  
    </tbody>  
</table>



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
        
        <script>  
            $(document).ready(function() {  
                $('#family-table, #members-table, #cash-aid-table, #material-aid').DataTable({    
                // Initialize DataTables for all tables with .display class  
            // $('.display').DataTable({    
            dom: 'Bfrtip',  
                    buttons: ['excel']  ,
                });  
            });  
        </script>  

@endsection

