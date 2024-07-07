<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateModel extends Model
{
    use HasFactory;
    protected $table = 'candidates';

    protected $fillable = [
        'user_id', 'birthdate', 'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function organisationLevel()
    {
        return $this->belongsTo(OrganisationLevel::class, 'organisation_level_id');
    }
    public function roleUser()
    {
        return $this->hasOne(UserRol::class);
    }
}
