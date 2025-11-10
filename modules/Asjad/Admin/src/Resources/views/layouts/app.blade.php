<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Eventé</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #f59e0b;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .serif {
            font-family: 'Playfair Display', serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--primary-dark), var(--secondary));
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 70px;
        }

        /* Cards */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Table styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            background-color: #f8fafc;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
        }
        .data-table tr:hover {
            background-color: #f9fafb;
        }

        /* Status badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        .status-confirmed {
            background-color: #d1fae5;
            color: #059669;
        }
        .status-completed {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Tabs */
        .tab-button {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .tab-button.active {
            background-color: var(--primary);
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            z-index: 1200;
            transform: translateX(150%);
            transition: transform 0.3s ease;
        }
        .notification.show {
            transform: translateX(0);
        }
        .notification.success {
            border-left: 4px solid #10b981;
        }
        .notification.error {
            border-left: 4px solid #ef4444;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    @include('admin::layouts.include.sidebar')

    <!-- Main Content -->
    <div class="main-content min-h-screen">
        <!-- Top Bar -->
        @include('admin::layouts.include.header')

        <!-- Dashboard Content -->
        <div class="p-6">
            @yield('content')
        </div>
    </div>

    <!-- Add Event Modal -->
    <div id="addEventModal" class="modal">
        <div class="modal-content">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Add New Event</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form id="eventForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">Event Name</label>
                            <input type="text" class="form-input" placeholder="Enter event name" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Client</label>
                            <select class="form-input" required>
                                <option value="">Select a client</option>
                                <option value="1">Sarah Anderson</option>
                                <option value="2">Michael Johnson</option>
                                <option value="3">Tech Innovations Inc.</option>
                                <option value="4">Jennifer Williams</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Event Date</label>
                            <input type="date" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Event Type</label>
                            <select class="form-input" required>
                                <option value="">Select event type</option>
                                <option value="wedding">Wedding</option>
                                <option value="corporate">Corporate</option>
                                <option value="social">Social</option>
                                <option value="destination">Destination</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Guest Count</label>
                            <input type="number" class="form-input" placeholder="Estimated guest count" min="1">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Budget</label>
                            <input type="text" class="form-input" placeholder="Estimated budget">
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-input" rows="3" placeholder="Event description and requirements"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" id="cancelEvent" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                            Save Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="notification">
        <i class="fas fa-check-circle mr-2 text-green-500"></i>
        <span id="notificationText">Event added successfully!</span>
    </div>

    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

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
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue',
                    data: [25000, 32000, 28000, 40000, 35000, 42000, 48000, 52000, 45000, 55000, 60000, 65000],
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
    </script>
</body>
</html>
