<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course_Material extends Model
{
    use HasFactory;
    protected $table = "course_materials";
    protected $fillable = [
        'course_id',
        'type',
        'url',
    ];

    public function course(): belongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
