@extends('layouts.app')

@section('title', 'إضافة مستخدم')
@section('content')

@if(session('success'))
    <h2 style="text-align: center; color: green; font-weight: bold; margin-top: 25px;">
        {{ session('success') }}
    </h2>
@endif

<form action="{{ route('users.add') }}" method="POST" style="text-align: right; margin: 0px auto; width: 85%;" dir="rtl">

    @csrf
    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block;">الاسم:</label>
        <input type="text" name="name" id="name" required style="width: 85%; padding: 8px;" autofocus>
    </div>
    <div style="margin-bottom: 15px;">
        <label for="user" style="display: block;">اسم المستخدم:</label>
        <input type="text" name="user" id="user" required style="width: 85%; padding: 8px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="password" style="display: block;">كلمة المرور:</label>
        <input type="password" name="password" id="password" required style="width: 85%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="role" style="display: block;">الدور:</label>
        <select name="role" id="role" required style="width: 85%; padding: 8px;">
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary waves-effect waves-light">إضافة مستخدم</button>

</form>

@endsection
