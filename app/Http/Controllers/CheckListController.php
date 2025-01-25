<?php  

namespace App\Http\Controllers;  

use App\Models\CheckList;  
use Illuminate\Http\Request;  

class CheckListController extends Controller  
{  
    public function index()  
    {  
        $checklists = CheckList::all();  
        return view('checklists.index', compact('checklists'));  
    }  

    public function create()  
    {  
        return view('checklists.create');  
    }  

    public function add(Request $request)  
    {  
        $request->validate([  
            'Name' => 'required|string|max:255',  
        ]);  

        CheckList::create($request->all());  
        return redirect()->route('checklists.index')->with('success', 'Checklist created successfully.');  
    }  

    public function edit($id)  
    {  
         // Find the CashAid record by ID
         $checkList = CheckList::findOrFail($id); 

        return view('checklists.edit', compact('checkList'));  
    }  

    public function update(Request $request, $id)  
    {
        $request->validate([  
            'Name' => 'required|string|max:255',  
        ]);  
      
        // Find the checklist by ID  
        $checkList = CheckList::findOrFail($id);  
         
        // Update the relevant fields  
        $checkList->update($request->all());  
        return redirect()->route('checklists.index')->with('success', 'Checklist updated successfully.');  
    }

    public function Delete($id)  
    {  
        $checkList = CheckList::findOrFail($id);
        $checkList->delete();  
        return redirect()->route('checklists.index')->with('success', 'Checklist deleted successfully.');  
    }
      
}