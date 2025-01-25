<?php
//  Contrlller
//  خاص بالصفحة الرئيسية  
// تمت الاستفادة من الصفحة
// https://demo.themefisher.com/mono-bootstrap/index.html

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use Illuminate\Support\Facades\DB;
use App\Models\CashAid;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        // Retrieve all donors
        $donorData = Donor::selectRaw('SUM(Amount) as total_amount, MONTH(date) as month')
        ->where("Donation_Type","=","نقدي")
        ->whereRaw('YEAR(date) = ?', [$currentYear])  // Filter for the current year
        ->groupBy(DB::raw('MONTH(date)'))
        ->orderBy(DB::raw('MONTH(date)'), 'ASC')
        ->get();
    
        // Initialize an array with 12 months (index 1-12 for Jan-Dec)
        $totalAmounts = array_fill(1, 12, 0);
        
        // Fill the array with actual data, replacing the 0s where there's data
        foreach ($donorData as $data) {
            $totalAmounts[$data->month] = $data->total_amount;
        }
        //print_r($totalAmounts);die();
        
        // Reindex the array so the final output starts from January (index 0)
        $donorData = array_values($totalAmounts);

        $cachAidData = CashAid::selectRaw('SUM(Amount) as total_amount, MONTH(Date_) as month')
        ->whereRaw('YEAR(Date_) = ?', [$currentYear])  // Filter for the current year
        ->groupBy(DB::raw('MONTH(Date_)'))
        ->orderBy(DB::raw('MONTH(Date_)'), 'ASC')
        ->get();
    
        // Initialize an array with 12 months (index 1-12 for Jan-Dec)
        $totalAmounts = array_fill(1, 12, 0);
        
        // Fill the array with actual data, replacing the 0s where there's data
        foreach ($cachAidData as $data) {
            $totalAmounts[$data->month] = $data->total_amount;
        }
        //print_r($totalAmounts);die();
        
        // Reindex the array so the final output starts from January (index 0)
        $cachAidData = array_values($totalAmounts);


        return view('home', compact('donorData','cachAidData'));
    }

    
}
