<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class HealthyLevel extends Model  
{  
    use HasFactory;  

    protected $table = 'Healthy_Level';  

    protected $fillable = ['Name'];  


    public function familyMembers()  
    {  
        return $this->hasMany(FamilyMember::class, 'Healthy_Level', 'ID');  
    }  


}

