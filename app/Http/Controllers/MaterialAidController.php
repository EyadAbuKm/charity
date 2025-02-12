<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialAid;
use App\Models\TypeOfMaterialAid;
use App\Models\Family;

class MaterialAidController extends Controller
{
    public function index()
    {
    // استرداد كافةالسجلات مع تحميل العلاقات المرتبطة بها  

        $materialAids = MaterialAid::with(['family', 'typeOfMaterialAid'])->where('status', 3)->get();  
        return view('MaterialAid.index', compact('materialAids'));
    }

    public function details($family_id)
    {
        // جلب جميع السجلات المرتبط بعائلة ذات رقم دفتر عائلة محدد
        $materialAids = MaterialAid::where("Family_ID", $family_id)->with(['TypeOfmaterialAid'])->get();
        //جلب بيانات الجدول المرتبط 
        $TypeOfMaterialAids = TypeOfMaterialAid::all();  // Fetching Type of Material Aids
        return view('MaterialAid.index', compact('materialAids', 'family_id', 'TypeOfMaterialAids'));
    }
    
    public function create($family_id)
    {
        // Retrieve the related Family record using Family_ID
        $family = Family::where('Family_ID', $family_id)->first();
        // $family = Family::find($family_id);  

        // Retrieve the available types of material aid
        $TypeOfMaterialAids = TypeOfMaterialAid::all();  
        
        // Pass the Family record and the TypeOfMaterialAids to the view
        return view('MaterialAid.create', compact('family_id', 'TypeOfMaterialAids', 'family'));
    }
    
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'Family_ID' => 'required|integer',
            'Date' => 'required|date',
            'Type_Of_Aid' => 'required|integer',
            'Amount' => 'nullable|integer',
            'Status' => 'required|integer',
            'Comment' => 'nullable|string',
        ]);

         // إنشاء كائن جديد مع التحقق من الصحة
        $materialAid = new MaterialAid($validatedData);
        $materialAid->save();

        $family = $materialAid->family;

        $message = " تم تسجيل المساعدة العينية للعائلة رقم: $materialAid->Family_ID.";   

        if(!isset($request['redirect_back']))
            return redirect()->route('MaterialAid.details',$request['Family_ID'])->with('success', $message);  
        else
             return redirect()->back()->with('success', $message);
    }

    public function edit($ID)
    {
        // Fetch the Material Aid record
        $materialAid = MaterialAid::findOrFail($ID);
    
        // Fetch all Type Of Material Aid
        $TypeOfMaterialAids = TypeOfMaterialAid::all();
    
        // Fetch the Family record based on Family_ID in MaterialAid
        $family = Family::where('Family_ID', $materialAid->Family_ID)->first();
    
        // Pass $family to the view
        return view('MaterialAid.edit', compact('materialAid', 'TypeOfMaterialAids', 'family'));
    }
    
    public function update(Request $request, $ID)
    {
        $request->validate([
            'Family_ID' => 'required|integer',
            'Date' => 'required|date',
            'Type_Of_Aid' => 'required|integer',
            'Amount' => 'nullable|integer',
            'Comment' => 'nullable|string',
        ]);

        $materialAid = MaterialAid::findOrFail($ID);
        $materialAid->update($request->all());

        // return redirect()->route('MaterialAid.index', ['family_id' => $materialAid->Family_ID])
        // ->with('success', "Material Aid updated successfully ID: $ID");
       
        return redirect()->route('MaterialAid.index')->with('success', "تمّ التعديل بنجاح ID: $ID");
    }

    public function delete($ID)
    {
        $materialAid = MaterialAid::findOrFail($ID);
        $materialAid->delete();

        return redirect()->route('MaterialAid.index')->with('success', "تمّ الحذف بنجاح ID: $ID");
    }
}
