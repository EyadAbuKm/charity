@extends('layouts.app')

@section('title', 'جميع الأفراد')

@section('content')

<div class="card card-default">


@if (session('success'))
    <div class="alert alert-success" style="text-align: center; margin: 0 auto; width: fit-content;">
        {{ session('success') }}
    </div>
@endif


    <div class="card-body" style="overflow-x: scroll">

    @if(isset($family_id))
    <button onclick="window.open('{{ route('family_members.create',$family_id) }}', '_blank')" class="btn btn-primary" style="color: rgb(22, 19, 37); width: 20%; margin: -10px 0 10px 0; display: block;">
    <i class="fa fa-home"></i> إضافة فرد إلى عائلة
    </button>
    @else
    <p></p>
    @endif        
    <h2 style="text-align: center;">الأفراد المُسجّلون</h2>         
         <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">

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
                    <th>إقامة السكن</th>  
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
                    <th>مستهلك؟</th>
                    <th>موظف الجمعية</th>  
                    <th>تعديل</th>
                    <th>حذف</th>
                    <th>Actions</th>  
                </tr>  
                <tr>
                    <th><input type="text" placeholder="Search Family ID" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Member Name" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Father's Name" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Mother's Name" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Date of Birth" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Place of Birth" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search ID Number" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Member Status" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Social Status" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Occupation" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Accommodation" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Monthly Income" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Education Level" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Health Level" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Disease" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Life Status" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Date of Death" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Work Status" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Mobile Number" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Home Address" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Search Work Address" style="width: 100%;"></th>
                    <th></th>
                    <th><input type="text" placeholder="Search Editor Name" style="width: 100%;"></th>
                    <th></th>
                    <th></th>
                    <th></th>
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
                    <td>{{ $member->Consumer }}</td>
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
    </div>
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


{{-- To export to excel and search in every field --}}
<script src="{{ asset('js/FamiliesTable.js') }}"></script>
@endsection