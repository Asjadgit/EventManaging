<?php

namespace Asjad\Admin\Controllers\Events;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('admin::Events.events.index');
    }
}
