<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class LifeStatus extends Model  
{  
    use HasFactory;  

    protected $table = 'Life_Status';  

    protected $fillable = ['Name'];  


    // Define the one-to-many relationship with FamilyMember  
    public function familyMembers()  
    {  
        return $this->hasMany(FamilyMember::class, 'Life_Status', 'ID');
    }  
    
}