<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Family;  
use App\Models\CashAid;  
use App\Models\CashAidGroup;

class GroupCashAidController extends Controller  
{  
  
 // مرحلة تسليم الدعم النقدي الجماعي
    public function index2()
    {
        // Retrieve all Cash Aid records
        $cashAids = CashAid::with(['family', 'cashAids'])
                                    ->whereNotNull('Group_Id')
                                    ->whereIn('Status', [2, 3])
                                    ->orderBy('ID','desc')
                                    ->get()
                                    ->groupBy('Group_Id'); // تجميع حسب رقم المجموعة                          

        // Return the view with the data
        return view('GroupCashAid.index2', compact('cashAids'));
    }

//مرحلة الموافقة على الدعم النقدي الجماعي
    public function index()
    {
        // جلب البيانات مع العلاقات المرتبطة
        $cashAids = CashAid::with(['family', 'cashAids'])
        ->whereNotNull('Group_Id')
        ->orderBy('ID','desc')
        ->get()
        ->groupBy('Group_Id'); // تجميع حسب رقم المجموعة
            

        return view('GroupCashAid.index', compact('cashAids'));
    }
  
    public function create()  
    {  
        // Retrieve all available families  
        $families = Family::all();  


        $GroupCashAid = CashAidGroup ::all();

        // Return the view with families and types of material aid  
        return view('GroupCashAid.create', compact('families', 'GroupCashAid'));  
    }  

    public function add(Request $request)
    {
      
           // تحقق من وجود اسم المجموعة
    $request->validate([
        'Name' => 'required|string', // إضافة التحقق
        'Family_ID' => 'required|integer',
        'Date_' => 'required|date',
        'Amount' => 'required|integer',
        'Status' => 'required|integer',
        'Comment' => 'nullable|string|max:255',
    ]);

       // print_r( $validatedData);die();

    // تقسيم Family_ID إلى مصفوفة وإزالة المسافات الزائدة
    $families = array_map('trim', explode("\n", $request['Family_ID']));
      //  $families = explode("\n",$request['Family_ID']);
    // print_r($families);die();

       // إزالة التكرارات
    $uniqueFamilies = array_unique($families);
    
    // تحقق من وجود أي عائلات مكررة
    if (count($families) !== count($uniqueFamilies)) {
        return redirect()->route('GroupCashAid.create')
            ->with('error', 'هناك أرقام مكررة في إدخال عائلات.');
    }

     //   $group = new CashAidGroup(array(['Name' =>  $request['Name']]));
        $group = new CashAidGroup(['Name' => $request['Name']]);
        $group->save();


        foreach ($families as $key => $family_id) {
            // تحقق من وجود Family_ID قبل الإدخال
            if (!Family::where('Family_ID', $family_id)->exists()) {
                return redirect()->route('GroupCashAid.create')
                ->with('error', "رقم العائلة $family_id غير موجود.")
                ->withInput(); // احتفظ بالمدخلات السابقة
            }

                    // إعداد بيانات المساعدة
        $aidData = [
            'Family_ID' => $family_id,
            'Date_' => $request['Date_'], // تأكد من استخدام الاسم الصحيح
            'Amount' => $request['Amount'], // تأكد من أن القيمة ليست فارغة
            'Status' => $request['Status'], // استخدام الحالة المحددة
            'Comment' => $request['Comment'],
            'Group_Id' => $group->ID, // تعيين ID المجموعة
        ];

            // $aidData['Family_ID'] = $family_id;
            // $aidData['Date_'] = $request['Date_'];
            // $aidData['Amount'] = $request['Amount'];
            // $aidData['Status'] = $request['Status'];
            // $aidData['Comment'] = $request['Comment'];
            // $aidData['Group_Id'] = $group->ID;
             // إنشاء كائن جديد مع التحقق من الصحة
            $cashAid = new CashAid($aidData);
          //  dd($aidData);
            $cashAid->save();
        }
       

        return redirect()->route('GroupCashAid.index')->with('success', 'Cash Aid created successfully!');  
    }

    public function updateAidStatus(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'status' => 'required|integer',
    ]);

    $aid = CashAid::find($request->id);
    
    if ($aid) {
        $aid->Status = $request->status;
        $aid->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}


} 





