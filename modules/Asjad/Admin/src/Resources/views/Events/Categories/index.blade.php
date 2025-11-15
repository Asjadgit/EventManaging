@extends('admin::layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <v-events-categories></v-events-categories>
    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-events-categories-template">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Event Categories</h1>
                <p class="mt-1 text-sm text-gray-500">Manage and organize your event categories</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button type="button" class="inline-flex cursor-pointer items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="showModal()"
                >
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Category
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Categories</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $totalCategories ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Events</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $activeEventsCount ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Most Popular</dt>
                            <dd class="text-sm font-medium text-gray-900 truncate">{{ $mostPopularCategory ?? 'N/A' }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="mb-6 bg-white shadow rounded-lg p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex-1 min-w-0">
                <div class="relative rounded-md shadow-sm max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search categories...">
                </div>
            </div>
            <div class="flex space-x-3">
                <button id="sort-by-name" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                    </svg>
                    Sort by Name
                </button>
                <button id="sort-by-events" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                    </svg>
                    Sort by Events
                </button>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        @if(isset($categories) && $categories->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 p-6">
            @foreach($categories as $category)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $category->events_count ?? 0 }} events</p>
                            </div>
                        </div>
                        <div class="relative">
                            <button type="button" class="category-actions inline-flex items-center p-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-category-id="{{ $category->id }}">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown-{{ $category->id }}" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                <div class="py-1" role="menu" aria-orientation="vertical">
                                    <a href="{{ route('admin.events.categories.show', $category->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Details
                                    </a>
                                    <a href="{{ route('admin.events.categories.edit', $category->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit Category
                                    </a>
                                    <form action="{{ route('admin.events.categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100" role="menuitem" onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                                            <svg class="mr-3 h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete Category
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                        {{ $category->description ?? 'No description provided.' }}
                    </p>

                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Created: {{ $category->created_at->format('M d, Y') }}</span>
                        <span>Updated: {{ $category->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 px-6 py-3 bg-gray-50 rounded-b-lg">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Active events in this category</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $category->active_events_count ?? 0 }} active
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No categories</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first event category.</p>
        </div>
        @endif
    </div>

            <!-- Modal -->
    <div v-if="modal" id="modal" class="fixed inset-0 z-50" aria-hidden="true" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="backdrop" class="absolute inset-0 bg-black/50"></div>

        <!-- Panel -->
        <div class="relative mx-auto my-8 max-w-lg w-11/12">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between">
                <h3 class="text-lg font-medium text-gray-900">Add New Category</h3>
                <button @click="closeModal()" id="closeBtn" class="text-gray-400 hover:text-gray-600" aria-label="Close">
                    ✕
                </button>
                </div>

                <form id="modalForm" class="mt-4 space-y-4" onsubmit="submitForm(event)">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 p-2" />
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="message" name="message" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <button @click="closeModal()" type="button" id="cancelBtn" class="px-4 py-2 rounded-md border">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>

    <!-- Pagination -->
    @if(isset($categories) && $categories->hasPages())
    <div class="mt-6 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $categories->firstItem() ?? 0 }}</span>
                    to
                    <span class="font-medium">{{ $categories->lastItem() ?? 0 }}</span>
                    of
                    <span class="font-medium">{{ $categories->total() }}</span>
                    categories
                </p>
            </div>
            <div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    @endif
</script>

        <script type="module">
            window.app.component('v-events-categories', {
                template: '#v-events-categories-template',
                data() {
                    return {
                        modal: false,
                    }
                },
                methods: {
                    showModal() {
                        this.modal = true;
                    },
                    closeModal() {
                        this.modal = false;
                    }
                },
            })
        </script>
    @endPushOnce
@endsection
