<?php

namespace Asjad\Admin\Controllers\Events;

use App\Http\Controllers\Controller;
use Asjad\Admin\Models\Category;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $query = Category::withCount('events');

        // Apply search if provided
        if($search = request()->get('search')){
            $query->where(function($q) use ($search){
                $q->where('name','LIKE',"%{$search}%")
                 ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $categories = $query->paginate(10)->withQueryString();
        // If AJAX request, return JSON instead of full blade
        if (request()->ajax()) {
        return response()->json([
            'data'          => $categories->items(),
            'current_page'  => $categories->currentPage(),
            'last_page'     => $categories->lastPage(),
            'pages'         => range(1, $categories->lastPage()),
            'next_page_url' => $categories->nextPageUrl(),
            'prev_page_url' => $categories->previousPageUrl(),
        ]);
    }
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

    public function update(Request $request, $id)
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
