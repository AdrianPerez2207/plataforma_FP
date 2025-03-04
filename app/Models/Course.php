<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category',
        'duration',
        'status',
        'teacher_id',
    ];
    public function user()
    {
        return $this->belongsToMany(Registration::class, 'registrations', 'course_id', 'student_id');
    }
    public function teacher(): belongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function evaluation()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluations', 'course_id', 'student_id');
    }
    public function course_material(): hasMany
    {
        return $this->hasMany(Course_Material::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

}
