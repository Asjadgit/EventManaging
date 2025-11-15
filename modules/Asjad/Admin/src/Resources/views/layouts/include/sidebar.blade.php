<div class="sidebar fixed h-screen overflow-y-auto">
    <div class="p-6">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-2 rounded-lg mr-3">
                    <i class="fas fa-crown"></i>
                </div>
                <span class="logo-text text-white text-xl font-bold serif">Eventé</span>
            </div>
            <button id="sidebarToggle" class="text-gray-400 hover:text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-indigo-700' : 'text-gray-300 hover:bg-gray-800' }} rounded-lg">
                <i class="fas fa-chart-pie mr-3"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.events.index') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs(['admin.events.*', 'admin.events.categories.*'])
                    ? 'text-white bg-indigo-700'
                    : 'text-gray-300 hover:bg-gray-800' }}
          rounded-lg transition-colors">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span class="sidebar-text">Events</span>
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 rounded-lg transition-colors">
                <i class="fas fa-users mr-3"></i>
                <span class="sidebar-text">Clients</span>
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 rounded-lg transition-colors">
                <i class="fas fa-file-invoice-dollar mr-3"></i>
                <span class="sidebar-text">Invoices</span>
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 rounded-lg transition-colors">
                <i class="fas fa-tasks mr-3"></i>
                <span class="sidebar-text">Tasks</span>
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 rounded-lg transition-colors">
                <i class="fas fa-cog mr-3"></i>
                <span class="sidebar-text">Settings</span>
            </a>
        </nav>
    </div>

    <div class="absolute bottom-0 w-full p-6 border-t border-gray-700">
        <div class="flex items-center">
            <div
                class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                AR
            </div>
            <div class="sidebar-text">
                <p class="text-white font-medium">{{ auth()->user()->name }}</p>
                <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</div>
