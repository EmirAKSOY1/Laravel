<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionDisability extends Model
{
    use HasFactory;
    protected $table = 'question_disability'; // İlgili tablo adı
    protected $fillable = ['question_ID','disability_ID ']; // Doldurulabilir alanlar

    public function get_disability()
    {
        return $this->belongsTo(DisabilityModel::class, 'disability_ID');
    }
    public function get_question()
    {
        return $this->belongsTo(QuestionModel::class, 'question_ID');
    }
}
