<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialAid extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form
    protected $table = 'material_aid'; 

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'ID';  

    // Disable timestamps if not using them
    public $timestamps = false;  

    // Define which fields are mass-assignable
    protected $fillable = ['Family_ID', 'Date', 'Type_Of_Aid', 'Amount','Group_Id','Status', 'Comment'];  

    // Define the inverse relationship with TypeOfMaterialAid
    public function typeOfMaterialAid()
    {
        return $this->belongsTo(typeOfMaterialAid::class, 'Type_Of_Aid', 'ID');
    }

    public function family()
    {
        return $this->belongsTo(Family::class, 'Family_ID', 'Family_ID');
    }  


    public function materialAids()  
    {  
        return $this->belongsTo(MaterialAidGroupName::class, 'Group_Id', 'ID'); 
    } 

}
