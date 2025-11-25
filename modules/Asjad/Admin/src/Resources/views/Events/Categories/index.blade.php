@extends('admin::layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <v-events-categories></v-events-categories>
    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-events-categories-template">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900">Event Categories</h1>
                        <p class="mt-1 text-sm text-gray-600">Manage your event categories and organization</p>
                    </div>
                    <button type="button"
                            @click="showModal()"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Category
                    </button>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           v-model="search"
                           @input="searchFilter()"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Search categories...">
                </div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Events</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="category in categoriesList" :key="category.id" class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">@{{ category.name }}</div>
                                            <div class="text-xs text-gray-500">@{{ category.slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs truncate">@{{ category.description || 'No description' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        @{{ category.events_count || 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@{{ formatDate(category.created_at) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button type="button"
                                                @click="showModal(category)"
                                                class="text-blue-600 hover:text-blue-900 font-medium text-sm px-3 py-1 rounded-md hover:bg-blue-50 transition-colors duration-150">
                                            Edit
                                        </button>
                                        <button type="button"
                                                @click="deleteCategory(category)"
                                                class="text-red-600 hover:text-red-900 font-medium text-sm px-3 py-1 rounded-md hover:bg-red-50 transition-colors duration-150">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-3 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing @{{ pagination.from }} to @{{ pagination.to }} of @{{ pagination.total }} results
                        </div>
                        <div class="flex space-x-2">
                            <button v-if="pagination.prev_page_url"
                                    @click="fetchPage(pagination.current_page - 1)"
                                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                Previous
                            </button>
                            <button v-for="page in pagination.pages"
                                    :key="page"
                                    @click="fetchPage(page)"
                                    :class="page === pagination.current_page ? 'bg-blue-600 text-white' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'"
                                    class="px-3 py-1 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @{{ page }}
                            </button>
                            <button v-if="pagination.next_page_url"
                                    @click="fetchPage(pagination.current_page + 1)"
                                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                Next
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="categoriesList.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No categories</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first category.</p>
                    <div class="mt-6">
                        <button type="button"
                                @click="showModal()"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            New Category
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div v-if="modal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                @{{ mode === 'create' ? 'Create Category' : 'Edit Category' }}
                            </h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text"
                                           id="name"
                                           required
                                           name="name"
                                           v-model="categories.name"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="description"
                                              v-model="categories.description"
                                              rows="3"
                                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                            <button type="button"
                                    @click="storeCategory"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">
                                @{{ mode === 'create' ? 'Create' : 'Update' }}
                            </button>
                            <button type="button"
                                    @click="closeModal"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            window.app.component('v-events-categories', {
                template: '#v-events-categories-template',
                data() {
                    return {
                        modal: false,
                        mode: 'create',
                        search: '',
                        categories: {
                            id: null,
                            name: '',
                            description: '',
                        },
                        pagination: @json($categories),
                        allCategories: @json($categories->items()),
                        categoriesList: @json($categories->items()),
                    }
                },
                watch: {
                    search(newVal) {
                        if (newVal === "") {
                            this.fetchPage(1);
                        }
                    }
                },
                methods: {
                    debounce(func, delay) {
                        clearTimeout(this._debounceTimer);
                        this._debounceTimer = setTimeout(func, delay);
                    },
                    formatDate(dateString) {
                        if (!dateString) return '';
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    },
                    showModal(category = null) {
                        if (category) {
                            this.mode = 'edit';
                            this.categories = { ...category };
                        } else {
                            this.mode = 'create';
                            this.categories = {
                                id: null,
                                name: '',
                                description: ''
                            };
                        }
                        this.modal = true;
                    },
                    closeModal() {
                        this.modal = false;
                    },
                    refreshModal() {
                        this.categories.id = null;
                        this.categories.name = '';
                        this.categories.description = '';
                    },
                    storeCategory() {
                        if (this.mode === 'create') {
                            this.$axios.post('/admin/events/categories/store', this.categories)
                                .then(response => {
                                    showToast(response.data.message, response.data.status);
                                    this.categoriesList.push(response.data.category);
                                    this.closeModal();
                                    this.refreshModal();
                                })
                                .catch(error => {
                                    showToast('Failed to save category', 'error');
                                    console.error(error);
                                });
                        } else if (this.mode === 'edit') {
                            this.$axios.put(`/admin/events/categories/${this.categories.id}/update`, this.categories)
                                .then(response => {
                                    showToast(response.data.message, response.data.status);
                                    const index = this.categoriesList.findIndex(c => c.id === this.categories.id);
                                    if (index !== -1) {
                                        this.categoriesList[index] = response.data.category;
                                    }
                                    this.closeModal();
                                    this.refreshModal();
                                })
                                .catch(error => {
                                    showToast('Failed to save category', 'error');
                                    console.error(error);
                                });
                        }
                    },
                    fetchPage(page) {
                        let url = `/admin/events/categories?page=${page}`;
                        if (this.search.trim()) {
                            url += `&search=${encodeURIComponent(this.search)}`;
                        }
                        this.$axios.get(url)
                            .then(response => {
                                this.pagination = response.data;
                                this.categoriesList = response.data.data;
                            });
                    },
                    deleteCategory(category) {
                        if (!confirm(`Are you sure you want to delete "${category.name}"?`)) return;

                        this.$axios.delete(`/admin/events/categories/${category.id}/delete`)
                            .then(response => {
                                showToast(response.data.message, response.data.status);
                                this.categoriesList = this.categoriesList.filter(c => c.id !== category.id);
                            })
                            .catch(error => {
                                showToast('Failed to delete category', 'error');
                                console.error(error);
                            });
                    },
                    searchFilter() {
                        this.debounce(() => {
                            const search = this.search.trim();
                            let url = `/admin/events/categories?search=${encodeURIComponent(search)}`;
                            this.$axios.get(url)
                                .then(response => {
                                    this.pagination = response.data;
                                    this.categoriesList = response.data.data;
                                });
                        }, 400);
                    }
                },
            });
        </script>
    @endPushOnce
@endsection
