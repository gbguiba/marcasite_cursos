<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CourseMaterial;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model {

    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function courseCategory(): BelongsTo {

        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');

    }

    public function courseMaterial(): HasMany {
        
        return $this->hasMany(CourseMaterial::class, 'course_id', 'id');

    }

}
