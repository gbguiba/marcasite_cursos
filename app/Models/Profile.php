<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model {

    use HasFactory;

    protected $table = 'profiles';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function user(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id', 'id');

    }

}
