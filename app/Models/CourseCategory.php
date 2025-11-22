<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Course;

class CourseCategory extends Model {

    protected $table = 'course_categories';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function courses(): HasMany {

        return $this->hasMany(Course::class, 'course_category_id', 'id');

    }

}
