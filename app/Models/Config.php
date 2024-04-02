<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Config extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'bio',
        'banner_image',
        'color_primary',
        'color_secondary',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
