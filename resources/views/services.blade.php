@extends('layouts.app')
<style>
    /* Card hover effects */
    .service-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: linear-gradient(to bottom, white, #f8fafc);
    }

    .service-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    /* Process steps */
    .process-step {
        position: relative;
    }

    .process-step::after {
        content: '';
        position: absolute;
        top: 40px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        z-index: 0;
    }

    .process-step:last-child::after {
        display: none;
    }

    /* Tab system */
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .tab-btn.active {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }
</style>
@section('content')
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
                    Our <span class="font-semibold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">Services</span>
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Comprehensive event planning solutions tailored to your vision, from intimate gatherings to grand celebrations.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#services" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                        Explore Services
                        <i class="fas fa-arrow-down ml-2 transform group-hover:translate-y-1 transition-transform"></i>
                    </a>
                    <a href="contact.html" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/5 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Book Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section id="services" class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Comprehensive Event Solutions</h2>
                <p class="text-gray-600 text-lg">We offer end-to-end event planning services tailored to your unique vision and requirements</p>
            </div>

            <!-- Services Tabs -->
            <div class="mb-16">
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    <button class="tab-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300 active" data-tab="weddings">
                        <i class="fas fa-ring mr-2"></i>
                        Weddings
                    </button>
                    <button class="tab-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-tab="corporate">
                        <i class="fas fa-briefcase mr-2"></i>
                        Corporate Events
                    </button>
                    <button class="tab-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-tab="social">
                        <i class="fas fa-glass-cheers mr-2"></i>
                        Social Events
                    </button>
                    <button class="tab-btn bg-white border border-gray-200 px-6 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-300" data-tab="destination">
                        <i class="fas fa-map-marked-alt mr-2"></i>
                        Destination Events
                    </button>
                </div>

                <!-- Wedding Services -->
                <div id="weddings" class="tab-content active">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <h3 class="text-2xl md:text-3xl font-light serif text-gray-900 mb-6">Elegant Wedding Planning</h3>
                            <p class="text-gray-600 mb-6">From intimate ceremonies to grand celebrations, we create unforgettable wedding experiences that reflect your unique love story.</p>

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-indigo-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Full Wedding Planning</h4>
                                        <p class="text-gray-600">Comprehensive planning from concept to execution</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-indigo-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Partial Planning</h4>
                                        <p class="text-gray-600">Assistance with specific aspects of your wedding</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-indigo-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Day-of Coordination</h4>
                                        <p class="text-gray-600">Ensuring flawless execution on your special day</p>
                                    </div>
                                </div>
                            </div>

                            <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                                Plan Your Wedding
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <div class="fade-in">
                            <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-2xl p-8 h-full">
                                <div class="bg-white rounded-xl p-6 shadow-lg">
                                    <h4 class="font-semibold text-gray-900 mb-4">Wedding Planning Packages</h4>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Full Planning Package</span>
                                            <span class="font-bold text-gray-900">From $5,000</span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Partial Planning Package</span>
                                            <span class="font-bold text-gray-900">From $2,500</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700">Day-of Coordination</span>
                                            <span class="font-bold text-gray-900">From $1,200</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 bg-amber-50 rounded-lg p-4">
                                        <p class="text-amber-800 text-sm flex items-center">
                                            <i class="fas fa-gift mr-2"></i>
                                            Complimentary engagement photo session included with full planning package
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Corporate Events -->
                <div id="corporate" class="tab-content">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <h3 class="text-2xl md:text-3xl font-light serif text-gray-900 mb-6">Professional Corporate Events</h3>
                            <p class="text-gray-600 mb-6">Elevate your corporate gatherings with our expert event management services designed to impress clients and motivate teams.</p>

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Conferences & Seminars</h4>
                                        <p class="text-gray-600">Professional event management for business gatherings</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Product Launches</h4>
                                        <p class="text-gray-600">Memorable unveilings that generate buzz and excitement</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Team Building Activities</h4>
                                        <p class="text-gray-600">Engaging experiences that strengthen company culture</p>
                                    </div>
                                </div>
                            </div>

                            <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                                Plan Corporate Event
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <div class="fade-in">
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-100 rounded-2xl p-8 h-full">
                                <div class="bg-white rounded-xl p-6 shadow-lg">
                                    <h4 class="font-semibold text-gray-900 mb-4">Corporate Event Packages</h4>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Conference Management</span>
                                            <span class="font-bold text-gray-900">From $8,000</span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Product Launch</span>
                                            <span class="font-bold text-gray-900">From $12,000</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700">Team Building</span>
                                            <span class="font-bold text-gray-900">From $3,500</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 bg-blue-50 rounded-lg p-4">
                                        <p class="text-blue-800 text-sm flex items-center">
                                            <i class="fas fa-chart-line mr-2"></i>
                                            ROI tracking and post-event analytics included with all corporate packages
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Events -->
                <div id="social" class="tab-content">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <h3 class="text-2xl md:text-3xl font-light serif text-gray-900 mb-6">Memorable Social Celebrations</h3>
                            <p class="text-gray-600 mb-6">Transform your special moments into unforgettable experiences with our personalized social event planning services.</p>

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Birthdays & Anniversaries</h4>
                                        <p class="text-gray-600">Personalized celebrations for life's milestones</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Graduation Parties</h4>
                                        <p class="text-gray-600">Celebrating academic achievements in style</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Holiday Gatherings</h4>
                                        <p class="text-gray-600">Festive events that bring people together</p>
                                    </div>
                                </div>
                            </div>

                            <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                                Plan Social Event
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <div class="fade-in">
                            <div class="bg-gradient-to-br from-purple-50 to-pink-100 rounded-2xl p-8 h-full">
                                <div class="bg-white rounded-xl p-6 shadow-lg">
                                    <h4 class="font-semibold text-gray-900 mb-4">Social Event Packages</h4>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Milestone Celebrations</span>
                                            <span class="font-bold text-gray-900">From $2,000</span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Themed Parties</span>
                                            <span class="font-bold text-gray-900">From $3,500</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700">Intimate Gatherings</span>
                                            <span class="font-bold text-gray-900">From $1,200</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 bg-purple-50 rounded-lg p-4">
                                        <p class="text-purple-800 text-sm flex items-center">
                                            <i class="fas fa-magic mr-2"></i>
                                            Custom theme development included with all social event packages
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destination Events -->
                <div id="destination" class="tab-content">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <h3 class="text-2xl md:text-3xl font-light serif text-gray-900 mb-6">Exotic Destination Events</h3>
                            <p class="text-gray-600 mb-6">Create unforgettable memories in breathtaking locations around the world with our destination event expertise.</p>

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-amber-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Destination Weddings</h4>
                                        <p class="text-gray-600">Say "I do" in paradise with our seamless planning</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-amber-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Corporate Retreats</h4>
                                        <p class="text-gray-600">Inspire your team in extraordinary locations</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <i class="fas fa-check text-amber-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Anniversary Celebrations</h4>
                                        <p class="text-gray-600">Renew your vows in a dream destination</p>
                                    </div>
                                </div>
                            </div>

                            <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                                Plan Destination Event
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <div class="fade-in">
                            <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-2xl p-8 h-full">
                                <div class="bg-white rounded-xl p-6 shadow-lg">
                                    <h4 class="font-semibold text-gray-900 mb-4">Destination Event Packages</h4>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">European Destinations</span>
                                            <span class="font-bold text-gray-900">From $15,000</span>
                                        </div>
                                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                            <span class="text-gray-700">Tropical Locations</span>
                                            <span class="font-bold text-gray-900">From $12,000</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700">Domestic Getaways</span>
                                            <span class="font-bold text-gray-900">From $8,000</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 bg-amber-50 rounded-lg p-4">
                                        <p class="text-amber-800 text-sm flex items-center">
                                            <i class="fas fa-plane mr-2"></i>
                                            Travel coordination and guest accommodations included with all destination packages
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Our Seamless Process</h2>
                <p class="text-gray-600 text-lg">From initial consultation to flawless execution, we guide you through every step</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="process-step text-center fade-in">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 relative z-10">1</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Discovery & Vision</h3>
                    <p class="text-gray-600">We learn about your vision, preferences, and requirements to create a customized plan.</p>
                </div>
                <div class="process-step text-center fade-in" style="transition-delay: 0.1s;">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 relative z-10">2</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Design & Planning</h3>
                    <p class="text-gray-600">We develop a comprehensive event design and detailed execution plan.</p>
                </div>
                <div class="process-step text-center fade-in" style="transition-delay: 0.2s;">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 relative z-10">3</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Coordination & Execution</h3>
                    <p class="text-gray-600">We manage all vendors and logistics to bring your vision to life seamlessly.</p>
                </div>
                <div class="text-center fade-in" style="transition-delay: 0.3s;">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">4</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Celebration & Follow-up</h3>
                    <p class="text-gray-600">We ensure your event is memorable and provide post-event support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Services -->
    <section class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Additional Services</h2>
                <p class="text-gray-600 text-lg">Enhance your event with our specialized add-on services</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-palette text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Event Design & Styling</h3>
                    <p class="text-gray-600 mb-4">Custom design concepts, decor selection, and styling to create a cohesive visual experience.</p>
                    <span class="text-blue-600 font-semibold">From $800</span>
                </div>

                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.1s;">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-50 to-green-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-utensils text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Catering Coordination</h3>
                    <p class="text-gray-600 mb-4">Menu planning, vendor selection, and dietary accommodation management.</p>
                    <span class="text-green-600 font-semibold">From $500</span>
                </div>

                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.2s;">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-music text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Entertainment Booking</h3>
                    <p class="text-gray-600 mb-4">Curated selection of musicians, DJs, performers, and other entertainment options.</p>
                    <span class="text-purple-600 font-semibold">From $300</span>
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
            <h2 class="text-3xl md:text-4xl font-light serif mb-6 fade-in">Ready to Create Your Perfect Event?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto fade-in">
                Let's discuss your vision and bring your extraordinary event to life with our premium planning services.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in">
                <a href="contact.html" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Schedule a Consultation
                </a>
                <a href="tel:+1-555-1234" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Call Us Now
                </a>
            </div>
        </div>
    </section>

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

                // Tab system
                const tabBtns = document.querySelectorAll('.tab-btn');
                const tabContents = document.querySelectorAll('.tab-content');

                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        // Remove active class from all buttons and contents
                        tabBtns.forEach(b => b.classList.remove('active'));
                        tabContents.forEach(c => c.classList.remove('active'));

                        // Add active class to clicked button
                        btn.classList.add('active');

                        // Show corresponding content
                        const tabId = btn.getAttribute('data-tab');
                        document.getElementById(tabId).classList.add('active');
                    });
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
                    anchor.addEventListener('click', function(e) {
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
