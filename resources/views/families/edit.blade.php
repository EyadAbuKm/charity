@extends('layouts.app')


<style>
    .form-group {
        text-align: right;
    }
</style>

@section('title', 'تعديل بيانات أسرة')
@section('content')

<div class="polite-rectangle">  
    <h2 class="text-center">تعديل بيانات أسرة</h2>  
</div>  

{{-- Display the error message if it exists --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Display the success message if it exists --}}
@if (session('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('success') }}
    </div>
@endif



<style>
    .form-container {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two equal columns */
        gap: 20px; /* Space between the form fields */
        width: 85%;
        margin: 0 auto;
        text-align: right;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .form-group i {
        position: absolute;
        right: 10px;
        top: 35px;
    }

    .form-group input, 
    .form-group select {
        padding: 10px;
        padding-right: 30px; /* To account for the icon */
        font-size: 1rem;
    }

    .form-group label {
        margin-bottom: 5px;
    }

    .form-container .full-width {
        grid-column: span 2; /* Make fields span across both columns */
    }

    .btn-container {
        grid-column: span 2; /* Center the button by spanning both columns */
        text-align: right;
    }
</style>



<form action="{{ route('families.update', $family->Family_ID) }}" method="POST" class="form-container" dir="rtl" onsubmit="return FormValidationNull()">
    @csrf
    <div class="form-group">
        <i class="fa fa-users prefix"></i>
        <label for="Family_ID">رقم دفتر العائلة</label>
        <input type="number" name="Family_ID" id="Family_ID" value="{{ $family->Family_ID }}" required>
    </div>
    
    <div class="form-group">
        <i class="fa fa-map-marker prefix"></i>
        <label for="Governorate">المحافظة</label>
        <select name="Governorate" id="Governorate" required>
            <option value="" disabled selected>اختر المحافظة</option>
            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}" @if($governorate->id == $family->Governorate) selected @endif>
                    {{ $governorate->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <i class="fa fa-file prefix"></i>
        <label for="FIle_No">رقم الملف</label>
        <input type="number" name="FIle_No" id="FIle_No" value="{{ $family->FIle_No }}" required>
    </div>

    <div class="form-group">
        <i class="fa fa-calendar prefix"></i>
        <label for="Application_Date">تاريخ تقديم الطلب</label>
        <input type="date" name="Application_Date" id="Application_Date" value="{{ $family->Application_Date }}" required>
    </div>

    <div class="form-group">
        <i class="fa fa-user prefix"></i>
        <label for="Applicant_Name">مُقدّم الطلب</label>
        <input type="text" name="Applicant_Name" id="Applicant_Name" value="{{ $family->Applicant_Name }}" required>
    </div>

    <div class="form-group">
        <i class="fa fa-phone prefix"></i>
        <label for="Tel_Number">هاتف</label>
        <input type="text" name="Tel_Number" id="Tel_Number" value="{{ $family->Tel_Number }}" required>
    </div>

    <div class="form-group">
        <i class="fa fa-mobile prefix"></i>
        <label for="Mob_Number">رقم الجوال</label>
        <input type="text" name="Mob_Number" id="Mob_Number" value="{{ $family->Mob_Number }}" required pattern="\d{10}" title="يجب أن يكون رقم الجوال من 10 أرقام">
    </div>

    <div class="form-group">
        <i class="fa fa-home prefix"></i>
        <label for="Daria_Address">العنوان في داريا</label>
        <input type="text" name="Daria_Address" id="Daria_Address" value="{{ $family->Daria_Address }}">
    </div>

    <div class="form-group">
        <i class="fa fa-home prefix"></i>
        <label for="Current_Address">العنوان الحالي</label>
        <input type="text" name="Current_Address" id="Current_Address" value="{{ $family->Current_Address }}">
    </div>

    <div class="form-group">
        <i class="fa fa-map-marker prefix"></i>
        <label for="home_condition">حالة السكن</label>
        <select name="Home_Condition" id="home_condition" required>
            <option value="" disabled selected>اختر حالة السكن</option>
            @foreach($homeStatuses as $homeStatus)
                <option value="{{ $homeStatus->ID }}" @if($homeStatus->ID == $family->Home_Condition) selected @endif>
                    {{ $homeStatus->status }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="form-group col-md-6">  
        <label for="Family_Rate" class="col-form-label text-right">تصنيف الأسرة</label>  
        <select name="Family_Rating" id="Family_Rate" class="form-control" required>  
            <option value="" disabled selected>تصنيف الأسرة</option>  
            @foreach ($familyRates as $familyRate)  
                <option value="{{ $familyRate->ID }}" @if(isset($family) && $family->Family_Rating == $familyRate->ID) selected @endif>  
                    {{ $familyRate->Rate }}  
                </option>  
            @endforeach  
        </select>  
    </div>

    <div class="form-group">
        <i class="fa fa-money-bill prefix"></i>
        <label for="Monthly_Rent">الآجار الشهري</label>
        <input type="number" name="Monthly_Rent" id="Monthly_Rent" value="{{ $family->Monthly_Rent }}">
    </div>

    <div class="form-group full-width">
        <i class="fa fa-home prefix"></i>
        <label for="Another_Resources">موارد إضافية</label>
        <input type="text" name="Another_Resources" id="Another_Resources" value="{{ $family->Another_Resources }}">
    </div>

    <div class="form-group full-width">
        <i class="fa fa-home prefix"></i>
        <label for="Summary">الملخص</label>
        {{-- <input type="text" name="Summary" id="Summary" value="{{ $family->Summary }}"> --}}
        <textarea name="Summary" id="Summary" class="form-control" rows="5" cols="30">{{ $family->Summary }}</textarea>
    </div>

    <div class="form-group full-width">
        <i class="fa fa-home prefix"></i>
        <label for="Notes">ملاحظات</label>
        <input type="text" name="Notes" id="Notes" value="{{ $family->Notes }}">
    </div>

    <div class="form-group full-width">
        <i class="fa fa-home prefix"></i>
        <label for="File_Editor_Name">موظف الجمعية</label>
        <input type="text" name="File_Editor_Name" id="File_Editor_Name" value="{{ $family->File_Editor_Name }}">
    </div>

    <div class="btn-container">
        <button type="submit" class="btn btn-primary" style="width: 20%;">تعديل</button>
    </div>
</form>

<script src="{{ asset('js/DuplicateFamilyID.js') }}"></script>

{{-- <script src="{{ asset('js/FormValidationNull.js') }}"></script> --}}

@endsection 
