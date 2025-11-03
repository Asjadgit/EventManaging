@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .serif {
            font-family: 'Playfair Display', serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
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

        /* Animation classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Floating animation */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating {
            animation: float 8s ease-in-out infinite;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glow effect */
        .glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        /* Hover effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Navbar scroll effect */
        .nav-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Section backgrounds */
        .section-bg {
            position: relative;
            overflow: hidden;
        }
        .section-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.03), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(236, 72, 153, 0.03), transparent 50%);
            z-index: -1;
        }

        /* Button animations */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-primary:hover::before {
            left: 100%;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        /* Portfolio card effects */
        .portfolio-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(to bottom, white, #f8fafc);
            overflow: hidden;
        }
        .portfolio-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        .portfolio-image {
            transition: transform 0.5s ease;
        }
        .portfolio-card:hover .portfolio-image {
            transform: scale(1.1);
        }
        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 24px;
        }
        .portfolio-card:hover .portfolio-overlay {
            opacity: 1;
        }

        /* Filter buttons */
        .filter-btn {
            transition: all 0.3s ease;
        }
        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            overflow-y: auto;
        }
        .modal-content {
            background: white;
            margin: 5% auto;
            width: 90%;
            max-width: 1000px;
            border-radius: 16px;
            overflow: hidden;
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Gallery grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
    </style>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full floating"></div>
        <div class="absolute top-1/3 right-20 w-16 h-16 bg-indigo-500/20 rounded-full floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-purple-500/20 rounded-full floating" style="animation-delay: 4s;"></div>
        <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-pink-500/10 rounded-full floating" style="animation-delay: 1s;"></div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-light serif mb-6 leading-tight">
                    Our <span class="font-semibold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">Portfolio</span>
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Explore our collection of extraordinary events, from intimate weddings to grand corporate galas. Each celebration tells a unique story.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#portfolio" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                        View Our Work
                        <i class="fas fa-arrow-down ml-2 transform group-hover:translate-y-1 transition-transform"></i>
                    </a>
                    <a href="contact.html" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/5 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="fas fa-video mr-2"></i>
                        Watch Showreel
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Filter -->
    <section id="portfolio" class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="filter-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300 active" data-filter="all">
                    All Events
                </button>
                <button class="filter-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-filter="wedding">
                    <i class="fas fa-ring mr-2"></i>
                    Weddings
                </button>
                <button class="filter-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-filter="corporate">
                    <i class="fas fa-briefcase mr-2"></i>
                    Corporate
                </button>
                <button class="filter-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-filter="social">
                    <i class="fas fa-glass-cheers mr-2"></i>
                    Social Events
                </button>
                <button class="filter-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-filter="destination">
                    <i class="fas fa-map-marked-alt mr-2"></i>
                    Destination
                </button>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Wedding Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="wedding">
                    <div class="h-80 bg-gradient-to-br from-amber-100 to-orange-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-amber-100 to-orange-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Tuscan Villa Wedding</h3>
                                <p class="text-gray-200">An intimate celebration in the heart of Italian countryside</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="1">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Luxury Wedding</span>
                            <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full">Tuscany, Italy</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Tuscan Villa Celebration</h3>
                        <p class="text-gray-600 mb-4">An intimate wedding experience with 120 guests at a historic Italian villa</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>June 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Corporate Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="corporate" style="transition-delay: 0.1s;">
                    <div class="h-80 bg-gradient-to-br from-blue-100 to-cyan-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-blue-100 to-cyan-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Manhattan Skyline Gala</h3>
                                <p class="text-gray-200">Premium corporate event with panoramic city views</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="2">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Corporate Gala</span>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">New York, USA</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Manhattan Skyline Gala</h3>
                        <p class="text-gray-600 mb-4">Annual corporate celebration for 300 guests with keynote speakers</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>October 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Destination Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="destination" style="transition-delay: 0.2s;">
                    <div class="h-80 bg-gradient-to-br from-green-100 to-emerald-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-green-100 to-emerald-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Bali Wellness Retreat</h3>
                                <p class="text-gray-200">Transformative experience in tropical paradise</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="3">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Wellness Retreat</span>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Bali, Indonesia</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Bali Wellness Retreat</h3>
                        <p class="text-gray-600 mb-4">Corporate wellness retreat for 80 participants with daily mindfulness sessions</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>March 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Social Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="social" style="transition-delay: 0.3s;">
                    <div class="h-80 bg-gradient-to-br from-purple-100 to-pink-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-purple-100 to-pink-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Golden Anniversary Celebration</h3>
                                <p class="text-gray-200">50 years of love and commitment</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="4">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Anniversary</span>
                            <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">Paris, France</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Golden Anniversary Celebration</h3>
                        <p class="text-gray-600 mb-4">Intimate 50th anniversary celebration for family and close friends</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>July 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Wedding Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="wedding" style="transition-delay: 0.4s;">
                    <div class="h-80 bg-gradient-to-br from-rose-100 to-pink-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-rose-100 to-pink-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Santorini Sunset Wedding</h3>
                                <p class="text-gray-200">Breathtaking ceremony overlooking the Aegean Sea</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="5">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Destination Wedding</span>
                            <span class="text-xs bg-rose-100 text-rose-800 px-2 py-1 rounded-full">Santorini, Greece</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Santorini Sunset Wedding</h3>
                        <p class="text-gray-600 mb-4">Intimate destination wedding with 60 guests at a cliffside venue</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>September 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Corporate Portfolio Item -->
                <div class="portfolio-card rounded-2xl shadow-sm border border-gray-100 fade-in" data-category="corporate" style="transition-delay: 0.5s;">
                    <div class="h-80 bg-gradient-to-br from-indigo-100 to-purple-200 relative overflow-hidden">
                        <div class="portfolio-image w-full h-full bg-gradient-to-br from-indigo-100 to-purple-200"></div>
                        <div class="portfolio-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-semibold mb-2">Tech Product Launch</h3>
                                <p class="text-gray-200">Innovative unveiling with immersive experiences</p>
                                <button class="mt-4 text-white border border-white/30 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors view-details" data-project="6">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Product Launch</span>
                            <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">San Francisco, USA</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Tech Product Launch</h3>
                        <p class="text-gray-600 mb-4">Major technology product reveal for 500 industry professionals</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>November 2023</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 fade-in">
                <a href="contact.html" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center">
                    Start Your Project
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">By The Numbers</h2>
                <p class="text-gray-600 text-lg">Our portfolio showcases the breadth and depth of our event expertise</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">500+</p>
                    <p class="text-gray-600 mt-2">Events Completed</p>
                </div>
                <div class="fade-in" style="transition-delay: 0.1s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">40+</p>
                    <p class="text-gray-600 mt-2">Countries</p>
                </div>
                <div class="fade-in" style="transition-delay: 0.2s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">120+</p>
                    <p class="text-gray-600 mt-2">Weddings</p>
                </div>
                <div class="fade-in" style="transition-delay: 0.3s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">85+</p>
                    <p class="text-gray-600 mt-2">Corporate Events</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Testimonials -->
    <section class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Client Experiences</h2>
                <p class="text-gray-600 text-lg">Hear from clients who have experienced the Eventé difference</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 fade-in">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"Our Tuscan wedding was absolutely magical. Eventé handled every detail with such care and precision. We couldn't have dreamed of a more perfect day."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">SR</div>
                        <div>
                            <p class="font-semibold text-gray-900">Sophia & Ryan</p>
                            <p class="text-gray-500 text-sm">Tuscan Villa Wedding</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The corporate gala Eventé organized for us exceeded all expectations. Our clients were impressed, and the seamless execution made me look great!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">JR</div>
                        <div>
                            <p class="font-semibold text-gray-900">Jennifer Roberts</p>
                            <p class="text-gray-500 text-sm">Corporate Gala Client</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"Our Bali wellness retreat was transformative. Eventé's attention to detail and understanding of our company culture made it an unforgettable experience."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">MT</div>
                        <div>
                            <p class="font-semibold text-gray-900">Michael Thompson</p>
                            <p class="text-gray-500 text-sm">Corporate Retreat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-700 text-white relative overflow-hidden">
        <!-- Floating elements -->
        <div class="absolute top-10 right-10 w-24 h-24 bg-white/10 rounded-full floating"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-indigo-500/20 rounded-full floating" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 left-1/4 w-20 h-20 bg-pink-500/10 rounded-full floating" style="animation-delay: 1s;"></div>

        <!-- Background glow -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-light serif mb-6 fade-in">Ready to Create Your Masterpiece?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto fade-in">
                Let us transform your vision into an unforgettable event that will be remembered for years to come.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in">
                <a href="contact.html" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Start Planning
                </a>
                <a href="services.html" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                    <i class="fas fa-list-alt mr-2"></i>
                    View Services
                </a>
            </div>
        </div>
    </section>

    <!-- Project Detail Modals -->
    <div id="project-modal-1" class="modal">
        <div class="modal-content">
            <div class="close-modal">
                <i class="fas fa-times"></i>
            </div>
            <div class="grid md:grid-cols-2">
                <div class="h-96 bg-gradient-to-br from-amber-100 to-orange-200"></div>
                <div class="p-8">
                    <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Luxury Wedding</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mt-2 mb-4">Tuscan Villa Wedding</h2>
                    <p class="text-gray-600 mb-6">An intimate celebration in the heart of Italian countryside with 120 guests at a historic villa overlooking the rolling hills of Tuscany.</p>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Location</p>
                            <p class="font-medium">Tuscany, Italy</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="font-medium">June 2023</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Guests</p>
                            <p class="font-medium">120</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="font-medium">3 Days</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Services Provided</h3>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Full wedding planning and coordination
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Venue selection and booking
                        </li>
                        <li class="fas fa-check text-green-500 mr-2">
                            Vendor management and coordination
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Guest accommodation and transportation
                        </li>
                    </ul>

                    <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                        Plan Similar Event
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@pushOnce('scripts')
<script>
        // Scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            const slideLeftElements = document.querySelectorAll('.slide-in-left');
            const slideRightElements = document.querySelectorAll('.slide-in-right');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            fadeElements.forEach(element => {
                fadeInObserver.observe(element);
            });

            slideLeftElements.forEach(element => {
                fadeInObserver.observe(element);
            });

            slideRightElements.forEach(element => {
                fadeInObserver.observe(element);
            });

            // Portfolio filtering
            const filterBtns = document.querySelectorAll('.filter-btn');
            const portfolioItems = document.querySelectorAll('.portfolio-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    btn.classList.add('active');

                    const filterValue = btn.getAttribute('data-filter');

                    portfolioItems.forEach(item => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Modal functionality
            const viewDetailBtns = document.querySelectorAll('.view-details');
            const modals = document.querySelectorAll('.modal');
            const closeModalBtns = document.querySelectorAll('.close-modal');

            viewDetailBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const projectId = btn.getAttribute('data-project');
                    const modal = document.getElementById(`project-modal-${projectId}`);
                    if (modal) {
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    }
                });
            });

            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });
            });

            // Close modal when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) {
                    e.target.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('nav-scrolled');
                } else {
                    navbar.classList.remove('nav-scrolled');
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endPushOnce

@endsection

