<?php  

namespace App\Http\Controllers;  

use App\Models\MaterialAidGroupName;  
use Illuminate\Http\Request;  

class GroupMaterialAidNameController extends Controller  
{  
    // Show the form for creating a new Material Aid Group  
    public function create()  
    {  
        // Retrieve any success message from the session
        $successMessage = session('success');  
        return view('GroupMaterialAid.create', compact('successMessage'));  
    }  
    
    // Add a newly created Material Aid Group in storage  
    public function add(Request $request)  
    {  
        // Validate the request  
        $request->validate([  
            'Name' => 'required|string|max:255',  
        ]);  
    
        // Create a new Material Aid Group  
        MaterialAidGroupName::create([  
            'Name' => $request->Name,  
        ]);  
    
       // Redirect to the create page with a success message  
       //  return redirect()->route('MaterialAidGroupName.create')->with('success', 'Material Aid Group created successfully.');  
       // return response()->json(['success' => 'Material Aid Group created successfully.']); 
        return redirect()->route('GroupMaterialAid.create')->with('success', "تم إنشاء المجموعة"); 
 
    }  
    
}