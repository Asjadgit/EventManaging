<?php

namespace Asjad\Admin\Controllers\Events;

use App\Http\Controllers\Controller;
use Asjad\Admin\Models\Category;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('events')->get();
        return view('admin::Events.Categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // Save category in DB
            $category = Category::create($data);

            // Add default counts to prevent errors in the UI
            $category->events_count = 0;
            $category->active_events_count = 0;

            return response()->json([
                'status'   => 'success',
                'message'  => 'Category Successfully Added!',
                'category' => $category,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $category = Category::find($id);
            $data = $request->all();

            $category->update($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'Category Successfully Updated!',
                'category' => $category,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            $category->delete();

            return response()->json([
                'status'   => 'success',
                'message'  => 'Category Successfully Deleted!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
