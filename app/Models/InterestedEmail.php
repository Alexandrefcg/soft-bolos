<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|InterestedEmail create(array $attributes = [])
 */
class InterestedEmail extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'cake_id'];

    public function cake(): BelongsTo
    {
        return $this->belongsTo(Cake::class);
    }
}
