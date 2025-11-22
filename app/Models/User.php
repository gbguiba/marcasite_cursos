<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Profile;

class User extends Model {

    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function profile(): HasOne {
        
        return $this->hasOne(Profile::class, 'user_id', 'id');
    
    }

}
