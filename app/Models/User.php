<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'type', 'email', 'password', 'active',
    ];

    public function profile(): HasOne {
        
        return $this->hasOne(Profile::class, 'user_id', 'id');
    
    }

    public function enrollments(): HasMany {

        return $this->hasMany(Enrollment::class, 'user_id', 'id');

    }

    protected function password(): Attribute {

        return Attribute::make(

            set: function(string $value) {

                return bcrypt($value);

            }
        );

    }

}
