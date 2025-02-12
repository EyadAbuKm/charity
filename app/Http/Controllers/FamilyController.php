<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Visit;
use App\Models\CheckList;    
use App\Models\SyrianGovernorate; 
use App\Models\HomeStatus;
use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\CashAid;
use App\Models\MaterialAid;
use App\Models\TypeOfMaterialAid;
use App\Models\FamilyRate;


class FamilyController extends Controller
{
    // public function index()
    // {
    //     // Show all families
    //     $families = Family::all();
    
    //     return view('families.index', compact('families'));
    // }

    public function index()  
    {  
        // Eager load relationships to minimize queries  
        $families = Family::with(['governorate', 'homeStatus', 'familyRate', 'familyMembers', 'consumingFamilyMembers'])->get();  
        return view('families.index', compact('families'));  
    } 

    public function create()  
    {  
        // Fetch all home statuses  
        $homeStatuses = HomeStatus::all();  
        $familyRates  = FamilyRate::all();
        // Fetch all governorates  
        $governorates = SyrianGovernorate::all();  

      //  dd($governorates, $homeStatuses, $familyRates); 
         
        return view('families.create', compact('governorates', 'homeStatuses','familyRates'));  
    
    }

    public function add(Request $request)
    {
        // Validate the request
    //    try {
        $validatedData = $request->validate([
            'Family_ID' => 'required|integer|unique:family,Family_ID',
            'Governorate' => 'required|exists:syrian_governorates,id',
            'FIle_No' => 'required|integer',
            'Application_Date' => 'required|date',
            'Applicant_Name' => 'required|string|max:255',
            'Tel_Number' => 'required|string|max:15',
            'Mob_Number' => 'required|string|max:15',
            'Daria_Address' => 'nullable|string|max:255',
            'Current_Address' => 'nullable|string|max:255',
            'Home_Condition' => 'nullable|exists:home_status,ID',
            'Family_Rating' => 'required|integer|exists:family_rate,ID',   
            'Monthly_Rent' => 'nullable|integer',
            'Another_Resources' => 'nullable|string|max:255',
            'Summary' => 'nullable|string|max:255',
            'Notes' => 'nullable|string|max:255',
            'File_Editor_Name' => 'nullable|string|max:255',
        ], [
            'Family_ID.unique' => 'هذه العائلة مسجلة مسبقا', // Custom error message for duplicate Family_ID
        ]);
        
            // Save the family record
            $family = new Family($validatedData);
            $family->save();
    
            // Redirect back with success message
            return redirect()->route('families.create')->with('success', 'تمت إضافة العائلة بنجاح! رقم العائلة: ' . $validatedData['Family_ID']);
            
    }
    
    
//Ajax 
public function getApplicantName($Family_ID)
    {
        $family = Family::find($Family_ID);
        if ($family) {
            return response()->json(['Applicant_Name' => $family->Applicant_Name]);
        } else {
            return response()->json(['Applicant_Name' => null], 404);
        }
    }
// To Test the Duplicate Family_ID
    public function checkFamilyID(Request $request)
    {
        $exists = Family::where('Family_ID', $request->Family_ID)->exists();
    
        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'هذه العائلة مسجلة مسبقا' // Custom error message in Arabic
            ]);
        }
    
        return response()->json(['status' => 'success']);
    }
    

    
    public function edit($ID)
    {
        // Fetch the family record by ID
        $family = Family::findOrFail($ID);
    
        // Fetch all home statuses
        $homeStatuses = HomeStatus::all();
        $familyRates  = FamilyRate::all();
    
        // Fetch all governorates
        $governorates = SyrianGovernorate::all();
    
        // Return the edit view with the family data
        return view('families.edit', compact('family', 'governorates', 'homeStatuses','familyRates'));
    }
    
    public function update(Request $request, $ID)
{
    // Debugging: Output all request data
    // dd($request->all());

    // Fetch the family record by ID
    $family = Family::findOrFail($ID);
    //var_dump($family);die();
    // Validate the request
try {
    $validatedData = $request->validate([
        'Governorate' => 'required|exists:syrian_governorates,id',
        'FIle_No' => 'required|integer',
        'Application_Date' => 'required|date',
        'Applicant_Name' => 'required|string|max:255',
        'Tel_Number' => 'required|string|max:15',
        'Mob_Number' => 'required|string|max:15',
        'Daria_Address' => 'nullable|string|max:255',
        'Current_Address' => 'nullable|string|max:255',
        'Home_Condition' => 'nullable|exists:home_status,ID',
        'Family_Rating' => 'required|integer|exists:family_rate,ID',  
        'Monthly_Rent' => 'nullable|integer',
        'Another_Resources' => 'nullable|string',
        'Summary' => 'nullable|string',
        'Notes' => 'nullable|string',
        'File_Editor_Name' => 'nullable|string',
    ]);


    // Update the family record with validated data
    $family->update($validatedData);
    
    return redirect()->route('families.index')->with('success', 'تمت التعديل بنجاح! رقم العائلة: ' . $ID );
  } catch (\Illuminate\Validation\ValidationException $ex) {
        // Redirect back with error message
        return redirect()->back()->withErrors(['message' => 'حدث خطأ: ' . implode(', ', $ex->validator->errors()->all())])->withInput();
    } catch (\Exception $ex) {
        // Handle other exceptions
        return redirect()->back()->withErrors(['message' => 'حدث خطأ، يرجى الإعادة: ' . $ex->getMessage()])->withInput();
    }

}

    
    public function Delete($Family_ID)
{
    // Attempt to find the family record by its Family_ID
    $family = Family::where('Family_ID', $Family_ID)->first();

    // Check if the family record exists
    if ($family) {

        // Check if the family has related child records
        if ($family->familyMembers()->exists()) {
            // If related child records exist, prevent deletion and return with an error message
            return redirect()->route('families.index')->with('error', "لا يمكن حذف السجل. يوجد لهذا العائلة سجلات أفراد مرتبطة بها. Family ID: $Family_ID");
        }

        // If no child records, delete the family record
        $family->Delete();

        // Redirect back with a success message
        return redirect()->route('families.index')->with('success', "تم حذف سجل العائلة بنجاح! Family ID: $Family_ID");
    } else {
        // If the family record does not exist, redirect back with an error message
        return redirect()->route('families.index')->with('error', "سجل العائلة غير موجود! Family ID: $Family_ID");
    }
    
    }


