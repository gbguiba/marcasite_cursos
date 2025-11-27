<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseMaterial extends Model {

    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'course_materials';
    
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'name', 'description', 'path', 'course_id',
    ];

    public function course(): BelongsTo {

        return $this->belongsTo(Course::class, 'course_id', 'id');

    }

}
