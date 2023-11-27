<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'datSession', 'timBegin', 'timEnd', 'cinema_id', 'film_id',
    ];

   
    
}
