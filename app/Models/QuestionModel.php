<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'question_id';
    protected $table = 'questions'; // İlgili tablo adı
    protected $fillable = [
        'test_ID ',
        'common_text',
        'root_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'option_true',
        'parameter_a',
        'parameter_b',
        'parameter_c',
        'parameter_d',
        'use_rate',
        'learning_out_comes',
        'cognitive_id',
        'is_active',
        'text_synthesize',
        'try_question',
        'module'
    ];
    public function get_test()
    {
        return $this->belongsTo(Test::class, 'test_ID');
    }
    public function get_out_comes()
    {
        return $this->belongsTo(LearningOutcomeModel::class, 'learning_out_comes');
    }
    public function get_cognitive()
    {
        return $this->belongsTo(CognitiveModel::class, 'cognitive_id');
    }

}
