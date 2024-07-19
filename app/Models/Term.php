<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $primaryKey = 'term_id';
    protected $table = 'terms';

    protected $fillable = [
        'term_year', 'term_name'
    ];
    public function tests()
    {
        return $this->hasMany(Test::class, 'term_id');
    }
}
