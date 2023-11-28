<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static where(string $column, string $operator, mixed $value): \Illuminate\Database\Query\Builder
 * @method static find(mixed $primaryKeyValue)
 */
class Terms extends Model
{
    use HasFactory;

    protected $table = 'terms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'required_from',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'required_from' => 'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'terms_acceptance_log', 'terms_id', 'user_id');
    }
}
