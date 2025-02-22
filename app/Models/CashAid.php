<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAid extends Model
{
    use HasFactory;
    protected $table = 'cash_aid';
    protected $primaryKey = 'ID'; 
    protected $fillable = ['Family_ID','Date_','Amount','Comment'];

    public function family()  
    {  
        return $this->belongsTo(Family::class, 'Family_ID', 'Family_ID');  
    }  
    
}
