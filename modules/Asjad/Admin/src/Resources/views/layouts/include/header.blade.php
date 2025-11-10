<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
            <p class="text-gray-500">Welcome back, {{ auth()->user()->name }}</p>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="p-2 text-gray-500 hover:text-gray-700 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bell"></i>
                </button>
                <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full"></span>
            </div>

            <div class="relative group">
                <button class="flex items-center space-x-2 p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        AR
                    </div>
                    <span>{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-gray-400"></i>
                </button>
                <div
                    class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
