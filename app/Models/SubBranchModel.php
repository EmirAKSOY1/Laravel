<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBranchModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'sub_branch_id';
    protected $table = 'sub_branches'; // İlgili tablo adı
    protected $fillable = ['sub_branch_id','sub_branch_name','branch_id']; // Doldurulabilir alanlar

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function learningOutcomes()
    {
        return $this->hasMany(LearningOutcomeModel::class,'sub_branch_id');
    }
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_sub_branches', 'sub_branch_id', 'test_id');
    }
}
