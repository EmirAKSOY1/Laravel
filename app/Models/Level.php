<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $table = 'levels'; // İlgili tablo adı
    protected $fillable = ['name'];

    public function organisations()
    {
        return $this->belongsToMany(OrganisationModel::class, 'level_organisation','level_id', 'organisation_id');
    }
}
