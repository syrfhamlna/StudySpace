<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'subject',
        'level',
        'instructor',
        'description',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
