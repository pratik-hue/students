<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class StudentInfo extends Model
{
    protected $table = 'students_infos';

    use HasFactory , HasApiTokens;
     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    protected $fillable = [
        'name',
        'email',
        'enrollment_number',
        'password',
        'qualification',
        'course',
        'contact_number',
        // Add other fields you want to be fillable during mass assignment
    ];
}
