@extends('layouts.app')  

@section('title', 'تعديل المستخدم')  

@if(session('success'))
    <h2 style="text-align: center; color: green; font-weight: bold; margin-top: 25px;">
        {{ session('success') }}
    </h2>
@endif

@section('content')  
    <div style="text-align: right; margin: 0px auto; width: 85%;" dir="rtl">  
        <h1>تعديل المستخدم</h1>  

        <form action="{{ route('users.update', $user->id) }}" method="POST">  
            @csrf  
            @method('PUT')  

            <div style="margin-bottom: 15px;">  
                <label for="name" style="display: block;">الاسم:</label>  
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 8px;">  
            </div>  

            <div style="margin-bottom: 15px;">  
                <label for="user" style="display: block;">اسم المستخدم:</label>  
                <input type="text" name="user" id="user" value="{{ old('user', $user->user) }}" required style="width: 100%; padding: 8px;">  
            </div>  

            <div style="margin-bottom: 15px;">  
                <label for="password" style="display: block;">كلمة المرور (اتركه فارغاً إذا لم تكن هناك تغييرات):</label>  
                <input type="password" name="password" id="password" style="width: 100%; padding: 8px;">  
            </div>  

            <button type="submit" class="btn btn-primary waves-effect waves-light">تحديث المستخدم</button>  
        </form>  
    </div>  
@endsection