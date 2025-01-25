<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyRate extends Model
{
    use HasFactory;

    // Specify the table name if it's not pluralized
    protected $table = 'family_rate';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'ID';

    // If you want to allow mass assignment, specify the fillable fields
    protected $fillable = ['Rate'];



     // Define the relationship with the Family model
     public function families()
     {
         return $this->hasMany(Family::class, 'Family_Rating', 'ID');
     }

}
