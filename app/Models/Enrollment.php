<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Course;

class Enrollment extends Model {

    use HasFactory;

    protected $table = 'enrollments';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function user(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function course(): BelongsTo {
        
        return $this->belongsTo(Course::class, 'course_id', 'id');
    
    }

}
