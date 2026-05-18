<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voteable_id',
        'voteable_type',
        'value',
    ];

    /**
     * Get the user who cast this vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent voteable model (Question or Answer).
     */
    public function voteable()
    {
        return $this->morphTo();
    }
}
