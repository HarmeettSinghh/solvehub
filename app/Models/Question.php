<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
        'tags',
        'views_count',
        'is_solved',
    ];

    protected function casts(): array
    {
        return [
            'is_solved' => 'boolean',
        ];
    }

    /**
     * Get the user who asked this question.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of this question.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all answers for this question.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get all votes on this question (polymorphic).
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * Get all comments on this question (polymorphic).
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Calculate the total vote score for this question.
     */
    public function getVoteScoreAttribute(): int
    {
        return $this->votes()->sum('value');
    }

    /**
     * Parse comma-separated tags into an array.
     */
    public function getTagsArrayAttribute(): array
    {
        if (empty($this->tags)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Get the accepted answer if one exists.
     */
    public function acceptedAnswer()
    {
        return $this->hasOne(Answer::class)->where('is_accepted', true);
    }

    /**
     * Scope: search questions by title or body.
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('body', 'like', "%{$term}%")
              ->orWhere('tags', 'like', "%{$term}%");
        });
    }

    /**
     * Scope: filter by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
