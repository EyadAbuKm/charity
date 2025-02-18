<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{
    function searchByAjax(Request $request)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length',10);
        $searchValue = $request->input('search.value');
        
        $query = Donor::query();
        
        if (!empty($searchValue)) {
            $query->where('Name', 'like', '%'.$searchValue.'%');
        }
        
        $total = $query->count();
        $donors = $query->skip($start)->take($length)->get();
        
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Donor::count(),
            'recordsFiltered' => $total,
            'data' => $donors
        ]);
    }
    

//     function searchByAjax(Request $request)
// {

//         $searchValue = null;
//         if ($request->has('search') && !empty($request->search['value']))   
//         $searchValue = $request->search['value'];

//         return Donor::when( isset($searchValue), function ($query) use ($searchValue) {
//         return $query->where('Name','like', '%'.$searchValue.'%');
//     })->paginate(10);
// }


    public function index()
    {
        // Retrieve all donors
      //  $donors = Donor::paginate(5);
        return view('Donors.ajaxIndex');
    }

    public function create()
    {
        return view('Donors.create');
    }

    public function add(Request $request)
    {
         // التحقق من صحة البيانات المدخلة
         $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'Name' => 'required|string|max:50',
            'Amount' => 'nullable|integer',
            'Donation_Type' => 'required|string',
            'DonationDetails' => 'required|string',
            'Description' => 'nullable|string',
            'Phone' => 'nullable|string',  
                ]);
           
            // إنشاء كائن جديد مع التحقق من الصحة
        $donor = new Donor($validatedData);
        $donor->save();

        return redirect()->route('Donors.index')->with('success', "تم تسجيل التبرع بنجاح ! $donor->Name . شكرا.");
    }


    public function edit($id)
    {
        // Fetch the family record by ID
        $donor = Donor::findOrFail($id);
    
        // Return the edit view with the family data
        return view('Donors.edit',compact('donor'));
    }
    
    public function update(Request $request, $id)
{
    $donor = Donor::findOrFail($id);
    
    $validatedData = $request->validate([
       
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'Name' => 'required|string|max:50',
        'Amount' => 'nullable|integer',
        'Donation_Type' => 'required|string',
        'DonationDetails' => 'required|string',
        'Description' => 'nullable|string',
        'Phone' => 'nullable|string',    
    ]);


    // Update the Donor record with validated data
    $donor->update($validatedData);
    
    return redirect()->route('Donors.index')->with('success', "تم تعديل التبرع بنجاح ID: $id");
}

    public function Delete($id)
    {
        // Find the family member by ID
        $donor = Donor::findOrFail($id);
    
        // Perform the delete operation
        $donor->delete();
    
        // Redirect back with a success message
        return redirect()->route('Donors.index')->with('success', "Donor deleted successfully  ID: $id");
    }
    
}
