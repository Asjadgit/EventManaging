<?php

namespace Asjad\Admin\Controllers\Events;

use App\Http\Controllers\Controller;
use Asjad\Admin\Models\Category;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('events')->paginate(10);
        return view('admin::Events.Categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            Category::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Category Successfully Added!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
