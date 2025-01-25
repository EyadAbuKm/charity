<?php  

namespace App\Http\Controllers;  
use App\Http\Controllers\Controller;

use App\Models\Family;
use App\Models\FamilyMember;   
use Illuminate\Http\Request;  
use App\Models\MemberStatus;  
use App\Models\SocialStatus;  
use App\Models\HealthyLevel;  
use App\Models\TypeOfDisease;  
use App\Models\LifeStatus;  
use App\Models\WorkStatus;  
use App\Models\EducationLevel;  
use Illuminate\Database\QueryException;

class FamilyMembersController extends Controller  
{
    //method retrieves data using FamilyMember::with([...]) 
    //to eager load related models and passes it to the view.  
    public function index()
    {
        // Retrieve all family members
        $familyMembers = FamilyMember::with([
            'memberStatus',
            'socialStatus',
            'educationLevel',
            'healthyLevel',
            'typeOfDisease',
            'lifeStatus',
            'workStatus'
        ])->get();

        // Pass the data to the view
        return view('family_members.index', compact('familyMembers'));
    }

    public function details($family_id)
    {
        // Retrieve all family members
        $familyMembers = FamilyMember::where("Family_ID",$family_id)->with([
            'memberStatus',
            'socialStatus',
            'educationLevel',
            'healthyLevel',
            'typeOfDisease',
            'lifeStatus',
            'workStatus'
        ])->get();

        // Pass the data to the view
        return view('family_members.index', compact('familyMembers','family_id'));
        
    }


    // Show the form to create a new family member  
    public function create($family_id)  
    {  
        $member_statuses = MemberStatus::all();  
        $social_statuses = SocialStatus::all();  
        $healthy_levels = HealthyLevel::all();  
        $disease_types = TypeOfDisease::all();  
        $life_statuses = LifeStatus::all();  
        $work_statuses = WorkStatus::all();  
        $Education_Level  = EducationLevel::all();  
        
    // Fetch the applicant name using the family_id
    $applicant = Family::where('Family_ID', $family_id)->first(); 
    $applicant_name = $applicant ? $applicant->Applicant_Name : '';

        return view('family_members.create', compact('member_statuses', 'social_statuses', 'healthy_levels', 'disease_types', 'life_statuses', 'work_statuses', 'Education_Level','family_id','applicant_name'));  
    }    


    // Store a new family member record  
    public function add(Request $request)  
    {  
        $messages = [
            'required' => 'حقل :attribute اجباري',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'The :attribute must have a maximum length of :max',
            'unique' =>':attribute موجود مسبقا'
          ];
          $attributes = [
            'Family_ID' => 'رقم دفتر العائلة',
            'ID_NO' => 'الرقم الوطني',
        ];
        $validatedData = $request->validate([  
            'Family_ID' =>  ['required', 'exists:family,Family_ID'],   // check if Family_ID Exist
            'Name' => 'required|string|max:50',  
            'Mother_Name' => 'required|string|max:50',  
            'Date_Of_Birth' => 'required|date',  
            'Place_Of_Birth' => 'required|string|max:50',  
            'ID_NO' => 'nullable|string|max:11|unique:family_members,ID_NO', // Ensure ID_NO is unique  
            'Member_Status' => 'required|integer',  
            'Social_Status' => 'required|integer',  
            'Occupation' => 'required|string|max:50',  
            'Accommodation' => 'required|string',  
            'Monthly_Income' => 'required|integer',  
            'Education_level' => 'required|integer',  
            'Healthy_Level' => 'required|integer',  
            'Type_of_Disease' => 'required|integer',  
            'Life_Status' => 'required|integer',  
            'Date_Of_Death' => 'nullable|date',  
            'Work_Status' => 'required|integer',  
            'Mob_Number' => 'nullable|string|max:20',  
            'Home_Address' => 'nullable|string|max:255',  
            'Work_Address' => 'nullable|string|max:255',  
            'File_Emp_Name' => 'nullable|string|max:50',  
            'Consumer' => 'nullable|boolean',
            
        ],$messages,$attributes); 
      //var_dump( $validatedData);die();
         // Fetch Applicant_Name based on Family_ID
    $applicant = Family::where('Family_ID', $request->Family_ID)->first();
    if (!$applicant) {
        return redirect()->back()->withErrors(['Family_ID' => 'Family not found.']);
    }

    // Assign Applicant_Name to Father_Name
    $validatedData['Father_Name'] = $applicant->Applicant_Name;
//    $validatedData['Consumer'] = $validatedData['Consumer']  == 'on' ?1 :0;
    $validatedData['Consumer'] = $validatedData['Consumer'] ?? 0; // Default to 0 if not set

     // Create a new family member record
     try {
        FamilyMember::create($validatedData);
    } catch (QueryException $e) {
        // Check for duplicate entry exception
        if ($e->getCode() == 23000) {
            return redirect()->back()->withErrors(['ID_NO' => 'The ID number is already in use. Please enter a unique ID number.'])->withInput();
        }
        
        // Handle other query exceptions
        return redirect()->back()->withErrors(['error' => 'An error occurred while adding the family member. Please try again.'])->withInput();
    }

    // return redirect()->route('family_members.create', $request->Family_ID)
    //                  ->with('success', 'تمت الإضافة بنجاح!');

    return redirect()->route('family_members.details', $request->Family_ID)
                     ->with('success', "تمت الإضافة بنجاح : $request->Name");
}        

      



