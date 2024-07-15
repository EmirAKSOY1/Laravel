<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityModel extends Model
{
    use HasFactory;
    protected $table = 'disabilities';
    protected $fillable = [
        'name',
    ];

}
