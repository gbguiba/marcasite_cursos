<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

    use HasFactory, SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function profile(): HasOne {
        
        return $this->hasOne(Profile::class, 'user_id', 'id');
    
    }

    public function enrollments(): HasMany {

        return $this->hasMany(Enrollment::class, 'user_id', 'id');

    }

}
