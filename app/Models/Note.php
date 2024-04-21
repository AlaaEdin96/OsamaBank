<?php

namespace App\Models;

use App\Contracts\IsNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Note extends Model implements IsNote
{
    use HasFactory;
    use SoftDeletes;
   
    
    protected $fillable = [
        'parent_id',
        'user_id',
        'notable',
        'content',

     ];
    
    
    //  protected $attributes = [
    //     'content' => Auth::id(),
    //  ];
    //protected $guarded = [];
    public function notes(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('notes.user'), 'user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
