@extends('layouts.app')

@section('title', 'إضافة متبرع')
@section('content')

<link rel="stylesheet" href="{{ asset('css/move.css') }}"> 

<div class="container form-container">  
    <h2 class="text-center">تسجيل تبرع</h2>  
    <form id="donation-form" onsubmit="validateForm(event)" method="POST" action="{{ route('Donors.add') }}" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">  
        @csrf  

        <div class="form-group row">  
            <label for="currentDate" class="col-sm-2 col-form-label text-right">التاريخ</label>  
            <div class="col-sm-4">  
                <input type="date" id="currentDate" name="date" class="form-control" value="{{ date('Y-m-d') }}"  required>  
            </div>  
            <label for="currentTime" class="col-sm-2 col-form-label text-right">الوقت</label>  
            <div class="col-sm-4">  
                <input type="time" id="currentTime" name="time" class="form-control" value="{{ date('H:i', strtotime('+3 hours')) }}" required>  
            </div>    
        </div>  
    
        <div class="form-group row">  
            <label for="Name" class="col-sm-2 col-form-label text-right">الاسم</label>  
            <div class="col-sm-10">  
                <input type="text" id="Name" name="Name" class="form-control" placeholder="الاسم" pattern="[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\s]+" title="يرجى إدخال أحرف عربية فقط" autofocus required tabindex="1">  
            </div>  
        </div>  

        <div class="form-group row">  
            <label for="Donation_Type" class="col-sm-2 col-form-label text-right">فئة التبرع</label>  
            <div class="col-sm-10 text-center">  
                <div class="form-check mb-3 d-inline-block radio-margin">   
                    <label class="form-check-label" for="m">عيني</label>
                    <input class="form-check-input" type="radio" name="Donation_Type" id="m" value="عيني" required tabindex="2">    
                </div>  
                
                <div class="form-check mb-3 d-inline-block radio-margin">  
                    <label class="form-check-label" for="k">كفالة</label>
                    <input class="form-check-input" type="radio" name="Donation_Type" id="k" value="كفالة" required tabindex="3">  
                </div>  
                
                <div class="form-check mb-3 d-inline-block radio-margin">  
                    <label class="form-check-label" for="f">نقدي</label> 
                    <input class="form-check-input" type="radio" name="Donation_Type" id="f" value="نقدي" required tabindex="4">  
                </div>  
            </div>  
        </div>  

        <div class="form-group row">  
            <label for="donationType" class="col-sm-2 col-form-label text-right">نوع التبرع</label>  
            <div class="col-sm-10">  
                <select id="donationType" name="DonationDetails" class="form-control" required tabindex="5">  
                    <!-- Options dynamically populated -->  
                </select>  
            </div>  
        </div>  

        {{-- <div class="form-group row">  
            <label for="Amount" class="col-sm-2 col-form-label text-right">المبلغ</label>  
            <div class="col-sm-10">  
                <input type="number" id="Amount" name="Amount" class="form-control" placeholder="المبلغ" value="0" pattern="[0-9]+([,\.][0-9]+)?" title="يرجى إدخال رقم" required>  
            </div>  
        </div>   --}}

        <div class="form-group row">  
            <label for="Amount" class="col-sm-2 col-form-label text-right">المبلغ</label>  
            <div class="col-sm-10">  
                <input type="text" id="Amount" name="Amount" class="form-control" placeholder="المبلغ" value="0"
                oninput="formatNumber(this)" tabindex="6">       
            <!-- حقل مخفي لتخزين القيمة الفعلية المبلغ بدون تنسيق -->
            <input type="hidden" id="RawAmount" name="Amount">  
            </div>  
        </div>
        

        <div class="form-group row">  
            <label for="Description" class="col-sm-2 col-form-label text-right">الوصف</label>  
            <div class="col-sm-10">  
                <input type="text" id="Description" name="Description" class="form-control" placeholder="الوصف" tabindex="7">  
            </div>  
        </div>  

        <div class="form-group row">  
            <label for="Phone" class="col-sm-2 col-form-label text-right">رقم الهاتف</label>  
            <div class="col-sm-10">  
                <input type="tel" id="Phone" name="Phone" class="form-control" placeholder="أرقام 10"  pattern="\d{10}" title="يجب أن يكون رقم الجوال من 10 رقم" tabindex="8" >  
            </div>  
        </div>  

        <div class="d-flex justify-content-between">   
            <button type="submit" class="btn btn-primary" tabindex="9">تسجيل التبرع</button>  
            <button type="reset" class="btn btn-secondary"  tabindex="10">تصحيح</button> 
        </div>  
        
    </form>
</div>

<script src="{{ asset('js/DonorForm.js') }}"></script>

{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumber.js') }}"></script>  



@endsection
