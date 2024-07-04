<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationLevel extends Model
{
    protected $table = 'level_organisation'; // İlgili tablo adı
    protected $fillable = ['organisation_id','level_id']; // Doldurulabilir alanlar
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function organisation()
    {
        return $this->belongsTo(OrganisationModel::class, 'organisation_id');
    }
}
