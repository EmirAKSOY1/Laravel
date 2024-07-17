<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;
    protected $table = 'class_levels'; // İlgili tablo adı
    protected $primaryKey = 'class_id';
    protected $fillable = ['class_id','class_type','class_level_name']; // Doldurulabilir alanlar

    public function branches()
    {
        return $this->hasMany(Branch::class, 'class_id');
    }
}