public function full_details(Request $request)  
{  
    // Validate input  
    $request->validate([  
        'Family_ID' => 'required|integer',  
    ]);  

    $family = Family::find($request->input('Family_ID'));  

    // Check if family was found  
    if (!$family) {  
        return redirect()->route('families.full_details', ['Family_ID' => 0])->with('error', 'Family ID ' .'('.$request->input('Family_ID') .')'. ' does not exist.');  
    } 
    // $homeStatuses = HomeStatus::all();  
    // // Fetch all governorates  
    // $governorates = SyrianGovernorate::all();            

    $familyMembers = FamilyMember::where("Family_ID", $family->Family_ID)->with([  
        'memberStatus',  
        'socialStatus',  
        'educationLevel',  
        'healthyLevel',  
        'typeOfDisease',  
        'lifeStatus',  
        'workStatus'  
    ])->get();  

    $cashAids = CashAid::where("Family_ID", $family->Family_ID)->where('status', 3)->get();  
    $materialAids = MaterialAid::where("Family_ID", $family->Family_ID)->where('status', 3)->get();  
    $visits = Visit::where('Family_ID', $family->Family_ID)->get();  
    $checklists = CheckList::all();  
    // Return the combined view with family, family members, and cash aids  
    return view('families.full_details', compact('family', 'familyMembers', 'cashAids','materialAids','visits','checklists'));  
}

}       