<?php

namespace App\Trait;

use App\Contracts\IsNote;
use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasNotes
{
    /** @return MorphMany<IsNote> */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function addNote(string $content, Model $user = null, IsNote $parent = null): IsNote
    {
        return $this->notes()->create([
            'content' => $content,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent?->getKey(),
        ]);
    }
}