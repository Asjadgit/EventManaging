<?php

namespace Asjad\Admin\Controllers\Events;

use App\Http\Controllers\Controller;

class EventCategoryController extends Controller
{
    public function index()
    {
        return view('admin::Events.Categories.index');
    }
}
