<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'family'; // Specify the table name if it's not the plural of the model name

    protected $primaryKey = 'Family_ID';
    protected $fillable = [
        'Family_ID',
        'Governorate',
        'FIle_No',
        'Application_Date',
        'Applicant_Name',
        'Tel_Number',
        'Mob_Number',
        'Daria_Address',
        'Current_Address',
        'Home_Condition',
        'Family_Rating',
        'Monthly_Rent',
        'Another_Resources',
        'Summary',
        'Notes',
        'File_Editor_Name',

    ];

    public $timestamps = true; // Use Laravel's created_at and updated_at

    // Define the relationship with the SyrianGovernorate model
    public function governorate()
    {
        return $this->belongsTo(SyrianGovernorate::class, 'Governorate', 'id');
    }

// Relationship with HomeStatus model 
     public function homeStatus()  
     {  
         return $this->belongsTo(HomeStatus::class, 'Home_Condition', 'ID'); 
     }
     
     public function familyRate()  
     {  
         return $this->belongsTo(FamilyRate::class, 'Family_Rating', 'ID'); 
     }


// Relationship with FamilyMember model  
    public function familyMembers()  
    {  
        return $this->hasMany(FamilyMember::class, 'Family_ID', 'Family_ID') 
                    ->where('Life_Status',  1);
    }


    // Custom relationship to get only FamilyMembers where Consumer is true
    public function consumingFamilyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'Family_ID', 'Family_ID')
                    ->where('Consumer', true)
                    ->where('Life_Status', 1);
    }
    

    public function CashAid()  
    {  
        return $this->hasMany(CashAid::class, 'Family_ID', 'Family_ID');  
    }

    public function MaterialAid()  
    {  
        return $this->hasMany(MaterialAid::class, 'Family_ID', 'Family_ID');  
    }

}   