<?php

namespace Asjad\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'user_id',
        'category_id',
        'event_name',
        'event_date',
        'guest_count',
        'budget',
        'description',
        'status'
    ];
}
