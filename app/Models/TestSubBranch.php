<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubBranch extends Model
{
    protected $table = 'test_sub_branches';

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function subBranch()
    {
        return $this->belongsTo(SubBranch::class, 'sub_branch_id');
    }
}
