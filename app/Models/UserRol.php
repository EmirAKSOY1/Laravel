<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = 'role_user'; // İlgili tablo adı
    protected $fillable = ['user_id','role_id','organasation_level_id']; // Doldurulabilir alanlar
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organisationLevel()
    {
        return $this->belongsTo(OrganisationLevel::class, 'organasation_level_id');
    }
}
