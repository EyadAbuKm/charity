<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class MemberStatus extends Model  
{  
    use HasFactory;  

    protected $table = 'Member_Status';  

    protected $fillable = ['Name'];  

 // Define the one-to-many relationship with FamilyMember  
 public function familyMembers()  
 {  
     return $this->hasMany(FamilyMember::class, 'Member_Status', 'ID'); 
 }  


}
