@extends('layouts.app')

@section('title', 'تعديل بيانات فرد')
@section('content')
<div class="polite-rectangle">  
    <h2 class="text-center">تعديل بيانات فرد</h2>  
</div>  
 
<div class="container mt-5">  

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
    
    <form action="{{ route('family_members.update', $familyMember->ID) }}" method="POST" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">  
        @csrf  
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">  
                    <label for="Family_ID">رقم العائلة</label>  
                    <input type="number" name="Family_ID" class="form-control" id="Family_ID" value="{{ $familyMember->Family_ID }}" readonly>  
                </div>  

                <div class="form-group">  
                    <label for="Name">الاسم</label>  
                    <input type="text" name="Name" class="form-control" id="Name" value="{{ $familyMember->Name }}" required maxlength="50" autofocus>  
                </div>  

                <div class="form-group">  
                    <label for="Father_Name">اسم الأب</label>  
                    <input type="text" name="Father_Name" class="form-control" id="Father_Name" value="{{ $familyMember->Father_Name }}" required maxlength="50">  
                </div>  

                <div class="form-group">  
                    <label for="Mother_Name">اسم الأم</label>  
                    <input type="text" name="Mother_Name" class="form-control" id="Mother_Name" value="{{ $familyMember->Mother_Name }}" required maxlength="50">  
                </div>  

                <div class="form-group">  
                    <label for="Date_Of_Birth">تاريخ الميلاد</label>  
                    <input type="date" name="Date_Of_Birth" class="form-control" id="Date_Of_Birth" value="{{ $familyMember->Date_Of_Birth }}" required>  
                </div>  

                <div class="form-group">  
                    <label for="Place_Of_Birth">مكان الميلاد</label>  
                    <input type="text" name="Place_Of_Birth" class="form-control" id="Place_Of_Birth" value="{{ $familyMember->Place_Of_Birth }}" required maxlength="50">  
                </div>  

                <div class="form-group">  
                    <label for="ID_NO">الرقم الوطني</label>  
                    <input type="text" name="ID_NO" class="form-control" id="ID_NO" value="{{ $familyMember->ID_NO }}" pattern="\d{11}" title="يجب أن يكون الرقم الوطني من 11 رقم">  
                </div>  

                <div class="form-group">  
                    <label for="Member_Status">حالة الفرد</label>  
                    <select name="Member_Status" class="form-control" id="Member_Status" required>  
                        @foreach ($member_statuses as $status)  
                            <option value="{{ $status->ID }}" @if($familyMember->Member_Status == $status->ID) selected @endif>{{ $status->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">  
                    <label for="Social_Status">الحالة الاجتماعية</label>  
                    <select name="Social_Status" class="form-control" id="Social_Status" required>  
                        @foreach ($social_statuses as $status)  
                            <option value="{{ $status->ID }}" @if($familyMember->Social_Status == $status->ID) selected @endif>{{ $status->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  

                <div class="form-group">  
                    <label for="Occupation">الوظيفة</label>  
                    <input type="text" name="Occupation" class="form-control" id="Occupation" value="{{ $familyMember->Occupation }}" required maxlength="50">  
                </div>  

                {{-- <div class="form-group">  
                    <label for="Accommodation">نوع السكن</label>  
                    <select name="Accommodation" class="form-control" id="Accommodation" required>  
                        <option value="1" @if($familyMember->Accommodation == 1) selected @endif>ملك</option>  
                        <option value="2" @if($familyMember->Accommodation == 2) selected @endif>إيجار</option>  
                        <option value="3" @if($familyMember->Accommodation == 3) selected @endif>مع العائلة</option>  
                    </select>  
                </div>   --}}

                <div class="form-group">  
                    <label for="Accommodation">إقامة السكن</label>  
                    <select name="Accommodation" class="form-control" id="Accommodation" required>  
                        <option value="مع العائلة" @if($familyMember->Accommodation == 'مع العائلة') selected @endif>مع العائلة</option>  
                        <option value="ملك" @if($familyMember->Accommodation == 'ملك') selected @endif>ملك</option>  
                        <option value="إيجار" @if($familyMember->Accommodation == 'إيجار') selected @endif>إيجار</option>  
                    </select>  
                </div>  

                <div class="form-group">  
                    <label for="Monthly_Income">الدخل الشهري</label>  
                    <input type="number" name="Monthly_Income" class="form-control" id="Monthly_Income" value="{{ $familyMember->Monthly_Income }}" required>  
                </div>  

                <div class="form-group">  
                    <label for="Education_level">المستوى التعليمي</label>  
                    <select name="Education_level" class="form-control" id="Education_level" required>  
                        @foreach ($Education_Level as $level)  
                            <option value="{{ $level->ID }}" @if($familyMember->Education_level == $level->ID) selected @endif>{{ $level->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  

                <div class="form-group">  
                    <label for="Healthy_Level">الحالة الصحية</label>  
                    <select name="Healthy_Level" class="form-control" id="Healthy_Level" required>  
                        @foreach ($healthy_levels as $level)  
                            <option value="{{ $level->ID }}" @if($familyMember->Healthy_Level == $level->ID) selected @endif>{{ $level->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  

                <div class="form-group">  
                    <label for="Type_of_Disease">نوع المرض</label>  
                    <select name="Type_of_Disease" class="form-control" id="Type_of_Disease" required>  
                        @foreach ($disease_types as $disease)  
                            <option value="{{ $disease->ID }}" @if($familyMember->Type_of_Disease == $disease->ID) selected @endif>{{ $disease->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">  
                    <label for="Life_Status">الحالة الحياتية</label>  
                    <select name="Life_Status" class="form-control" id="Life_Status" required>  
                        @foreach ($life_statuses as $life)  
                            <option value="{{ $life->ID }}" @if($familyMember->Life_Status == $life->ID) selected @endif>{{ $life->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  

                <div class="form-group">  
                    <label for="Date_Of_Death">تاريخ الوفاة</label>  
                    <input type="date" name="Date_Of_Death" class="form-control" id="Date_Of_Death" value="{{ $familyMember->Date_Of_Death }}">  
                </div>  

                <div class="form-group">  
                    <label for="Work_Status">حالة العمل</label>  
                    <select name="Work_Status" class="form-control" id="Work_Status" required>  
                        @foreach ($work_statuses as $work)  
                            <option value="{{ $work->ID }}" @if($familyMember->Work_Status == $work->ID) selected @endif>{{ $work->Name }}</option>  
                        @endforeach  
                    </select>  
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">  
                    <label for="Mob_Number">رقم الجوال </label>  
                    <input type="text" name="Mob_Number" class="form-control" id="Mob_Number" value="{{ $familyMember->Mob_Number }}" pattern="\d{10}" title="يجب أن يكون رقم الجوال من 10 رقم">  
                </div>  

                <div class="form-group">  
                    <label for="Home_Address">عنوان السكن</label>  
                    <input type="text" name="Home_Address" class="form-control" id="Home_Address" value="{{ $familyMember->Home_Address }}" maxlength="255">  
                </div>  

                <div class="form-group">  
                    <label for="Work_Address">عنوان العمل</label>  
                    <input type="text" name="Work_Address" class="form-control" id="Work_Address" value="{{ $familyMember->Work_Address }}" maxlength="255">  
                </div>  

                <div class="col-md-6">  
                    <div class="form-group">  
                        <label for="Consumer">مستهلك؟</label>  
                        <input type="checkbox" name="Consumer" class="form-control" id="Consumer" >  
                    </div>  

                <div class="form-group">  
                    <label for="File_Emp_Name">اسم الموظف المسؤول عن الملف</label>  
                    <input type="text" name="File_Emp_Name" class="form-control" id="File_Emp_Name" value="{{ $familyMember->File_Emp_Name }}" maxlength="50">  
                </div>  
            </div>
        </div>

        <button type="submit" class="btn btn-primary">تحديث بيانات الفرد</button>  
    </form>  
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection
