<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{
    public function index()
    {
        // Retrieve all donors
        $donors = Donor::all();
        return view('Donors.index', compact('donors'));
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
