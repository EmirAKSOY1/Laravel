<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $primaryKey = 'branch_id';
    protected $table = 'branches'; // İlgili tablo adı
    protected $fillable = ['branch_id','branch_name','class_id']; // Doldurulabilir alanlar

    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_id');
    }

    public function subBranches()
    {
        return $this->hasMany(SubBranchModel::class, 'branch_id');
    }
}
