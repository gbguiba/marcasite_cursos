<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model {

    use HasFactory;

    protected $table = 'course_categories';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function courses(): HasMany {

        return $this->hasMany(Course::class, 'course_category_id', 'id');

    }

}
