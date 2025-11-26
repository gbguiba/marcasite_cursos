<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CourseMaterial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {

    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'courses';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'name', 'price', 'places', 'registration_start', 'registration_end',
        'description', 'thumbnail', 'active', 'course_category_id',
    ];

    public function courseCategory(): BelongsTo {

        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');

    }

    public function courseMaterials(): HasMany {
        
        return $this->hasMany(CourseMaterial::class, 'course_id', 'id');

    }

    public function enrollments(): HasMany {

        return $this->hasMany(Enrollment::class, 'course_id', 'id');

    }

}
