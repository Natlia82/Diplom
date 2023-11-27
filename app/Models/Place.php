<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'typeOfPlace', 'row', 'colum', 'seatNumber', 'cinema_id'
    ];
}
