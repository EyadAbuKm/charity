<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class MaterialAidGroupName extends Model  
{  
    use HasFactory;  

    protected $table = 'material_aid_group';   
    protected $primaryKey = 'ID';  
    public $timestamps = false; 
    protected $fillable = ['Name'];  // Define mass-assignable fields  

    // Define the relationship with MaterialAid  
    public function materialAids()  
    {  
        return $this->hasMany(MaterialAid::class, 'Group_Id', 'ID'); 
    }  


}