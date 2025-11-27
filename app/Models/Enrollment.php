<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model {

    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'enrollments';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'user_id', 'course_id', 'method', 'currency', 'transaction_amount',
        'idempotency_key', 'pix_email', 'pix_expiration',
    ];

    public function user(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function course(): BelongsTo {
        
        return $this->belongsTo(Course::class, 'course_id', 'id');
    
    }

}
