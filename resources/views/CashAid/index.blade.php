@extends('layouts.app')
{{-- <style>
    table#table th {
        text-align: center ;
    }
</style> --}}
@section('title', 'جميع المساعدات المالية')

@section('content')

<div class= "table-responsive">
    <div class="card-header" style="display: flex; justify-content: center;">
        <h2>المساعدات المالية</h2>  
    </div>
    
    

    <div class="form-container" style="padding: 1%;">  
     

        {{-- checks if the $family_id variable is available   --}}
        @if(isset($family_id))
    <button onclick="window.open('{{ route('CashAid.create',$family_id) }}', '_blank')" class="btn btn-primary" style="color: rgb(3, 16, 9); width: 20%; margin: -10px 0 10px 0; display: block;">
            <i class="fa fa-home"></i> <h5>تقديم مساعدة مالية</h5>         
        </button>
        @else
        <p></p>
        @endif        



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
    
        <table id="table" class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
            <thead>  
                <tr>
                    <th>ID</th>  
                    <th>رقم دفتر العائلة</th>  
                    <th>الاسم</th>
                    <th>التاريخ</th>  
                    <th>المبلغ</th>  
                    <th>ملاحظات</th>  
                    <th>تعديل</th>  
                    <th>حذف</th>  
                </tr>  
                <tr>
                    <th><input type="number" placeholder="ID" style="width: 100%;"></th>   
                    <th><input type="number" placeholder="Family ID" style="width: 100%;"></th>
                    <th><input type="text" placeholder="Applicant Name" style="width: 100%;"></th>
                    <th><input type="date" placeholder="Date" style="width: 100%;"></th>  
                    <th><input type="number" placeholder="Amount" style="width: 100%;"></th>  
                    <th><input type="text" placeholder="Comment" style="width: 100%;"></th>  
                    <th></th>  
                    <th></th>  
                </tr>  
            </thead>  
            
            <tbody>  
                @foreach($cashAids as $cashAid)  
                <tr>
                    <td>{{ $cashAid->ID }}</td>   
                    <td>{{ $cashAid->Family_ID }}</td>  
                    <td>{{ $cashAid->family->Applicant_Name ?? 'N/A' }}</td> 
                    <td>{{ \Carbon\Carbon::parse($cashAid->Date_)->format('Y-m-d') }}</td>  
                    {{-- <td>{{ $cashAid->Amount }}</td>   --}}

                     <!-- إضافة خاصية data-amount لتخزين القيمة الخام من المبلغ -->  
            <td class="amount" data-amount="{{ $cashAid->Amount }}">{{ $cashAid->Amount }}</td>
            
                    <td>{{ $cashAid->Comment }}</td>  
                
        <td>  
            <a href="/CashAid/edit/{{ $cashAid->ID }}" target="_blank"><i class="fas fa-edit" ></i> Edit</a>  
        </td>  


        <td>
            <form action="{{ route('CashAid.delete', $cashAid->ID) }}" method="POST" target="_blank" onsubmit="return confirm('هل أنت متأكد من حذف سجل  {{ $cashAid->ID }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>

            </form>
        </td> 

                </tr>  
                @endforeach

</tbody>  
</table>
</div>  
@endsection

@section('customJs')  

    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    
        <script src="{{ asset('js/FamiliesTable.js') }}"></script> 


{{-- تنسيق قيم المبلغ عند تحميل الصفحة باستخدام JavaScript --}}
{{-- تنسيق القيم الرقمية الخاصة بالمبالغ في خلايا الجدول عند تحميل الصفحة --}}
 <script src="{{ asset('js/formatNumberTable.js') }}"></script>  
    

@endsection