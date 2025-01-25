<?php  

namespace App\Http\Controllers;  

use App\Models\Family;  
use App\Models\Visit;  
use App\Models\CheckList;  
use App\Models\VisitsChecklist;  
use Illuminate\Http\Request;  

class VisitController extends Controller  
{  
    // Show form to create a new visit  
    public function create()  
    {  
        // Retrieve all checklists  
        $checkLists = CheckList::all();  
        return view('visits.create', compact('checkLists'));  
    }  

    // Store the visit and associated visitsChecklist  
    public function add(Request $request)  
    {  
        // Validate incoming request data  
        $request->validate([  
            'Family_ID' => 'required|integer',  
            'Date' => 'required|date',  
            'Comment' => 'nullable|string',  
            'Visiting_Officer' => 'required|string',  
            'check_lists' => 'required|array',  
            'check_lists.*.Check_List_ID' => 'nullable|integer|exists:check_list,id',  
            'check_lists.*.Status' => 'nullable|integer|max:1',  
            'check_lists.*.Comments' => 'nullable|string',  
        ]);  
    
        // Validate if Family ID exists  
        if (!Family::find($request->Family_ID)) {  
            return redirect()->back()->withInput()->with('error', 'Family ID (' . $request->input('Family_ID') . ') does not exist.');  
        }  
    
        // Create the visit  
        $visit = Visit::create($request->only(['Family_ID', 'Date', 'Comment', 'Visiting_Officer']));  
    
        // Create associated VisitsChecklist entries  
        foreach ($request->check_lists as $checkListData) {  
            $status = isset($checkListData['Status']) ? 1 : 0;  
    
            VisitsChecklist::create([  
                'Family_ID' => $visit->Family_ID,  
                'visit_id' => $visit->id,  
                'Check_List_ID' => $checkListData['Check_List_ID'],  
                'Status' => $status,  
                'Comments' => $checkListData['Comments'],  
            ]);  
        }  
    
        return redirect()->route('visits.create')->with('success', 'تم إضافة سجل الزيارة بنجاح.');  
    }  


    public function getFamilyVists($familyId)  
    {  
        // Fetch visits for the specific Family_ID  
        $visits = Visit::where('Family_ID', $familyId)->get();  
       // print_r($visits[0]->visitsChecklists);
        return view('visits.family_visits', compact('visits', 'familyId'));  
    } 

    public function index()  
    {  
        // Fetch visits for the specific Family_ID  
        $visits = Visit::get();  
        //print_r($visits[0]->visitsChecklists);
        return view('visits.index', compact('visits'));  
    } 

    public function details($visitID)  
    {  
        // Fetch visits for the specific Family_ID  
        $visit = Visit::where('ID', $visitID)->first();  
        //print_r($visits[0]->visitsChecklists);
        return view('visits.details', compact('visit'));  
    } 

    function full_visits(){
        $visits = Visit::get();  
        $checklists = CheckList::all();  
        //print_r($visits[0]->visitsChecklists);
        return view('visits.full_visits', compact('visits','checklists'));  
    }

   
    public function getApplicantName($Family_ID)
    {
        $family = Family::find($Family_ID);
        if ($family) {
            return response()->json(['Applicant_Name' => $family->Applicant_Name]);
        } else {
            return response()->json(['Applicant_Name' => null], 404);
        }
    }




}
