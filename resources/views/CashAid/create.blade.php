@extends('layouts.app')

@section('title', 'إضافة مساعدة مالية')

@section('content')
<h2 style="text-align: center;">إضافة مساعدة مالية</h2>
<link rel="stylesheet" href="{{ asset('css/CashAid.css') }}"> 
<div class="container form-container">  


<form action="{{ route('CashAid.add') }}" method="POST"  style="text-align: right; margin: 0px auto; width:98%" dir="rtl">  
            @csrf  
<div>
            <input type="hidden" value="{{$family_id}}" name="Family_ID" class="form-control" id="Family_ID" required>
</div>

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
<br>   
            <label for="date">التاريخ</label>  
            <input type="date" id="date" name="Date_" value="{{ date('Y-m-d') }}" >   
<br>   
            <label for="amount">المبلغ</label>  
            {{-- <input type="number" id="amount" name="Amount" placeholder="Amount" required>           --}}
            {{-- <input type="number" id="amount" name="Amount" placeholder="Amount" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" autofocus > --}}
            <input type="text" id="amount" name="Amount" placeholder="المبلغ"  
            oninput="formatNumber(this)" required autofocus>       
            <!-- حقل مخفي لتخزين القيمة الفعلية المبلغ بدون تنسيق -->
            <input type="hidden" id="RawAmount" name="Amount">  
             
<br>  
            <label for="comment">ملاحظات</label>  
            <input type="text" id="comment" name="Comment" placeholder="Comment">  
<br>  


        <div class="d-flex justify-content-between">   
            <button type="submit" class="btn btn-primary" style="width: 40%;">تسجيل دعم مالي</button>  
            <button type="reset" class="btn btn-secondary" style="width: 40%;">Reset</button> 
        </div>
       

    </form>  

</div>

{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumber.js') }}"></script>  

@endsection

