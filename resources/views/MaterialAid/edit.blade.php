@extends('layouts.app')

@section('title', 'تعديل مساعدة عينية')

@section('content')
<h2 style="text-align: center;">تعديل مساعدة عينية</h2>
<link rel="stylesheet" href="{{ asset('css/CashAid.css') }}">

<div class="container form-container mt-4" style="max-width: 900px;">  
    <form action="{{ route('MaterialAid.update', $materialAid->ID) }}" method="POST" style="text-align: right;" dir="rtl">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="Family_ID" class="form-label">رقم دفتر العائلة</label>
                <input type="number" id="Family_ID" name="Family_ID" value="{{ $materialAid->Family_ID }}" class="form-control text-center" readonly>
            </div>
            <div class="col-md-6">
                <label for="applicant_name" class="form-label">اسم مقدم الطلب</label>
                <input type="text" id="applicant_name" name="Applicant_Name" value="{{ $family->Applicant_Name }}" class="form-control text-center" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">تاريخ</label>
            <input type="date" id="date" name="Date" value="{{ date('Y-m-d') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Type_Of_Aid" class="form-label">نوع المساعدة</label>
            <select name="Type_Of_Aid" id="Type_Of_Aid" class="form-select" required>
                <option value="" disabled selected>اختر نوع المساعدة</option>
                @foreach ($TypeOfMaterialAids as $TypeOfMaterialAid)
                    <option value="{{ $TypeOfMaterialAid->ID }}">{{ $TypeOfMaterialAid->Name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">الكمية</label>
            <input type="number" id="amount" name="Amount" value="{{ $materialAid->Amount }}" class="form-control" >
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">التعليق</label>
            <input type="text" id="comment" name="Comment" value="{{ $materialAid->Comment }}" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" style="width: 35%;">تعديل</button>
            <button type="reset" class="btn btn-secondary" style="width: 35%;">إعادة تعيين</button>
        </div>
    </form>
</div>

@endsection