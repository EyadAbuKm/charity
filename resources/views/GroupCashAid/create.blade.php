@extends('layouts.app')  

{{-- @section('title', 'دعم نقدي لمجموعة من العائلات') --}}


@section('content')  


<link rel="stylesheet" href="{{ asset('css/move.css') }}"> 

<div class="container">  
    <h2 style="text-align: center;"> دعم نقدي لمجموعة من العائلات</h2>  


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


    <form action="{{ route('GroupCashAid.add') }}" method="POST" style="text-align: right; margin: 0px auto; width:98%" dir="rtl">  
        @csrf  

        
        <label for="Family_ID">أرقام دفاتر العائلات (يمكنك نسخ ولصقها هنا، كل رقم في سطر جديد)</label>  
        <textarea name="Family_ID" id="Family_ID" rows="5" required class="form-control" tabindex="1"></textarea>  
        <br>
        
        
        <br>  

        <label for="date">التاريخ</label>  
        <input type="date" name="Date_" value="{{ date('Y-m-d') }}" required class="form-control" style="text-align: right;" tabindex="2">  
        <br>  



        <div class="form-group row">  
            <label for="Amount" class="col-sm-2 col-form-label text-right">مبلغ الدعم النقدي</label>  
            <div class="col-sm-10">  
                <input type="text" id="Amount" name="Amount" class="form-control"  value="0"
                oninput="formatNumber(this)"  tabindex="3">    
            <!-- حقل مخفي لتخزين القيمة الفعلية المبلغ بدون تنسيق -->
            <input type="hidden" id="RawAmount" name="Amount">  
            </div>  
        </div>

        <label for="Name">اسم المجموعة</label>  
        <input type="text" name="Name" placeholder="اسم المجموعة" class="form-control" tabindex="4"> 

        {{-- <label for="Status">الحالة</label>   --}}
        <select name="Status" id="Status" required class="form-control" style="display: none;">  
            <option value="1" selected>مُعلّق</option>   
        </select>

        
        <label for="comment">ملاحظات</label>  
        <input type="text" name="Comment" placeholder="ملاحظات" class="form-control" tabindex="5">  
        <br>  

        <div class="d-flex justify-content-between">   
            <button type="submit" class="btn btn-primary" style="width: 30%;" tabindex="6">إرسال</button>  
            <button type="reset" class="btn btn-secondary" style="width: 30%;" tabindex="7">إعادة تعيين</button>   
        </div>  
    </form>  
</div>  

@endsection



{{-- لإظهار الفاصلة العائمة  --}}
<script src="{{ asset('js/formatNumber.js') }}"></script>  


<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>دعم نقدي لمجموعة من العائلات</title>  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>  
<body>  

<div class="container mt-5">  
    <h2>Main View</h2>  
   
</div>

</body>  
</html>
