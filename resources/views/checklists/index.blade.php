<!DOCTYPE html>  
<html lang="ar" dir="auto">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Cash Aid List</title>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">   
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">  
</head>  
<body>  

    <div class="form-container">  
        <button onclick="window.location.href='{{ route('home') }}'" class="btn btn-primary" style="color: rgb(22, 158, 90); width: 50%; margin: -10px 0 10px 0; display: block;">  
            <i class="fa fa-home"></i> Back to Home   
        </button>  


        {{-- checks if the $family_id variable is available   --}}
        {{-- @if(isset($id)) --}}
    <button onclick="window.open('{{ route('checklists.create') }}', '_blank')" class="btn btn-primary" style="color: rgb(22, 158, 90); width: 50%; margin: -10px 0 10px 0; display: block;">
            <i class="fa fa-home"></i> Add New Item
        </button>
        {{-- @else
        <p></p>
        @endif         --}}



        {{-- @if(session('success'))  
            <div class="alert alert-success" style="width: 70%; margin: 0px auto; text-align: center;">  
                {{ session('success') }}  
            </div>  
        @endif  

        @if(session('error'))  
            <div class="alert alert-danger" style="width: 70%; margin: 0px auto; text-align: center;">  
                {{ session('error') }}  
            </div>  
        @endif   --}}
    
        <table id="table" class="display" style="margin: 0px auto; width:70%" dir="rtl">  
            <thead>  
                <tr>
                    <th>id</th>    
                    <th>Name</th>    
                    <th>Edit</th>  
                    <th>Delete</th>  
                </tr>  
            </thead>  
            
            <tbody>  
                @foreach($checklists as $checklist)  
                <tr>
                    <td>{{ $checklist->id }}</td>  
                    <td>{{ $checklist->Name }}</td>   
                    
                    <td>  
                        <a href="/checklists/edit/{{ $checklist->id }}" target="_blank"><i class="fas fa-edit"></i> Edit</a>  
                    </td>  
                
                    <td>  
                        <form action="{{ route('checklists.delete', $checklist->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف سجل  {{ $checklist->id }}?');">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Delete</button>  
                        </form>  
                    </td>   
                </tr>  
                @endforeach
</tbody>  
</table>  

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
        
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    
        <script src="{{ asset('js/FamiliesTable.js') }}"></script> 
    
    </div>  

    
</body>  

</html>