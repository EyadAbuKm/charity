@extends('layouts.app')

@section('title', 'إضافة مساعدة عيتية')

@section('content')
<h2 style="text-align: center;">إضافة مساعدة عينية</h2>
<link rel="stylesheet" href="{{ asset('css/CashAid.css') }}"> 
<div class="container form-container">  


    <form action="{{ route('MaterialAid.add') }}" method="POST" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">
        @csrf
        <input type="hidden" value="{{ $family_id }}" name="Family_ID" class="form-control" id="Family_ID" required>
    
        <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
            <div style="width: 48%;">
                <label for="family_id">رقم دفتر العائلة</label>              
                <input type="number" id="Family_ID" name="Family_ID" value="{{ $family_id }}" style="text-align: center;" class="form-control" readonly>
            </div>
            <div style="width: 48%;">
                <label for="applicant_name">اسم مقدم الطلب</label>
                <input type="text" id="applicant_name" name="Applicant_Name" value="{{ $family->Applicant_Name }}" style="text-align: center;" class="form-control" readonly>
            </div>
        </div>    
    
        <label for="date">التاريخ</label>
        <input type="date" name="Date" value="{{ date('Y-m-d') }}" required class="form-control">
        <br>
    
        <label for="Type_Of_Aid">نوع المساعدة</label> 
        <select name="Type_Of_Aid" id="Type_Of_Aid" required class="form-control">  
            <option value="" disabled selected>Type Of Aid</option>  
            @foreach ($TypeOfMaterialAids as $TypeOfMaterialAid)  
                <option value="{{ $TypeOfMaterialAid->ID }}">{{ $TypeOfMaterialAid->Name }}</option>  
            @endforeach  
        </select>  
        <br>
    
        <label for="amount">القيمة المالية</label>
        <input type="number" name="Amount" placeholder="َالقيمة المالية" class="form-control">
        <br>
    
        <div>
            <input type="text" id="status" name="Status" value="3"
                style="display:none;">
        </div>

        <label for="comment">ملاحظات</label>
        <input type="text" name="Comment" placeholder="Comment" class="form-control">
        <br>
    
        <div class="d-flex justify-content-between">   
            <button type="submit" class="btn btn-primary" style="width: 40%;">إرسال</button>  
            <button type="reset" class="btn btn-secondary" style="width: 40%;">إعادة تعيين</button> 
        </div>
      
    </form>
    

</div>

@endsection