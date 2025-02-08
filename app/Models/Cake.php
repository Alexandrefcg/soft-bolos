<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Cake create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cake find($id, $columns = ['*'])
 */
class Cake extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
        'value',
        'quantity',
    ];

    public function interestedEmails(): HasMany
    {
        return $this->hasMany(InterestedEmail::class);
    }
}
