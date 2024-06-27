<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrganisationModel extends Model
{
    protected $table = 'organisation'; // İlgili tablo adı
    protected $fillable = ['organisation_name']; // Doldurulabilir alanlar
}
