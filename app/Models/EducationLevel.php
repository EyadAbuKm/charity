<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class EducationLevel extends Model  
{  
    use HasFactory;  

    protected $table = 'Education_level';  

    protected $fillable = ['Name'];  


// Define the one-to-many relationship with FamilyMember  
    public function familyMembers()  
    {  
        return $this->hasMany(FamilyMember::class, 'Education_level', 'ID'); // Adjust 'ID' if your primary key is different  
    }   

}

