<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function visibleTo() {
        return $this->belongsToMany(User::class, 'visible_to', 'event_id', 'user_id');
    }
}
