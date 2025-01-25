@extends('layouts.app')

@section('title', 'تقرير زيارات عائلة')
@section('content')

<div class="container">  
    <h2 style="text-align: center;">تقرير زيارات العائلة رقم : {{ $familyId }}</h2>  
    <a href="{{ route('visits.create') }}" class="btn btn-primary">Add Visit</a>  
    <table class="table"  style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
        <thead>  
            <tr>  
                <th>ID</th>  
                <th>التاريخ</th>  
                <th>ملاحظات</th>  
                <th>موظف الجمعية الزائر</th>  
                <th>Actions</th>  
            </tr>  
        </thead>  
        <tbody>  
            @forelse($visits as $visit)  
                <tr>  
                    <td>{{ $visit->id }}</td>  
                    <td>{{ $visit->Date }}</td>  
                    <td>{{ $visit->Comment }}</td>  
                    <td>{{ $visit->Visiting_Officer }}</td>  
                    <td>  
                        <!-- Add action buttons here, e.g., Edit or Delete -->  
                        <a href="{{ route('visits.details', $visit->id) }}" class="btn btn-warning btn-sm">Details</a>  

                        {{-- <form action="{{ route('visits.index', $visit->id) }}" method="POST" style="display:inline;">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>  
                        </form>   --}}
                    </td>  
                </tr>  
            @empty  
                <tr>  
                    <td colspan="5" class="text-center">لا يوجد زيارات لهذه العائلة</td>  
                </tr>  
            @endforelse  
        </tbody>  
    </table>  
   
</div>  
@endsection
