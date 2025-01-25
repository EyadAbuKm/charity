<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class SocialStatus extends Model  
{  
    use HasFactory;  

    protected $table = 'Social_Status';  

    protected $fillable = ['Name'];  

// Define the one-to-many relationship with FamilyMember  
public function familyMembers()  
{  
    return $this->hasMany(FamilyMember::class, 'Social_Status', 'ID'); 
}  


}