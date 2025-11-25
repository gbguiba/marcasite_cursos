<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Profile extends Model {

    use HasFactory, HasUuids;

    protected $table = 'profiles';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'ip', 'user_agent', 'name', 'photo', 'cpf',
    ];

    public function user(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id', 'id');

    }

}
