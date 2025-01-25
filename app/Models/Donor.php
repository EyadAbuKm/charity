<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $table = 'Donors';

    protected $fillable = [
        'date',
        'time',
        'Name',
        'Donation_Type',
        'DonationDetails',
        'Amount',
        'Description',
        'Phone',
    ];
}
