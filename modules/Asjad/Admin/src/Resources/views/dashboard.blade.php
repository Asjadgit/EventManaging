@extends('admin::layouts.app')

@section('content')
    <v-dashboard></v-dashboard>


    @pushOnce('scripts')
        <script type="text/x-template" id="v-dashboard-template">
            <div>
                <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="dashboard-card p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Events</p>
                            <p class="text-2xl font-bold text-gray-900">142</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-green-500 text-sm">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>12% increase</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-users text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Active Clients</p>
                            <p class="text-2xl font-bold text-gray-900">89</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-green-500 text-sm">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>5% increase</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-file-invoice-dollar text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Revenue</p>
                            <p class="text-2xl font-bold text-gray-900">$342,580</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-green-500 text-sm">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>18% increase</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-tasks text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pending Tasks</p>
                            <p class="text-2xl font-bold text-gray-900">24</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-red-500 text-sm">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>3 urgent</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Events -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Revenue Chart -->
                <div class="dashboard-card p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Revenue Overview</h2>
                        <div class="flex space-x-2">
                            <button class="tab-button active">Monthly</button>
                            <button class="tab-button">Quarterly</button>
                            <button class="tab-button">Yearly</button>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="dashboard-card p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Upcoming Events</h2>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            View All
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">Johnson Wedding</p>
                                <p class="text-sm text-gray-500">May 15, 2024 • 120 guests</p>
                            </div>
                            <span class="status-badge status-confirmed">Confirmed</span>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">TechCorp Conference</p>
                                <p class="text-sm text-gray-500">May 22, 2024 • 300 guests</p>
                            </div>
                            <span class="status-badge status-pending">Pending</span>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">Smith Anniversary</p>
                                <p class="text-sm text-gray-500">June 5, 2024 • 60 guests</p>
                            </div>
                            <span class="status-badge status-confirmed">Confirmed</span>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">Miller Product Launch</p>
                                <p class="text-sm text-gray-500">June 12, 2024 • 200 guests</p>
                            </div>
                            <span class="status-badge status-pending">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Events and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Events Table -->
                <div class="dashboard-card p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Events</h2>
                        <button id="addEventBtn"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-plus mr-1"></i>
                            Add Event
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-medium text-gray-900">Anderson Wedding</td>
                                    <td>Sarah Anderson</td>
                                    <td>Apr 28, 2024</td>
                                    <td>Wedding</td>
                                    <td><span class="status-badge status-completed">Completed</span></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-gray-900">Global Tech Summit</td>
                                    <td>Tech Innovations Inc.</td>
                                    <td>Apr 22, 2024</td>
                                    <td>Corporate</td>
                                    <td><span class="status-badge status-completed">Completed</span></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-gray-900">Williams Birthday</td>
                                    <td>Jennifer Williams</td>
                                    <td>Apr 15, 2024</td>
                                    <td>Social</td>
                                    <td><span class="status-badge status-completed">Completed</span></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-gray-900">Johnson Wedding</td>
                                    <td>Michael Johnson</td>
                                    <td>May 15, 2024</td>
                                    <td>Wedding</td>
                                    <td><span class="status-badge status-confirmed">Confirmed</span></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-gray-900">Davis Anniversary</td>
                                    <td>Robert Davis</td>
                                    <td>May 8, 2024</td>
                                    <td>Social</td>
                                    <td><span class="status-badge status-cancelled">Cancelled</span></td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h2>

                    <div class="space-y-4">
                        <button
                            class="w-full flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-plus text-blue-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-900">Add New Client</p>
                                <p class="text-sm text-gray-500">Create a new client profile</p>
                            </div>
                        </button>

                        <button
                            class="w-full flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-file-invoice text-green-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-900">Create Invoice</p>
                                <p class="text-sm text-gray-500">Generate a new invoice</p>
                            </div>
                        </button>

                        <button
                            class="w-full flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-tasks text-amber-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-900">Manage Tasks</p>
                                <p class="text-sm text-gray-500">View and assign tasks</p>
                            </div>
                        </button>

                        <button
                            class="w-full flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-chart-bar text-purple-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-900">View Reports</p>
                                <p class="text-sm text-gray-500">Generate business reports</p>
                            </div>
                        </button>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-medium text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-900">New event "Johnson Wedding" was added</p>
                                    <p class="text-xs text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-900">Invoice #INV-0428 was paid</p>
                                    <p class="text-xs text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-900">Task "Finalize venue" was completed</p>
                                    <p class="text-xs text-gray-500">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>

        </script>
    @endPushOnce


    @pushOnce('scripts')
        <script type="module">
            window.app.component('v-dashboard', {
                template: '#v-dashboard-template',
                mounted() {
                    // Sidebar Toggle
                    const sidebarToggle = document.getElementById('sidebarToggle');
                    if (sidebarToggle) {
                        sidebarToggle.addEventListener('click', function() {
                            const sidebar = document.querySelector('.sidebar');
                            const mainContent = document.querySelector('.main-content');

                            sidebar.classList.toggle('collapsed');
                            mainContent.classList.toggle('expanded');
                        });
                    }

                    // Modal Handling
                    const addEventBtn = document.getElementById('addEventBtn');
                    const addEventModal = document.getElementById('addEventModal');
                    const closeModal = document.getElementById('closeModal');
                    const cancelEvent = document.getElementById('cancelEvent');
                    const eventForm = document.getElementById('eventForm');
                    const notification = document.getElementById('notification');
                    const notificationText = document.getElementById('notificationText');

                    function openModal() {
                        addEventModal.style.display = 'flex';
                    }

                    function closeModalFunc() {
                        addEventModal.style.display = 'none';
                    }

                    function showNotification(message, type = 'success') {
                        notificationText.textContent = message;
                        notification.className = `notification ${type}`;
                        notification.classList.add('show');

                        setTimeout(() => {
                            notification.classList.remove('show');
                        }, 3000);
                    }

                    addEventBtn.addEventListener('click', openModal);
                    closeModal.addEventListener('click', closeModalFunc);
                    cancelEvent.addEventListener('click', closeModalFunc);

                    // Close modal when clicking outside
                    window.addEventListener('click', function(event) {
                        if (event.target === addEventModal) {
                            closeModalFunc();
                        }
                    });

                    // Form Submission
                    eventForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        // In a real application, you would send the form data to a server here
                        closeModalFunc();
                        showNotification('Event added successfully!', 'success');
                    });

                    // Revenue Chart
                    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                    const revenueChart = new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                'Nov',
                                'Dec'
                            ],
                            datasets: [{
                                label: 'Revenue',
                                data: [25000, 32000, 28000, 40000, 35000, 42000, 48000, 52000, 45000,
                                    55000,
                                    60000, 65000
                                ],
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        drawBorder: false
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    // Tab functionality
                    const tabButtons = document.querySelectorAll('.tab-button');
                    tabButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            tabButtons.forEach(btn => btn.classList.remove('active'));
                            this.classList.add('active');
                        });
                    });
                },

            })
        </script>
    @endPushOnce
@endsection
