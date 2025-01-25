<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add new Item To Checklist</title>
    <style>  
        .center {  
            text-align: center;  
        }  
    </style>

    <link rel="stylesheet" href="{{ asset('css/CashAid.css') }}">   
</head>


<body>
    <div class="center">  
        <h2>Add new Item To Checklist</h2>  
    </div>  

    <form action="{{ route('checklists.add') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="Name">Checklist Name</label>
            <input type="text" name="Name" id="Name" class="form-control"  required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Checklist</button>

        {{-- <a href="{{ route('checklists.index') }}" class="btn btn-secondary mt-3">Cancel</a> --}}
    </form>
    
</body>
</html>