    // Edit Method to show the edit form
    public function edit($ID)
    {
        $familyMember = FamilyMember::findOrFail($ID);
        $member_statuses = MemberStatus::all();
        $social_statuses = SocialStatus::all();
        $Education_Level = EducationLevel::all();
        $healthy_levels = HealthyLevel::all();
        $disease_types = TypeOfDisease::all();
        $life_statuses = LifeStatus::all();
        $work_statuses = WorkStatus::all();

        return view('family_members.edit', compact(
            'familyMember', 'member_statuses', 'social_statuses', 
            'Education_Level', 'healthy_levels', 'disease_types', 
            'life_statuses', 'work_statuses'
        ));
    }

    // Update Method to update the family member details
    public function update(Request $request, $ID)
    {
        $messages = [
            'required' => 'حقل :attribute اجباري',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'The :attribute must have a maximum length of :max',
            'unique' =>':attribute موجود مسبقا'
          ];
          $attributes = [
            'Family_ID' => 'رقم دفتر العائلة',
            'ID_NO' => 'الرقم الوطني',
        ];
        $request->validate([
            'Family_ID' => 'required|integer',
            'Name' => 'required|string|max:50',
            'Father_Name' => 'required|string|max:50',
            'Mother_Name' => 'required|string|max:50',
            'Date_Of_Birth' => 'required|date',
            'Place_Of_Birth' => 'required|string|max:50',
            'ID_NO' => 'nullable|string|max:11|unique:family_members,ID_NO,' . $ID, // Unique rule with exclusion for current ID
            'Member_Status' => 'required',
            'Social_Status' => 'required',
            'Occupation' => 'required|string|max:50',
            'Accommodation' => 'required|string',
            'Monthly_Income' => 'required|numeric',
            'Education_level' => 'required',
            'Healthy_Level' => 'required',
            'Type_of_Disease' => 'required',
            'Life_Status' => 'required',
            'Date_Of_Death' => 'nullable|date',
            'Work_Status' => 'required',
            'Mob_Number' => 'nullable|string|max:20',
            'Home_Address' => 'nullable|string|max:255',
            'Work_Address' => 'nullable|string|max:255',
            'File_Emp_Name' => 'nullable|string|max:50',
            'Consumer' =>''
        ],$messages,$attributes);
        $request['Consumer'] = $request['Consumer']  == 'on' ?1 :0;
        try {
            // Find the family member by ID and update the record
            $familyMember = FamilyMember::findOrFail($ID);
            $familyMember->update($request->all());
    
            // return redirect()->route('family_members.index')->with('success', 'تم تحديث البيانات بنجاح');
            return redirect()->route('family_members.details', $request->Family_ID)
            ->with('success', 'تم التحديث بنجاح!');
        } 
        
        catch (QueryException $e) {
            // Check if the exception is due to a duplicate entry for ID_NO
            if ($e->getCode() == 23000) {
                // Redirect back with a custom error message
                return redirect()->back()->withErrors(['ID_NO' => 'The ID number is already in use. Please enter a unique ID number.'])->withInput();
            }
    
            // Other query exceptions can be handled here
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the record. Please try again.'])->withInput();
        }
      
    }


    public function Delete($ID)
{
    // Find the family member by ID
    $member = FamilyMember::findOrFail($ID);

    // Perform the delete operation
    $member->delete();

    // Redirect back with a success message
 //   return redirect()->route('family_members.index')->with('success', 'Family member deleted successfully  ID: $ID');
    return redirect()->route('family_members.details',  $member->Family_ID)
    ->with('success', "تمّ الحذف بنجاح : $member->Name");
}


}

   
