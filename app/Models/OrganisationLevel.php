<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationLevel extends Model
{
    protected $table = 'level_organisation'; // İlgili tablo adı
    protected $fillable = ['organisation_id','level_id']; // Doldurulabilir alanlar
}
