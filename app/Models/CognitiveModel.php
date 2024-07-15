<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CognitiveModel extends Model
{
    use HasFactory;
    protected $table = 'cognitive';
    protected $fillable = ['taksonomi_name', 'cognitve_name'];
}
