<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Family;  
use App\Models\TypeOfMaterialAid;  
use App\Models\MaterialAid;  
use App\Models\MaterialAidGroupName;

class GroupMaterialAidController extends Controller  
{  
  
 // مرحلة تسليم الدعم العيني الجماعي
    public function index2()
    {
        // Retrieve all Material Aid records
        $materialAids = MaterialAid::with(['typeOfMaterialAid', 'family', 'materialAids'])
                                    ->whereNotNull('Group_Id')
                                    ->whereIn('Status', [2, 3])
                                    ->orderBy('ID','desc')
                                    ->get()
                                    ->groupBy('Group_Id'); // تجميع حسب رقم المجموعة                          

        // Return the view with the data
        return view('GroupMaterialAid.index2', compact('materialAids'));
    }

//مرحلة الموافقة على الدعم العيني الجماعي
    public function index()
    {
        // جلب البيانات مع العلاقات المرتبطة
        $materialAids = MaterialAid::with(['family', 'typeOfMaterialAid', 'materialAids'])
        ->whereNotNull('Group_Id')
        ->orderBy('ID','desc')
        ->get()
        ->groupBy('Group_Id'); // تجميع حسب رقم المجموعة
            

        return view('GroupMaterialAid.index', compact('materialAids'));
    }
  
    public function create()  
    {  
        // Retrieve all available families  
        $families = Family::all();  
        
        // Retrieve the available types of material aid  
        $TypeOfMaterialAids = TypeOfMaterialAid::all();  

        $MaterialAidGroupNames = MaterialAidGroupName ::all();

        // Return the view with families and types of material aid  
        return view('GroupMaterialAid.create', compact('families', 'TypeOfMaterialAids','MaterialAidGroupNames'));  
    }  

    public function add(Request $request)
    {
      
       // print_r( $validatedData);die();

    // تقسيم Family_ID إلى مصفوفة وإزالة المسافات الزائدة
    $families = array_map('trim', explode("\n", $request['Family_ID']));
      //  $families = explode("\n",$request['Family_ID']);
    // print_r($families);die();

       // إزالة التكرارات
    $uniqueFamilies = array_unique($families);
    
    // تحقق من وجود أي عائلات مكررة
    if (count($families) !== count($uniqueFamilies)) {
        return redirect()->route('GroupMaterialAid.create')
            ->with('error', 'هناك أرقام مكررة في إدخال عائلات.');
    }

        $group = new MaterialAidGroupName(array('Name' =>  $request['Name']));
        $group->save();


        foreach ($families as $key => $family_id) {
            // تحقق من وجود Family_ID قبل الإدخال
            if (!Family::where('Family_ID', $family_id)->exists()) {
                return redirect()->route('GroupMaterialAid.create')
                ->with('error', "رقم العائلة $family_id غير موجود.")
                ->withInput(); // احتفظ بالمدخلات السابقة
            }

            $aidData['Family_ID'] = $family_id;
            $aidData['Date'] = $request['Date'];
            $aidData['Type_Of_Aid'] = $request['Type_Of_Aid'];
            $aidData['Amount'] = $request['Amount'];
            $aidData['Status'] = $request['Status'];
            $aidData['Comment'] = $request['Comment'];
            $aidData['Group_Id'] = $group->ID;
             // إنشاء كائن جديد مع التحقق من الصحة
            $materialAid = new MaterialAid($aidData);
            $materialAid->save();
        }
       

        return redirect()->route('GroupMaterialAid.index')->with('success', 'Material Aid created successfully!');  
    }

    public function updateAidStatus(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'status' => 'required|integer',
    ]);

    $aid = MaterialAid::find($request->id);
    
    if ($aid) {
        $aid->Status = $request->status;
        $aid->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}


} 





