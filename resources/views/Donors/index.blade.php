@extends('layouts.app')  

@section('title', 'التبرعات')  

@section('content')  


@if(session('success'))  
<div class="alert alert-success" style="width: 40%; margin: 0px auto; text-align: center;">  
    {{ session('success') }}  
</div>  
@endif  

@if(session('error'))  
<div class="alert alert-danger" style="width: 40%; margin: 0px auto; text-align: center;">  
    {{ session('error') }}  
</div>  
@endif  

<div class="card card-default">  
    <div class="card-header" style="display: flex; justify-content: center;">  
        <h2>التبرعات</h2>  
    </div>  

    <div class="card-body" style="overflow-x: scroll">  
        <table id="table" class="display" style="text-align: center; margin: 0px auto; width:100%" dir="rtl">  
            <thead>  
                <tr>  
                    <th>التاريخ</th>  
                    <th>الوقت</th>  
                    <th>الاسم</th>  
                    <th>فئة التبرع</th>  
                    <th>نوع التبرع</th>  
                    <th>المبلغ</th>  
                    <th>ملاحظات</th>  
                    <th>هاتف</th>  
                    <th>تحديث</th>  
                    <th>حذف</th>  
                </tr>  
                <tr>  
                    <th></th>  
                    <th></th>  
                    <th><input type="text" placeholder="الاسم" style="width: 100%;"></th>  
                    <th><input type="text" placeholder="النوع" style="width: 100%;"></th>  
                    <th><input type="text" placeholder="تفاصيل" style="width: 100%;"></th>  
                    <th><input type="number" placeholder="المبلغ" style="width: 100%;"></th>  
                    <th><input type="text" placeholder="وصف" style="width: 100%;"></th>  
                    <th><input type="text" placeholder="الهاتف" style="width: 100%;"></th>  
                    <th></th>  
                    <th></th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach($donors as $donor)  
                <tr>  
                    <td>{{ $donor->date }}</td>  
                    <td>{{ $donor->time }}</td>  
                    <td>{{ $donor->Name }}</td>  
                    <td>{{ $donor->Donation_Type }}</td>  
                    <td>{{ $donor->DonationDetails }}</td>  
                    {{-- <td>{{ $donor->Amount }}</td>   --}}

             <!-- إضافة خاصية data-amount لتخزين القيمة الخام من المبلغ -->  
            <td class="amount" data-amount="{{ $donor->Amount }}">{{ $donor->Amount }}</td> 
                
                    <td>{{ $donor->Description }}</td>  
                    <td>{{ $donor->Phone }}</td>  
                    <td>  
                        <a href="/Donors/edit/{{ $donor->id }}" target="_blank"><i class="fas fa-edit"></i> تعديل</a>  
                    </td>  
                    <td>  
                        <form action="{{ route('Donor.Delete', $donor->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف سجل  {{ $donor->Name }}?');">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit" style="background:none; border:none; color:rgb(134, 63, 63); cursor:pointer;">حذف</button>  
                        </form>  
                    </td>  
                </tr>  
                @endforeach  
            </tbody>  
        </table>  
    </div>  
</div>  

@endsection  

@section('customJs')  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">   
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">  

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>  

   
    <script src="{{ asset('js/FamiliesTable.js') }}"></script>  




{{-- تنسيق قيم المبلغ عند تحميل الصفحة باستخدام JavaScript --}}
{{-- تنسيق القيم الرقمية الخاصة بالمبالغ في خلايا الجدول عند تحميل الصفحة --}}
 <script src="{{ asset('js/formatNumberTable.js') }}"></script>  
  
      
@endsection