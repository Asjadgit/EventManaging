<?php

namespace Asjad\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'event_categories';

    protected $fillable = ['name','description'];
}
