@extends('layouts.app')

@section('title', 'إضافة فرد إلى أسرة')
@section('content')
    <div class="polite-rectangle">
        <h2 class="text-center">إضافة فرد إلى أسرة</h2>
    </div>


    @if (session('success'))
        <div class="alert alert-success" style="text-align: center;">
            {{ session('success') }}
        </div>
    @endif

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

    <form action="{{ route('family_members.add') }}" method="POST" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">
        @csrf
    
        <input type="hidden" value="{{ $family_id }}" name="Family_ID" class="form-control" id="Family_ID" required>
    
        <!-- Display Applicant Name instead of Father_Name input -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="FamilyID">رقم دفتر العائلة</label>
                <input type="number" name="FamilyID" class="form-control" value="{{ $family_id }}" readonly>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Applicant_Name">اسم مقدم الطلب</label>
                <input type="text" name="Applicant_Name" class="form-control" value="{{ $applicant_name }}" readonly>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Name">الاسم</label>
                <input type="text" name="Name" class="form-control" id="Name" required maxlength="50" autofocus>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Father_Name">اسم الأب</label>
                <input type="text" name="Father_Name" class="form-control" id="Father_Name">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Mother_Name">اسم الأم</label>
                <input type="text" name="Mother_Name" class="form-control" id="Mother_Name" required maxlength="50">
            </div>
    
            <div class="form-group col-md-6">
                <label for="Date_Of_Birth">تاريخ الميلاد</label>
                <input type="date" name="Date_Of_Birth" class="form-control" id="Date_Of_Birth" required>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Place_Of_Birth">مكان الميلاد</label>
                <input type="text" name="Place_Of_Birth" class="form-control" id="Place_Of_Birth" required maxlength="50">
            </div>
    
            <div class="form-group col-md-6">
                <label for="ID_NO">الرقم الوطني</label>
                <input type="text" name="ID_NO" class="form-control" id="ID_NO" pattern="\d{11}" title="يجب أن يكون الرقم الوطني من 11 رقم">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Member_Status">حالة الفرد</label>
                <select name="Member_Status" class="form-control" id="Member_Status" required>
                    @foreach ($member_statuses as $status)
                        <option value="{{ $status->ID }}">{{ $status->Name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Social_Status">الحالة الاجتماعية</label>
                <select name="Social_Status" class="form-control" id="Social_Status" required>
                    @foreach ($social_statuses as $status)
                        <option value="{{ $status->ID }}">{{ $status->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Occupation">المهنة</label>
                <input type="text" name="Occupation" class="form-control" id="Occupation" required maxlength="50">
            </div>
    
            <div class="form-group col-md-6">
                <label for="Accommodation">إقامة السكن</label>
                <select name="Accommodation" class="form-control" id="Accommodation" required>
                    <option value="مع العائلة">مع العائلة</option>
                    <option value="ملك">ملك</option>
                    <option value="إيجار">إيجار</option>
                </select>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Monthly_Income">الدخل الشهري</label>
                <input type="number" name="Monthly_Income" class="form-control" id="Monthly_Income">
            </div>
    
            <div class="form-group col-md-6">
                <label for="Education_level">المستوى التعليمي</label>
                <select name="Education_level" class="form-control" id="Education_level" required>
                    @foreach ($Education_Level as $level)
                        <option value="{{ $level->ID }}">{{ $level->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Healthy_Level">الحالة الصحية</label>
                <select name="Healthy_Level" class="form-control" id="Healthy_Level" required>
                    @foreach ($healthy_levels as $level)
                        <option value="{{ $level->ID }}">{{ $level->Name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Type_of_Disease">نوع المرض</label>
                <select name="Type_of_Disease" class="form-control" id="Type_of_Disease">
                    @foreach ($disease_types as $disease)
                        <option value="{{ $disease->ID }}">{{ $disease->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Life_Status">الحالة الحياتية</label>
                <select name="Life_Status" class="form-control" id="Life_Status" required>
                    @foreach ($life_statuses as $life)
                        <option value="{{ $life->ID }}">{{ $life->Name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Date_Of_Death">تاريخ الوفاة</label>
                <input type="date" name="Date_Of_Death" class="form-control" id="Date_Of_Death">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Work_Status">حالة العمل</label>
                <select name="Work_Status" class="form-control" id="Work_Status" required>
                    @foreach ($work_statuses as $work)
                        <option value="{{ $work->ID }}">{{ $work->Name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-6">
                <label for="Mob_Number">رقم الجوال</label>
                <input type="text" name="Mob_Number" class="form-control" id="Mob_Number" pattern="\d{10}" title="يجب أن يكون رقم الجوال من 10 رقم">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Home_Address">عنوان السكن</label>
                <input type="text" name="Home_Address" class="form-control" id="Home_Address" maxlength="255">
            </div>
    
            <div class="form-group col-md-6">
                <label for="Work_Address">عنوان العمل</label>
                <input type="text" name="Work_Address" class="form-control" id="Work_Address" maxlength="255">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Consumer">مستهلك؟</label>
                <input type="checkbox" name="Consumer" id="Consumer" value="1" 
                style="width: 20px; height: 20px; transform: scale(1.5); cursor: pointer; margin-right: 10px;">
            </div>
    
            <div class="form-group col-md-6">
                <label for="File_Emp_Name">اسم الموظف المسؤول عن الملف</label>
                <input type="text" name="File_Emp_Name" id="File_Emp_Name" maxlength="50">
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">إضافة فرد إلى الأسرة</button>
    </form>
    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script src="{{asset('js/FamilyMemberAjax.js') }}"></script> --}}

@endsection
