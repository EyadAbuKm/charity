<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update Item In Checklist</title>
    <style>  
        .center {  
            text-align: center;  
        }  
    </style>

    <link rel="stylesheet" href="{{ asset('css/CashAid.css') }}">   

</head>

<body>
    <div class="center">  
        <h2>update Item In Checklist</h2>  
    </div>  

    
    <form action="{{ route('checklists.update', $checkList->id) }}" method="POST">  
        @csrf  
    
        <div class="form-group">  
            <label for="Name">Checklist Name</label>  
            <input type="text" name="Name" id="Name" value="{{ old('Name', $checkList->Name) }}" required>  
        </div>  
    
        <button type="submit" class="btn btn-primary mt-3">Update Checklist</button>  
        {{-- <a href="{{ route('checklists.index') }}">Back to list</a> --}}  
    </form>
    
</body>
</html>