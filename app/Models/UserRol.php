<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = 'role_user'; // İlgili tablo adı
    protected $fillable = ['user_id','role_id']; // Doldurulabilir alanlar
}
