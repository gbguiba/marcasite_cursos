<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Enrollment extends Model {

    use HasFactory, HasUuids;

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

    public function payments(): HasMany {
        
        return $this->hasMany(Payment::class, 'enrollment_id', 'id');

    }

}
