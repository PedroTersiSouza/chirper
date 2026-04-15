<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: Um Chirp pode ser curtido por muitos usuários.
     */
    public function likers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}