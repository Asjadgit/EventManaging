@extends('layouts.app')

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
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-6 border border-white/20">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    <p class="text-indigo-200 font-semibold uppercase tracking-wider text-sm">Curated Experiences • Premium Service</p>
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-light serif mb-6 leading-tight">
                    Extraordinary <span class="font-semibold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">Events</span> Begin Here
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    From intimate weddings to grand galas, we transform your vision into unforgettable moments with precision and elegance.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#contact" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                        Start Planning Today
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#experiences" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/5 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="fas fa-play-circle mr-2"></i>
                        View Our Portfolio
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <a href="#stats" class="text-white/70 hover:text-white transition-colors duration-300 animate-bounce">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-16 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">500+</p>
                    <p class="text-gray-600 mt-2">Events Hosted</p>
                </div>
                <div class="fade-in p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300" style="transition-delay: 0.1s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">40+</p>
                    <p class="text-gray-600 mt-2">Countries</p>
                </div>
                <div class="fade-in p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300" style="transition-delay: 0.2s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">98%</p>
                    <p class="text-gray-600 mt-2">Client Satisfaction</p>
                </div>
                <div class="fade-in p-6 rounded-2xl hover:bg-gray-50 transition-all duration-300" style="transition-delay: 0.3s;">
                    <p class="text-3xl md:text-4xl font-bold text-gray-900 serif gradient-text">24/7</p>
                    <p class="text-gray-600 mt-2">Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Comprehensive Event Services</h2>
                <p class="text-gray-600 text-lg">End-to-end event planning and management for every occasion</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-ring text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Wedding Planning</h3>
                    <p class="text-gray-600">Complete wedding coordination from venue selection to day-of execution</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Venue selection & booking
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Vendor coordination
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Day-of coordination
                        </li>
                    </ul>
                    <a href="#" class="mt-6 text-blue-600 font-semibold hover:text-blue-800 inline-flex items-center group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.1s;">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-50 to-green-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-briefcase text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Corporate Events</h3>
                    <p class="text-gray-600">Professional event management for conferences, galas, and corporate retreats</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Conference planning
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Team building activities
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Corporate gala management
                        </li>
                    </ul>
                    <a href="#" class="mt-6 text-green-600 font-semibold hover:text-green-800 inline-flex items-center group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="service-card p-8 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.2s;">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl flex items-center justify-center mb-6 glow">
                        <i class="fas fa-glass-cheers text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Special Celebrations</h3>
                    <p class="text-gray-600">Birthdays, anniversaries, and milestone events crafted to perfection</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Theme development
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Entertainment booking
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Custom decor design
                        </li>
                    </ul>
                    <a href="#" class="mt-6 text-purple-600 font-semibold hover:text-purple-800 inline-flex items-center group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Carousel Section -->
    <section class="py-16 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Our Signature Events</h2>
                <p class="text-gray-600 text-lg">A glimpse into the extraordinary experiences we've created</p>
            </div>

            <div class="carousel-container fade-in">
                <div class="carousel-track" id="carouselTrack">
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
                        <div class="carousel-overlay">
                            <h3 class="text-2xl font-bold mb-2">Luxury Wedding Celebration</h3>
                            <p>An elegant evening celebration with 200 guests at a historic villa</p>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
                        <div class="carousel-overlay">
                            <h3 class="text-2xl font-bold mb-2">Corporate Gala Event</h3>
                            <p>Annual corporate gala with keynote speakers and award ceremony</p>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
                        <div class="carousel-overlay">
                            <h3 class="text-2xl font-bold mb-2">Product Launch Event</h3>
                            <p>Innovative product reveal with immersive experiences for media and clients</p>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1519677100203-a0e668c92439?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
                        <div class="carousel-overlay">
                            <h3 class="text-2xl font-bold mb-2">Charity Fundraiser</h3>
                            <p>Annual charity gala raising funds for children's education initiatives</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-nav">
                    <div class="carousel-dot active" data-index="0"></div>
                    <div class="carousel-dot" data-index="1"></div>
                    <div class="carousel-dot" data-index="2"></div>
                    <div class="carousel-dot" data-index="3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Experiences -->
    <section id="experiences" class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Signature Experiences</h2>
                <p class="text-gray-600 text-lg">Discover our most sought-after event packages</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 fade-in transform hover:-translate-y-2">
                    <div class="h-64 bg-gradient-to-br from-amber-100 to-orange-200 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-sm">Tuscany, Italy</p>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/90 text-gray-800 text-xs font-bold px-3 py-1 rounded-full">Popular</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Luxury Wedding</span>
                            <span class="text-lg font-bold text-gray-900">From $15,000</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-indigo-700 transition-colors">Tuscan Villa Celebration</h3>
                        <p class="text-gray-600 mb-4">An intimate wedding experience in the heart of Italian countryside</p>
                        <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center group">
                            Explore Package
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 fade-in transform hover:-translate-y-2" style="transition-delay: 0.1s;">
                    <div class="h-64 bg-gradient-to-br from-blue-100 to-cyan-200 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-sm">New York, USA</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Corporate</span>
                            <span class="text-lg font-bold text-gray-900">From $25,000</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-indigo-700 transition-colors">Manhattan Skyline Gala</h3>
                        <p class="text-gray-600 mb-4">Premium corporate event with panoramic city views</p>
                        <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center group">
                            Explore Package
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 fade-in transform hover:-translate-y-2" style="transition-delay: 0.2s;">
                    <div class="h-64 bg-gradient-to-br from-green-100 to-emerald-200 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-sm">Bali, Indonesia</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Retreat</span>
                            <span class="text-lg font-bold text-gray-900">From $8,000</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-indigo-700 transition-colors">Bali Wellness Retreat</h3>
                        <p class="text-gray-600 mb-4">Transformative wellness experience in tropical paradise</p>
                        <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center group">
                            Explore Package
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-white mb-4">Trusted by Visionaries</h2>
                <p class="text-gray-300 text-lg">What our clients say about their Eventé experience</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card bg-gray-800 p-8 rounded-2xl fade-in transform hover:-translate-y-2 transition-all duration-500">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 italic">"Eventé transformed our corporate summit from logistical chaos into a seamless, elevated experience. Every detail was handled with grace."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mr-4 flex items-center justify-center text-white font-bold">EM</div>
                        <div>
                            <p class="font-semibold">Elena Martinez</p>
                            <p class="text-gray-400 text-sm">Global Events Director</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card bg-gray-800 p-8 rounded-2xl fade-in transform hover:-translate-y-2 transition-all duration-500" style="transition-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 italic">"Our destination wedding in Santorini was flawless. The vendor curation alone was worth every penny. Highly recommended!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-red-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">JC</div>
                        <div>
                            <p class="font-semibold">James & Priya Chen</p>
                            <p class="text-gray-400 text-sm">Married in 2024</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card bg-gray-800 p-8 rounded-2xl fade-in transform hover:-translate-y-2 transition-all duration-500" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-300 mb-6 italic">"The attention to detail and professional service made our product launch an incredible success. Eventé delivers excellence."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">MR</div>
                        <div>
                            <p class="font-semibold">Michael Rodriguez</p>
                            <p class="text-gray-400 text-sm">Tech Startup CEO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" class="py-20 bg-gradient-to-r from-indigo-600 to-purple-700 text-white relative overflow-hidden">
        <!-- Floating elements -->
        <div class="absolute top-10 right-10 w-24 h-24 bg-white/10 rounded-full floating"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-indigo-500/20 rounded-full floating" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 left-1/4 w-20 h-20 bg-pink-500/10 rounded-full floating" style="animation-delay: 1s;"></div>

        <!-- Background glow -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-light serif mb-6 fade-in">Ready to Create Magic?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto fade-in">
                Let's discuss your vision and bring your extraordinary event to life
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in">
                <a href="#" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
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


@endsection
