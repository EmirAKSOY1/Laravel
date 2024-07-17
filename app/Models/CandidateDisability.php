<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDisability extends Model
{
    use HasFactory;
    protected $table = 'candidate_disability'; // İlgili tablo adı
    protected $fillable = ['candidate_id','disability_id']; // Doldurulabilir alanlar

    public function disability()
    {
        return $this->belongsTo(DisabilityModel::class, 'disability_id');
    }
}
