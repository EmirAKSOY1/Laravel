<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningOutcomeModel extends Model
{

    protected $primaryKey = 'learning_outcomes_id';
    protected $table = 'learning_outcomes'; // İlgili tablo adı
    protected $fillable = ['learning_outcomes_id','learning_outcomes_name','sub_branch_id'];

    public function subBranch()
    {
        return $this->belongsTo(SubBranchModel::class, 'sub_branch_id');
    }
}
