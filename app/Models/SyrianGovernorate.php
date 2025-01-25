<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyrianGovernorate extends Model
{
    use HasFactory;

    protected $table = 'syrian_governorates'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'name',
    ];

    public $timestamps = false; // Assuming this table does not have created_at and updated_at fields

    // Define the relationship with the Family model
    public function families()
    {
        return $this->hasMany(Family::class, 'Governorate', 'id');
    }
}   