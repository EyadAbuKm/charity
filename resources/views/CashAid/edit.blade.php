@extends('layouts.app')

@section('title', 'تعديل مساعدة مالية')

@section('content')
<h2 style="text-align: center;">تعديل مساعدة مالية</h2>
<link rel="stylesheet" href="{{ asset('css/CashAid.css') }}"> 

<div class="container form-container">  

        <form action="{{ route('CashAid.update', $cashAids->ID) }}" method="POST" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">  
            @csrf  

            <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                <div style="width: 48%;">
                    <label for="family_id">رقم دفتر العائلة</label>  
                    <input type="number" id="Family_ID" name="Family_ID" value="{{ $cashAids->Family_ID }}" style="text-align: center;" class="form-control" readonly>  
                </div>
                <div style="width: 48%;">
                    <label for="applicant_name">اسم مقدم الطلب</label>
                    <input type="text" id="applicant_name" name="Applicant_Name" value="{{ $family->Applicant_Name }}" style="text-align: center;" class="form-control" readonly>
                </div>
            </div>
            
<br>   
            <label for="date">تاريخ التعديل</label>  
            <input type="date" id="date" name="Date_" value="{{ date('Y-m-d') }}">   
<br>   
            <label for="amount">المبلغ</label>  
            <input type="number" id="amount" name="Amount" value="{{ $cashAids->Amount }}" required autofocus>  
<br>  
            <label for="comment">ملاحظات</label>  
            <input type="text" id="comment" name="Comment" value="{{ $cashAids->Comment }}"  >  
<br>  
<div class="d-flex justify-content-between">   
    <button type="submit" class="btn btn-primary" style="width: 40%;">تعديل</button>  
    <button type="reset" class="btn btn-secondary" style="width: 40%;">إعادة تعيين</button> 
</div>
     
        </form>  

    </div>

    @endsection