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

        /* Card hover effects */
        .team-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(to bottom, white, #f8fafc);
        }
        .team-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* Values icons */
        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
            font-size: 32px;
        }

        /* Timeline */
        .timeline {
            position: relative;
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            transform: translateX(-50%);
        }
        .timeline-item {
            position: relative;
            margin-bottom: 60px;
        }
        .timeline-item:nth-child(odd) {
            padding-right: 50%;
        }
        .timeline-item:nth-child(even) {
            padding-left: 50%;
        }
        .timeline-dot {
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
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
                    Our <span class="font-semibold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">Story</span>
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Crafting extraordinary experiences and unforgettable moments since 2010. Discover the passion and expertise behind Eventé.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#story" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                        Our Journey
                        <i class="fas fa-arrow-down ml-2 transform group-hover:translate-y-1 transition-transform"></i>
                    </a>
                    <a href="#team" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/5 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="fas fa-users mr-2"></i>
                        Meet Our Team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section id="story" class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-6">Our Humble Beginnings</h2>
                    <p class="text-gray-600 mb-6">Eventé was founded in 2010 by Isabella Rossi, who transformed her passion for creating beautiful moments into a premier event planning company. What started as a small boutique service has grown into an internationally recognized brand.</p>
                    <p class="text-gray-600 mb-8">Our journey began with a simple wedding in the Italian countryside, where we discovered our unique ability to blend traditional elegance with contemporary sophistication. Since then, we've expanded our expertise to encompass all types of celebrations while maintaining our commitment to exceptional quality.</p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="text-center p-4 bg-indigo-50 rounded-lg">
                            <p class="text-2xl font-bold text-indigo-600 serif">500+</p>
                            <p class="text-gray-600">Events Hosted</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <p class="text-2xl font-bold text-purple-600 serif">40+</p>
                            <p class="text-gray-600">Countries</p>
                        </div>
                        <div class="text-center p-4 bg-pink-50 rounded-lg">
                            <p class="text-2xl font-bold text-pink-600 serif">98%</p>
                            <p class="text-gray-600">Client Satisfaction</p>
                        </div>
                    </div>
                </div>
                <div class="fade-in">
                    <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-2xl p-8 h-full">
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Our Mission</h3>
                            <p class="text-gray-600 mb-6">To transform visions into extraordinary experiences through meticulous planning, creative design, and unparalleled attention to detail.</p>

                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Our Vision</h3>
                            <p class="text-gray-600">To be the world's most trusted event curation company, known for creating magical moments that last a lifetime.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Our Journey</h2>
                <p class="text-gray-600 text-lg">From a single wedding to international recognition - our story of growth and excellence</p>
            </div>

            <div class="timeline">
                <div class="timeline-item fade-in">
                    <div class="timeline-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="text-sm font-semibold text-indigo-600">2010</span>
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">The Beginning</h3>
                        <p class="text-gray-600">Eventé was founded with our first wedding in Tuscany, Italy. We discovered our passion for creating unforgettable moments.</p>
                    </div>
                </div>

                <div class="timeline-item fade-in" style="transition-delay: 0.1s;">
                    <div class="timeline-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="text-sm font-semibold text-indigo-600">2013</span>
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">Expansion</h3>
                        <p class="text-gray-600">We expanded our services to include corporate events and destination celebrations, growing our team to 10 dedicated professionals.</p>
                    </div>
                </div>

                <div class="timeline-item fade-in" style="transition-delay: 0.2s;">
                    <div class="timeline-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="text-sm font-semibold text-indigo-600">2016</span>
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">International Recognition</h3>
                        <p class="text-gray-600">Received the "Best Event Planning Company" award and expanded operations to three continents with offices in Europe, North America, and Asia.</p>
                    </div>
                </div>

                <div class="timeline-item fade-in" style="transition-delay: 0.3s;">
                    <div class="timeline-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="text-sm font-semibold text-indigo-600">2020</span>
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">Digital Transformation</h3>
                        <p class="text-gray-600">Launched our virtual event planning platform, allowing us to serve clients globally with innovative digital solutions.</p>
                    </div>
                </div>

                <div class="timeline-item fade-in" style="transition-delay: 0.4s;">
                    <div class="timeline-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="text-sm font-semibold text-indigo-600">2024</span>
                        <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-3">Present Day</h3>
                        <p class="text-gray-600">Now a team of 50+ experts, we've curated over 500 extraordinary events across 40+ countries, maintaining our 98% client satisfaction rate.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Our Values</h2>
                <p class="text-gray-600 text-lg">The principles that guide everything we do at Eventé</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center fade-in">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Passion</h3>
                    <p class="text-gray-600">We pour our hearts into every event, treating each celebration as if it were our own. Our genuine love for creating beautiful moments drives our excellence.</p>
                </div>

                <div class="text-center fade-in" style="transition-delay: 0.1s;">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Excellence</h3>
                    <p class="text-gray-600">We strive for perfection in every detail, from the grand vision to the smallest elements. Our commitment to quality ensures unforgettable experiences.</p>
                </div>

                <div class="text-center fade-in" style="transition-delay: 0.2s;">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Trust</h3>
                    <p class="text-gray-600">We build lasting relationships based on transparency, reliability, and mutual respect. Your vision and trust are the foundation of our partnership.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Meet Our Team</h2>
                <p class="text-gray-600 text-lg">The passionate professionals behind Eventé's extraordinary events</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="team-card p-6 rounded-2xl shadow-sm border border-gray-100 text-center fade-in">
                    <div class="w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-200 rounded-full mx-auto mb-4 flex items-center justify-center text-indigo-500 text-4xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">Isabella Rossi</h3>
                    <p class="text-indigo-600 font-medium mb-3">Founder & CEO</p>
                    <p class="text-gray-600 text-sm mb-4">With over 15 years in event planning, Isabella's vision and passion drive Eventé's commitment to excellence.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <div class="team-card p-6 rounded-2xl shadow-sm border border-gray-100 text-center fade-in" style="transition-delay: 0.1s;">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-100 to-teal-200 rounded-full mx-auto mb-4 flex items-center justify-center text-green-500 text-4xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">Marcus Chen</h3>
                    <p class="text-green-600 font-medium mb-3">Creative Director</p>
                    <p class="text-gray-600 text-sm mb-4">Marcus brings innovative design concepts and artistic vision to every event, ensuring visually stunning experiences.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="team-card p-6 rounded-2xl shadow-sm border border-gray-100 text-center fade-in" style="transition-delay: 0.2s;">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-200 rounded-full mx-auto mb-4 flex items-center justify-center text-blue-500 text-4xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">Sophia Williams</h3>
                    <p class="text-blue-600 font-medium mb-3">Operations Director</p>
                    <p class="text-gray-600 text-sm mb-4">Sophia ensures seamless execution of every event with her exceptional organizational skills and attention to detail.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <div class="team-card p-6 rounded-2xl shadow-sm border border-gray-100 text-center fade-in" style="transition-delay: 0.3s;">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-100 to-pink-200 rounded-full mx-auto mb-4 flex items-center justify-center text-purple-500 text-4xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">David Rodriguez</h3>
                    <p class="text-purple-600 font-medium mb-3">Client Relations Director</p>
                    <p class="text-gray-600 text-sm mb-4">David builds lasting relationships with our clients, ensuring their vision is understood and exceeded at every step.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 fade-in">
                <p class="text-gray-600 mb-6">Our team of 50+ event specialists includes designers, planners, coordinators, and technical experts dedicated to creating your perfect event.</p>
                <a href="contact.html" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center">
                    Join Our Team
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Client Love</h2>
                <p class="text-gray-600 text-lg">What our clients say about working with the Eventé team</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-2xl fade-in">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The Eventé team transformed our vision into a reality beyond our wildest dreams. Their attention to detail and creative approach made our wedding absolutely perfect."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mr-4 flex items-center justify-center text-white font-bold">AR</div>
                        <div>
                            <p class="font-semibold text-gray-900">Amanda Roberts</p>
                            <p class="text-gray-500 text-sm">Wedding Client</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl fade-in" style="transition-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"Working with Eventé for our corporate gala was a game-changer. Their professionalism and creativity elevated our event and impressed all our clients."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">TS</div>
                        <div>
                            <p class="font-semibold text-gray-900">Thomas Sullivan</p>
                            <p class="text-gray-500 text-sm">Corporate Client</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl fade-in" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The team's dedication to making our destination wedding perfect was incredible. They handled every detail seamlessly, allowing us to fully enjoy our special day."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-red-500 rounded-full mr-4 flex items-center justify-center text-white font-bold">MJ</div>
                        <div>
                            <p class="font-semibold text-gray-900">Maria & Javier</p>
                            <p class="text-gray-500 text-sm">Destination Wedding</p>
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
            <h2 class="text-3xl md:text-4xl font-light serif mb-6 fade-in">Ready to Create Magic Together?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto fade-in">
                Let our passionate team bring your vision to life with the expertise and care that has made Eventé a trusted name in event planning.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in">
                <a href="contact.html" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Start Planning
                </a>
                <a href="portfolio.html" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                    <i class="fas fa-images mr-2"></i>
                    View Our Work
                </a>
            </div>
        </div>
    </section>

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
@endsection

