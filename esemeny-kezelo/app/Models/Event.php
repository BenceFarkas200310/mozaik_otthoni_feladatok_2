<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'type',
        'date',
        'location',
        'description',
        'is_public',
        'author_id',
        'thumbnail'
    ];
    public function visibleTo() {
        return $this->belongsToMany(User::class, 'visible_to', 'event_id', 'user_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
