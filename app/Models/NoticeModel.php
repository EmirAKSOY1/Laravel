<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
    use HasFactory;
    protected $table = 'notices'; // Doğru tablo adı
    protected $fillable = ['title', 'content'];
}
