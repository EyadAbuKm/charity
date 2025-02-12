<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashAid;
use App\Models\MaterialAid;
use App\Models\Family;
use App\Models\TypeOfMaterialAid;

class AidController extends Controller
{
    
public function index(Request $request)  
{  
    // Validate input  
    $request->validate([  
        'Family_ID' => 'required|integer',  
    ]);  

    $family = Family::find($request->input('Family_ID'));  

    // Check if family was found  
    if (!$family) {  
       // return redirect()->route('families.index', ['Family_ID' => 0])->with('error', 'Family ID ' .'('.$request->input('Family_ID') .')'. ' does not exist.');  
       return back()->with('error', 'العائلة رقم' .'('.$request->input('Family_ID') .')'. ' غير موجودة.');  
    } 


    $cashAids = CashAid::where("Family_ID", $family->Family_ID)->where('status', 3)->get();  
    $materialAids = MaterialAid::where("Family_ID", $family->Family_ID)->where('status', 3)->get();  
    $TypeOfMaterialAids = TypeOfMaterialAid::all();
    // Return the combined view with family, family members, and cash aids  
    return view('aid.index', compact('family',  'cashAids','materialAids','TypeOfMaterialAids'));  
}


public function create($family_id)
{
    // Retrieve the family record from the database using the provided family ID  
    $family = Family::where('Family_ID', $family_id)->first();
    
    // Retrieve the available types of material aid
 //   $TypeOfMaterialAids = TypeOfMaterialAid::all();  
      // Debugging output
 ///     dd($TypeOfMaterialAids);

   // return view('aid.index',compact('family_id', 'TypeOfMaterialAids', 'family'));
    return view('aid.index',compact('family_id', 'family'));
}


public function add(Request $request)
{
    // التحقق من صحة البيانات المدخلة
    $validatedData = $request->validate([
    'Family_ID' => 'required|integer',  
    'Date_' => 'required|date',
    'Amount' => 'required|integer',  
    'Comment' => 'nullable|string',  
  //  'Date' => 'required|date',
        ]);



    // إنشاء كائن جديد مع التحقق من الصحة
    $cash = new CashAid($validatedData);
    $cash->save();
    
    // Retrieve the related Family record
    $family = $cash->family; // This will fetch the Family record based on Family_ID

    // $materialAid = new MaterialAid($validatedData);
    // $materialAid->save();


    return redirect()->route('aid.index')->with('success', "تم تسجيل الدعم بنجاح للعائلة رقم: $cash->Family_ID , $family->Applicant_Name, : مبلغ $cash->Amount. شكرا.");
  
}

}



