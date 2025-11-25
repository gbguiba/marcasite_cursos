<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CourseCategory extends Model {

    use HasFactory, HasUuids;

    protected $table = 'course_categories';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'name', 'active',
    ];

    public function courses(): HasMany {

        return $this->hasMany(Course::class, 'course_category_id', 'id');

    }

}
