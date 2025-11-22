<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CourseCategory;

class Course extends Model {

    protected $table = 'courses';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function courseCategory(): BelongsTo {

        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');

    }

}
