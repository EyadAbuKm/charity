<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class VisitsChecklist extends Model  
{  
    use HasFactory;  

    protected $table = 'visits_checklist';  

    protected $fillable = [  
        'Family_ID',  
        'visit_id',  
        'Check_List_ID',  
        'Status', 
        'Comments'
    ];  

    public function visit()  
    {  
        return $this->belongsTo(Visit::class, 'visit_id');  
    }  

    public function checkList()  
    {  
        return $this->belongsTo(CheckList::class, 'Check_List_ID');  
    }  

    public function family()  
    {  
        return $this->belongsTo(Family::class, 'Family_ID');  
    }  
}