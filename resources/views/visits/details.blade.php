@extends('layouts.app')

@section('title', 'تفاصيل زيارات عائلة')
@section('content')

    <h3 style="text-align: center;">زيارة لعائلة  : {{ $visit->family->Applicant_Name }} ...  بتاريخ:  {{ $visit->Date }}</h3>  
    <table class="table"  style="text-align: center; margin: 0px auto; width:98%" dir="rtl"> 
        <thead>  
            <tr>  
                <th>ID</th>  
                <th>الاسم</th>  
                <th>الحالة</th>  
                <th>ملاحظات</th>  
            </tr>  
        </thead>  
        <tbody>  
            @forelse($visit->visitsChecklists as $checklistObj)  
                <tr>  
                    <td>{{ $checklistObj->id }}</td>  
                    <td>{{ $checklistObj->checkList->Name }}</td>  
                    <td>{{ $checklistObj->Status }}</td>  
                    <td>{{ $checklistObj->Comments }}</td>  
                    <td>  
                     
                    </td>  
                </tr>  
            @empty  
                <tr>  
                    <td colspan="5" class="text-center">No visits found for this Family ID.</td>  
                </tr>  
            @endforelse  
        </tbody>  
    </table>  
</div>  
@endsection