<?php

namespace App\Http\Controllers;

use App\Models\CashAid;
use App\Models\Family;
use Illuminate\Http\Request;


class CashAidController extends Controller
{
    public function index()  
    {  
   // Retrieve all CashAid records, including their related Family data, using Eloquent's 'with' method.
          $cashAids = CashAid::with('family')->get();
    // Pass the retrieved data to the 'CashAid.index' view and make it accessible using the variable 'cashAids'.
        return view('CashAid.index', compact('cashAids'));  
    }

    public function details($family_id)
    {
        // Retrieve all family members
        $cashAids = CashAid::where("Family_ID",$family_id)->get();

        // Pass the data to the view
        return view('CashAid.index', compact('cashAids','family_id'));  
        
    }


    public function create($family_id)
    {
        // Retrieve the family record from the database using the provided family ID  
        $family = Family::where('Family_ID', $family_id)->first();
        // Pass the family ID and the family object to the view for further processing/display 
        return view('CashAid.create',compact('family_id','family'));
    }

    
    public function add(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
        'Family_ID' => 'required|integer',  
        'Date_' => 'required|date',
        'Amount' => 'required|integer',  
        'Comment' => 'nullable|string',  
            ]);
       
        // إنشاء كائن جديد مع التحقق من الصحة
        $cash = new CashAid($validatedData);
        $cash->save();

           
        // Retrieve the related Family record
        $family = $cash->family; // This will fetch the Family record based on Family_ID

        $message = "تم تسجيل المساعدة المالية بنجاح للعائلة رقم: $cash->Family_ID , $family->Applicant_Name, مبلغ $cash->Amount. شكرًا.";  
    
        if(!isset($request['redirect_back']))
            return redirect()->route('CashAid.details',$request['Family_ID'])->with('success', $message);
        else
            return redirect()->back()->with('success', $message);
   }
 
    public function edit($ID)
{
    // Find the CashAid record by ID
    $cashAids = CashAid::findOrFail($ID);

    // Retrieve the related Family record using Family_ID
    $family = Family::where('Family_ID', $cashAids->Family_ID)->first();

    // Pass the record to the 'edit' view
    return view('CashAid.edit', compact('cashAids','family'));
}


    public function update(Request $request, $ID)  
    {  
        $validatedData = $request->validate([  
            'Family_ID' => 'required|integer',  
            'Date_' => 'required|date',
            'Amount' => 'required|integer',  
            'Comment' => 'nullable|string',  
        ]);  

        $cashAids = CashAid::findOrFail($ID);  
       
        $cashAids->update($validatedData);  
         
        return redirect()->route('CashAid.index')->with('success',  "تم تعديل المساعدة المالية بنجاح  ID: $cashAids->ID");
    }  


    
    public function delete($ID)
    {
        //dd($ID);
        // Find the family member by ID
        $cashAids = CashAid::findOrFail($ID);
    
        // Perform the delete operation
        $cashAids->delete();
        
        // Redirect back with a success message
        return redirect()->route('CashAid.index')->with('success', "تمَّ الحذف بنجاح  ID: $ID ");
        
    }
    
}

