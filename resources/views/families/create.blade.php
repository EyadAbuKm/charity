@extends('layouts.app')

    <style>
    .form-group{
        text-align: right;
    }
    </style>
@section('title', 'إضافة أسرة')
@section('content')

<div class="polite-rectangle">  
    <h2 class="text-center">إضافة عائلة</h2>  
</div>  


{{-- Display success message --}}
@if (session('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('success') }}
    </div>
@endif

{{-- Display error messages --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<link rel="stylesheet" href="{{ asset('css/move.css') }}"> 

<form action="{{ route('families.add') }}" method="POST" style="text-align: right; margin: 0px auto; width:85%" dir="rtl">  
    @csrf     

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Family_ID" class="col-form-label text-right">رقم دفتر العائلة</label>  
            <input type="number" class="form-control" name="Family_ID" id="Family_ID" required autofocus>  
            @if ($errors->has('Family_ID'))  
                <span class="error-message text-danger">{{ $errors->first('Family_ID') }}</span>  
            @endif  
        </div>  

        <div class="form-group col-md-6">  
            <label for="Governorate" class="col-form-label text-right">المحافظة</label>  
            <select name="Governorate" id="Governorate" class="form-control" required>  
                <option value="" disabled selected>اختر المحافظة</option>  
                @foreach ($governorates as $governorate)  
                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>  
                @endforeach  
            </select>  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="FIle_No" class="col-form-label text-right">رقم الملف</label>  
            <input type="number" name="FIle_No" id="FIle_No" class="form-control" required>  
        </div>  

        <div class="form-group col-md-6">  
            <label for="Application_Date" class="col-form-label text-right">تاريخ التقديم</label>  
            <input type="date" name="Application_Date" id="Application_Date" value="{{ date('Y-m-d') }}" class="form-control" required>  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Applicant_Name" class="col-form-label text-right">اسم المتقدم</label>  
            <input type="text" name="Applicant_Name" id="Applicant_Name" class="form-control" required>  
        </div>  

        <div class="form-group col-md-6">  
            <label for="Tel_Number" class="col-form-label text-right">رقم الهاتف</label>  
            <input type="text" name="Tel_Number" id="Tel_Number" class="form-control" required>  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Mob_Number" class="col-form-label text-right">رقم الجوال</label>  
            <input type="text" name="Mob_Number" id="Mob_Number" class="form-control" required pattern="\d{10}" title="يجب أن يكون رقم الجوال من 10 أرقام">  
        </div>  

        <div class="form-group col-md-6">  
            <label for="Daria_Address" class="col-form-label text-right">عنوان داريا</label>  
            <input type="text" name="Daria_Address" id="Daria_Address" class="form-control">  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Current_Address" class="col-form-label text-right">العنوان الحالي</label>  
            <input type="text" name="Current_Address" id="Current_Address" class="form-control">  
        </div>  

        <div class="form-group col-md-6">  
            <label for="home_condition" class="col-form-label text-right">حالة المنزل</label>  
            <select name="Home_Condition" id="home_condition" class="form-control" required>  
                <option value="" disabled selected>حالة المنزل</option>  
                @foreach($homeStatuses as $homeStatus)  
                    <option value="{{ $homeStatus->ID }}">{{ $homeStatus->status }}</option>  
                @endforeach  
            </select>  
        </div>  


    </div>  

    <div class="form-group col-md-6">
        <label for="Family_Rate" class="col-form-label text-right">تصنيف الأسرة</label>
        <select name="Family_Rate" id="Family_Rate" class="form-control">
            <option value="" disabled selected>تصنيف الأسرة</option>
            @foreach ($familyRates as $familyRate)
                <option value="{{ $familyRate->ID }}">{{ $familyRate->Rate }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Monthly_Rent" class="col-form-label text-right">الإيجار الشهري</label>  
            <input type="number" name="Monthly_Rent" id="Monthly_Rent" class="form-control">  
        </div>  

        <div class="form-group col-md-6">  
            <label for="Another_Resources" class="col-form-label text-right">مصادر أخرى</label>  
            <input type="text" name="Another_Resources" id="Another_Resources" class="form-control">  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="Summary" class="col-form-label text-right">ملخص</label>  
            {{-- <input type="text" name="Summary" id="Summary" class="form-control">   --}}
            <textarea name="Summary" id="Summary" class="form-control"></textarea> 
        </div>  

        <div class="form-group col-md-6">  
            <label for="Notes" class="col-form-label text-right">ملاحظات</label>  
            <input type="text" name="Notes" id="Notes" class="form-control">  
        </div>  
    </div>  

    <div class="form-row mb-6">  
        <div class="form-group col-md-6">  
            <label for="File_Editor_Name" class="col-form-label text-right">اسم محرر الملف</label>  
            <input type="text" name="File_Editor_Name" id="File_Editor_Name" class="form-control">  
        </div>  
    </div>  

    <button type="submit" class="btn btn-primary waves-effect waves-light">إضافة عائلة</button>  
    <button type="reset" class="btn btn-secondary">Reset</button>
</form>
 
    
     {{-- Check Duplicate Family_ID --}}

     <script src="{{ asset('js/FamiliesTable.js') }}"></script> 
 
     <script src="{{asset('js/DuplicateFamilyID.js') }}"></script>
    
    @endsection