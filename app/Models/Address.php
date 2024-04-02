<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'zip_code',
        'public_place',
        'complement',
        'neighborhood',
        'locality',
        'uf'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
