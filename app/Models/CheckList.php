<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class CheckList extends Model  
{  
    use HasFactory;  

    protected $table = 'check_List';  
    protected $primaryKey = 'id';
    protected $fillable = [  
        'Name',  
    ];  

    public function visitsChecklist()  
    {  
        return $this->hasMany(VisitsChecklist::class, 'Check_List_ID');  
    }  
}