<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrganisationModel extends Model
{
    protected $table = 'organisation'; // İlgili tablo adı
    protected $fillable = ['organisation_name']; // Doldurulabilir alanlar

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_organisation', 'organisation_id', 'level_id');
    }
}
