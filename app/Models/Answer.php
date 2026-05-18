<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'body',
        'is_accepted',
    ];

    protected function casts(): array
    {
        return [
            'is_accepted' => 'boolean',
        ];
    }

    /**
     * Get the question this answer belongs to.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the user who submitted this answer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all votes on this answer (polymorphic).
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * Get all comments on this answer (polymorphic).
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Calculate the total vote score for this answer.
     */
    public function getVoteScoreAttribute(): int
    {
        return $this->votes()->sum('value');
    }
}
