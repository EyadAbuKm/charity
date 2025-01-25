@extends('layouts.app')

@section('title', 'جميع الأسر')

@section('content')

<div class="card card-default">
    <div class="card-header" style="display: flex; justify-content: center;">
      <h2>الأُسر المسجلة</h2>  
    </div>
    
    <div class="card-body" style="overflow-x: scroll">
        
       {{-- Display Success and Error Messages Outside the Loop --}}
        @if(session('success'))
            <div class="alert alert-success" style="width: 70%; margin: 0px auto; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="width: 70%; margin: 0px auto; text-align: center;">
                {{ session('error') }}
            </div>
        @endif

        
        {{-- <h1>Families List</h1> --}}

        <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl" >
            <thead>
                <tr>
                    <th>Action</th>
                    <th>رقم دفتر العائلة</th>
                    <th>المحافظة</th>
                    <th>رقم الملف</th>
                    <th>تاريخ تقديم الطلب</th>
                    <th>مُقدّم الطلب</th>
                    <th>هاتف</th>
                    <th>رقم الجوال</th>
                    <th>العنوان في داريا</th>
                    <th>العنوان الحالي</th>
                    <th>حالة السكن</th>
                    <th>تصنيف الأسرة</th>
                    <th>الآجار الشهري</th>
                    <th>موارد إضافية</th>
                    <th>عدد افراد الاسرة</th>
                    <th>عدد افراد الاسرة المستهلكين</th>
                    <th>الملخص</th>
                    <th>ملاحظات</th>
                    <th>موظف الجمعية</th>
                    <th>حذف</th>
                  
                </tr>
                <tr>
                    <th></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th><input type="text"  style="width: 100%;"></th>
                    <th></th>
                  
                </tr>
            </thead>
            
            <tbody>
                @foreach($families as $family)
                <tr>
                    
                
                  
                    <td>
                          <div class="dropdown dropup d-inline-block mb-1">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              إجراءات
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/families/edit/{{ $family->Family_ID }}"><i class="fas fa-edit"></i> تعديل</a>
                              <a class="dropdown-item" href="/family_members/details/{{ $family->Family_ID }}"><i class="fas fa-edit"></i> أفراد العائلة</a>
                              <a class="dropdown-item" href="/visits/{{ $family->Family_ID }}"><i class="fas fa-edit"></i> الزيارات</a>
                              <a class="dropdown-item" href="/CashAid/details/{{ $family->Family_ID }}"><i class="fas fa-edit"></i> مساعدات مالية</a>
                              <a class="dropdown-item" href="/MaterialAid/details/{{ $family->Family_ID }}"><i class="fas fa-edit"></i> مساعدات عينية</a>
                              <a class="dropdown-item" href="/families/full_details?Family_ID={{ $family->Family_ID }}"><i class="fas fa-edit"></i> تقرير كامل</a>
                            </div>
                          </div>

                    </td>
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
                    <td>{{ count($family->familyMembers) }}</td>
                    <td>{{ count($family->consumingFamilyMembers) }}</td>
                    <td>{{ $family->Summary }}</td>
                    <td>{{ $family->Notes }}</td>
                    <td>{{ $family->File_Editor_Name }}</td>
                    <td>
                        <a href="{{ route('families.Delete', $family->Family_ID) }}"
                        onclick="event.preventDefault(); if(confirm('هل أنت متأكد أنك تريد حذف سجل هذه العائلة?')) document.getElementById('delete-form-{{ $family->Family_ID }}').submit();"
                        style="background:none; border:none; color:red; cursor:pointer;" >
                        Delete
                        </a>
                        <form id="delete-form-{{ $family->Family_ID }}" action="{{ route('families.Delete', $family->Family_ID) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            
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

<script src="{{ asset('js/FamiliesTable.js') }}"></script> 

@endsection