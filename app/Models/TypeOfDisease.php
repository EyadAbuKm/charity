<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class TypeOfDisease extends Model  
{  
    use HasFactory;  

    protected $table = 'Type_of_Disease';  

    protected $fillable = ['Name'];  


     // Define the one-to-many relationship with FamilyMember  
     public function familyMembers()  
     {  
         return $this->hasMany(FamilyMember::class, 'Type_of_Disease', 'ID');   
     }  

}