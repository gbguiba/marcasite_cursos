<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model {

    use HasUuids;

    protected $table = 'payments';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    public function enrollment(): BelongsTo {

        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');

    }

}
