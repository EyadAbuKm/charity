<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAid extends Model
{
    use HasFactory;
    protected $table = 'cash_aid';
    protected $primaryKey = 'ID'; 
    protected $fillable = ['Family_ID','Date_','Amount','Group_Id','Status','Comment'];

    public function family()  
    {  
        return $this->belongsTo(Family::class, 'Family_ID', 'Family_ID');  
    }  
    

    public function CashAidGroup()
    {
        return $this->belongsTo(CashAidGroup::class, 'Group_Id', 'ID');
    }


}
