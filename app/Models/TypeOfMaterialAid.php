<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfMaterialAid extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form
    protected $table = 'type_of_material_aid';  

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'ID';  

    // Disable timestamps if not using them
    public $timestamps = false;  

    // Define which fields are mass-assignable
    protected $fillable = ['Name'];  

    // Define the relationship with MaterialAid
    public function materialAids()
    {
        return $this->hasMany(MaterialAid::class, 'Type_Of_Aid', 'ID');
    }
}
    