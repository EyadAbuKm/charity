<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class FamilyMember extends Model  
{  
    use HasFactory;  

    // Specify the table name if it doesn't follow Laravel's naming convention  
    protected $table = 'family_members';  

    // Specify the primary key if it's not 'id'  
    protected $primaryKey = 'ID';  

    // Disable timestamps if you are not using the default created_at and updated_at  
    public $timestamps = false;  

    // Define the fillable attributes  
    protected $fillable = [  
        'Family_ID',  
        'Name',  
        'Father_Name',  
        'Mother_Name',  
        'Date_Of_Birth',  
        'Place_Of_Birth',  
        'ID_NO',  
        'Member_Status',  
        'Social_Status',  
        'Occupation',  
        'Accommodation',  
        'Monthly_Income',  
        'Education_level',  
        'Healthy_Level',  
        'Type_of_Disease',  
        'Life_Status',  
        'Date_Of_Death',  
        'Work_Status',  
        'Mob_Number',  
        'Home_Address',  
        'Work_Address', 
        'Consumer', 
        'File_Emp_Name',  
    
    ];  


    // Relationship with Family model  
public function family()  
{  
    return $this->belongsTo(Family::class, 'Family_ID', 'Family_ID');  
}

// Relationship with EducationLevel model  
public function educationLevel()  
{  
    return $this->belongsTo(EducationLevel::class, 'Education_level', 'ID');   
}  


 // Relationship with HealthyLevel model  
 public function healthyLevel()  
 {  
     return $this->belongsTo(HealthyLevel::class, 'Healthy_Level', 'ID'); 
 }  

  // Relationship with LifeStatus model  
  public function lifeStatus()  
  {  
      return $this->belongsTo(LifeStatus::class, 'Life_Status', 'ID'); 
  }  
// Relationship with SocialStatus model  
public function socialStatus()  
{  
    return $this->belongsTo(SocialStatus::class, 'Social_Status', 'ID');  
}  

// Relationship with TypeOfDisease model  
public function typeOfDisease()  
{  
    return $this->belongsTo(TypeOfDisease::class, 'Type_of_Disease', 'ID');  
}  

// Relationship with WorkStatus model  
public function workStatus()  
{  
    return $this->belongsTo(WorkStatus::class, 'Work_Status', 'ID');  
}

 // Relationship with MemberStatus model  
 public function memberStatus()  
 {  
     return $this->belongsTo(MemberStatus::class, 'Member_Status', 'ID');  
 }  

}