@extends('layouts.app')  

@section('title', 'قائمة المستخدمين') <!-- Title in Arabic, translates to "Users List" -->  

@section('content')  
    <div style="text-align: right; margin: 0px auto; width: 85%;" dir="rtl">  
        <h2>قائمة المستخدمين</h2> <!-- Header in Arabic -->  
        
        @if(session('success'))  
            <div style="color: green; margin-bottom: 15px;">  
                {{ session('success') }}  
            </div>  
        @endif  
    
        <table class="table" style="text-align: center; margin: 0px auto; width:98%" dir="rtl">  
            <thead>  
                <tr>  
                    <th>الاسم</th> 
                    <th>اسم المستخدم</th> 
                    <th>الإجراءات</th>   
                </tr>  
            </thead>  
            <tbody>  
                @foreach($users as $user)  
                    <tr>  
                        <td>{{ $user->name }}</td>  
                        <td>{{ $user->user }}</td>  
                        <td>  
                            <!-- Example action buttons (edit/delete) could be added here -->  
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" style="margin: 5px;">تعديل</a> <!-- Edit in Arabic -->  
                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger" style="margin: 5px;">حذف</button> <!-- Delete in Arabic -->  
                            </form>   --}}
                        </td>  
                    </tr>  
                @endforeach  
            </tbody>  
        </table>  

        <a href="{{ route('users.create') }}" class="btn btn-primary" style="margin-top: 20px;">إضافة مستخدم جديد</a> <!-- Link to create new user -->  
    </div>  
@endsection