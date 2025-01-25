@extends('layouts.app')

@section('title', 'الزيارات')
@section('content')
<div class="container">  

    <table class="display table-responsive" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
        <thead>  
            <tr>  
                <th>ID</th>  
                <th>Date</th>  
                <th>Family</th>  
                <th>Comment</th>  
                <th>Visiting Officer</th>  
                <th>Actions</th>  
            </tr>  
            <tr>  
                <th><input type="text" placeholder="Family ID" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Date" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Family" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Comments" style="width: 100%;"></th>  
                <th><input type="text" placeholder="Officer" style="width: 100%;"></th>  
                <th></th>  
            </tr>  
        </thead>  
        <tbody>  
            @forelse($visits as $visit)  
                <tr>  
                    <td>{{ $visit->id }}</td>  
                    <td>{{ $visit->Date }}</td>  
                    <td>{{ $visit->family->Applicant_Name }}</td>  
                    <td>{{ $visit->Comment }}</td>  
                    <td>{{ $visit->Visiting_Officer }}</td>  
                    <td>  
                        <!-- Add action buttons here, e.g., Edit or Delete -->  
                        <a href="{{ route('visits.details', $visit->id) }}" class="btn btn-warning btn-sm">Details</a>  
                        <form action="{{ route('visits.index', $visit->id) }}" method="POST" style="display:inline;">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>  
                        </form>  
                    </td>  
                </tr>  
            @empty  
                <tr>  
                    <td colspan="5" class="text-center">No visits found for this Family ID.</td>  
                </tr>  
            @endforelse  
        </tbody>  
    </table>  
    <a href="{{ route('visits.create') }}" class="btn btn-primary">Add Visit</a>  
</div>  
@endsection
