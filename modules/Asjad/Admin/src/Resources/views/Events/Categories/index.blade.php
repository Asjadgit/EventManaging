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
                        @click="showModal()">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add New Category
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="mb-6 bg-white shadow rounded-lg border border-gray-200 p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex-1 min-w-0">
                        <div class="relative rounded-md shadow-sm max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" v-model="search" @keyup="searchFilter()" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search categories...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
                @if(isset($categories) && $categories->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Events Count</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="category in categoriesList"
                                :key="category.id"
                                class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-sm">
                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">@{{ category.name }}</div>
                                            <div class="text-xs text-gray-500">@{{ category.slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs">@{{ category.description || 'No description provided' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        @{{ category.events_count || 0 }} events
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">@{{ formatDate(category.created_at) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <button type="button" @click="showModal(category)"
                                         class="text-indigo-600 hover:text-indigo-900 inline-flex items-center text-sm font-medium">
                                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button type="button" @click="deleteCategory(category)"
                                         class="text-red-600 hover:text-red-900 inline-flex items-center text-sm font-medium">
                                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No categories found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first event category.</p>
                    <div class="mt-6">
                        <button type="button" @click="showModal()"
                         class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Category
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal -->
            <div v-if="modal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-black opacity-60 transition-opacity" aria-hidden="true"></div>

                    <!-- Modal panel -->
                    <div class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    @{{ mode === 'create' ? 'Create New Category' : 'Edit Category' }}
                                </h3>
                                <div class="mt-4">
                                    <form @submit.prevent="storeCategory" class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                            <input type="text" id="name" v-model="categories.name" required
                                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea id="description" v-model="categories.description" rows="3"
                                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="button" @click="storeCategory"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                @{{ mode === 'create' ? 'Create Category' : 'Update Category' }}
                            </button>
                            <button type="button" @click="closeModal"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
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
                        allCategories: @json($categories->toArray()),
                        categoriesList: @json($categories->toArray()),
                    }
                },
                methods: {
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
                            this.categories = {
                                ...category
                            };
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
                                    showToast(response.data.message, response.data.status); // ✅ global toast
                                    this.categoriesList.push(response.data
                                        .category); // add newly created category to list
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
                    deleteCategory(category) {
                        if (!confirm(
                                `Are you sure you want to delete "${category.name}"? This action cannot be undone.`))
                            return;

                        this.$axios.delete(`/admin/events/categories/${category.id}/delete`)
                            .then(response => {
                                showToast(response.data.message, response.data.status);

                                // Remove the item from categoriesList
                                this.categoriesList = this.categoriesList.filter(c => c.id !== category.id);
                            })
                            .catch(error => {
                                showToast('Failed to delete category', 'error');
                                console.error(error);
                            });

                    },
                    searchFilter() {
                        const s = this.search.toLowerCase();
                        // console.log(s);
                        this.categoriesList = this.allCategories.filter(category => category.name.toLowerCase()
                            .includes(s) ||
                            (category.description && category.description.toLowerCase().includes(s))
                        )
                    }
                },
            });
        </script>
    @endPushOnce
@endsection
