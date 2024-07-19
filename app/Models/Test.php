<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $primaryKey = 'test_id';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function subBranches()
    {
        return $this->belongsToMany(SubBranchModel::class, 'test_sub_branches', 'test_id', 'sub_branch_id');
    }
}
