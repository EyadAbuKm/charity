<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class CashAidGroup extends Model

{  
    use HasFactory;  

    protected $table = 'cash_aid_group';   
    protected $primaryKey = 'ID';  
    public $timestamps = false; 
    //
    protected $fillable = ['Name'];  // Define mass-assignable fields  

    // Define the relationship with MaterialAid  
    public function cashAids()  
    {  
        return $this->hasMany(CashAid::class, 'Group_Id', 'ID'); 
    }  



}
