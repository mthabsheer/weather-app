<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lat',
        'lng',
        'status',
    ];

    /**
     * Scope a query to only include active cities.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', self::STATUS_ENABLED);
    }
}
