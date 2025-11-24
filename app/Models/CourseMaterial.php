<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseMaterial extends Model {

    use HasFactory;

    protected $table = 'course_materials';
    
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function course(): BelongsTo {

        return $this->belongsTo(Course::class, 'course_id', 'id');

    }

}
