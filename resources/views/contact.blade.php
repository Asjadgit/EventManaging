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

        /* Contact card effects */
        .contact-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(to bottom, white, #f8fafc);
        }
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Map placeholder */
        .map-placeholder {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            height: 100%;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-direction: column;
        }

        /* Success message */
        .success-message {
            display: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
                    Let's <span class="font-semibold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">Connect</span>
                </h1>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Ready to bring your vision to life? Get in touch with our team to start planning your extraordinary event.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#contact-form" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                        Send Message
                        <i class="fas fa-arrow-down ml-2 transform group-hover:translate-y-1 transition-transform"></i>
                    </a>
                    <a href="tel:+1-555-1234" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/5 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Methods -->
    <section class="py-20 bg-white section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Get In Touch</h2>
                <p class="text-gray-600 text-lg">Multiple ways to connect with our event planning experts</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="contact-card p-8 rounded-2xl shadow-sm border border-gray-100 text-center fade-in">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto glow">
                        <i class="fas fa-phone-alt text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Call Us</h3>
                    <p class="text-gray-600 mb-4">Speak directly with our event consultants</p>
                    <a href="tel:+1-555-1234" class="text-blue-600 font-semibold hover:text-blue-800 inline-flex items-center">
                        +1 (555) 123-4567
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    <p class="text-gray-500 text-sm mt-2">Mon-Fri: 9AM-6PM EST</p>
                </div>

                <div class="contact-card p-8 rounded-2xl shadow-sm border border-gray-100 text-center fade-in" style="transition-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-50 to-green-100 rounded-full flex items-center justify-center mb-6 mx-auto glow">
                        <i class="fas fa-envelope text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Email Us</h3>
                    <p class="text-gray-600 mb-4">Send us your inquiries and event details</p>
                    <a href="mailto:hello@evente.com" class="text-green-600 font-semibold hover:text-green-800 inline-flex items-center">
                        hello@evente.com
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    <p class="text-gray-500 text-sm mt-2">Response within 24 hours</p>
                </div>

                <div class="contact-card p-8 rounded-2xl shadow-sm border border-gray-100 text-center fade-in" style="transition-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto glow">
                        <i class="fas fa-calendar-check text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Book Consultation</h3>
                    <p class="text-gray-600 mb-4">Schedule a personalized planning session</p>
                    <a href="#consultation" class="text-purple-600 font-semibold hover:text-purple-800 inline-flex items-center">
                        Schedule Now
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    <p class="text-gray-500 text-sm mt-2">Virtual or in-person options</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section id="contact-form" class="py-20 bg-gray-50 section-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="fade-in">
                    <h2 class="text-3xl font-light serif text-gray-900 mb-6">Send Us a Message</h2>
                    <p class="text-gray-600 mb-8">Tell us about your event vision and we'll get back to you with a customized proposal.</p>

                    <div id="success-message" class="success-message">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Thank you! Your message has been sent successfully.</span>
                        </div>
                    </div>

                    <form id="contactForm" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="first-name" class="form-label">First Name *</label>
                                <input type="text" id="first-name" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name" class="form-label">Last Name *</label>
                                <input type="text" id="last-name" class="form-input" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="event-type" class="form-label">Event Type *</label>
                            <select id="event-type" class="form-input" required>
                                <option value="">Select Event Type</option>
                                <option value="wedding">Wedding</option>
                                <option value="corporate">Corporate Event</option>
                                <option value="social">Social Celebration</option>
                                <option value="destination">Destination Event</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="event-date" class="form-label">Event Date</label>
                                <input type="date" id="event-date" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="guest-count" class="form-label">Guest Count</label>
                                <input type="number" id="guest-count" class="form-input" min="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message *</label>
                            <textarea id="message" class="form-input form-textarea" placeholder="Tell us about your event vision, requirements, and any specific details..." required></textarea>
                        </div>

                        <button type="submit" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg w-full">
                            Send Message
                            <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>

                <!-- Contact Info & Map -->
                <div class="fade-in">
                    <h2 class="text-3xl font-light serif text-gray-900 mb-6">Visit Our Offices</h2>
                    <p class="text-gray-600 mb-8">We have offices in major cities worldwide to serve your event planning needs.</p>

                    <div class="space-y-6 mb-8">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">New York Headquarters</h4>
                                <p class="text-gray-600">123 Park Avenue, New York, NY 10017</p>
                                <p class="text-gray-500 text-sm">Mon-Fri: 9AM-6PM EST</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">London Office</h4>
                                <p class="text-gray-600">45 Berkeley Square, Mayfair, London W1J 5DB</p>
                                <p class="text-gray-500 text-sm">Mon-Fri: 9AM-6PM GMT</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Dubai Office</h4>
                                <p class="text-gray-600">Level 41, Burj Khalifa, Downtown Dubai, UAE</p>
                                <p class="text-gray-500 text-sm">Sun-Thu: 9AM-6PM GST</p>
                            </div>
                        </div>
                    </div>

                    <div class="map-placeholder">
                        <i class="fas fa-map text-4xl mb-4 opacity-70"></i>
                        <p class="text-xl font-semibold mb-2">Interactive Map</p>
                        <p class="opacity-80 text-center max-w-xs">Our global offices and service areas would be displayed here</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Consultation Booking -->
    <section id="consultation" class="py-20 bg-white section-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Book a Consultation</h2>
                <p class="text-gray-600 text-lg">Schedule a personalized consultation to discuss your event in detail</p>
            </div>

            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 fade-in">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">What to Expect</h3>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Detailed discussion of your event vision and requirements</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Preliminary budget assessment and planning</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Venue and vendor recommendations</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Timeline development and next steps</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Schedule Your Session</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                                <div>
                                    <p class="font-semibold text-gray-900">Virtual Consultation</p>
                                    <p class="text-gray-600 text-sm">45-minute video call</p>
                                </div>
                                <a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium text-sm">
                                    Book Now
                                </a>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                                <div>
                                    <p class="font-semibold text-gray-900">In-Person Meeting</p>
                                    <p class="text-gray-600 text-sm">At our office or your venue</p>
                                </div>
                                <a href="#" class="btn-primary text-white px-4 py-2 rounded-lg font-medium text-sm">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50 section-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-light serif text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 text-lg">Common questions about our event planning process</p>
            </div>

            <div class="space-y-6 fade-in">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">How far in advance should I book your services?</h3>
                    <p class="text-gray-600">We recommend booking 6-12 months in advance for weddings and 3-6 months for corporate events. However, we've successfully planned extraordinary events with much shorter timelines.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.1s;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Do you handle events outside of your base locations?</h3>
                    <p class="text-gray-600">Absolutely! We specialize in destination events worldwide. Our global network allows us to create seamless experiences no matter where your event takes place.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.2s;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">What is your pricing structure?</h3>
                    <p class="text-gray-600">We offer customized pricing based on your event requirements, scale, and complexity. After our initial consultation, we provide a detailed proposal with transparent pricing.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 fade-in" style="transition-delay: 0.3s;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Can you work within my budget?</h3>
                    <p class="text-gray-600">Yes! We're experienced at creating extraordinary events at various budget levels. We'll work creatively to maximize your budget while delivering exceptional quality.</p>
                </div>
            </div>

            <div class="text-center mt-12 fade-in">
                <p class="text-gray-600 mb-6">Have more questions? We're here to help!</p>
                <a href="tel:+1-555-1234" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Call Us Now
                </a>
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
            <h2 class="text-3xl md:text-4xl font-light serif mb-6 fade-in">Ready to Begin Your Journey?</h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto fade-in">
                Let's transform your vision into an unforgettable experience. Contact us today to start planning.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in">
                <a href="#contact-form" class="btn-primary text-white px-8 py-4 rounded-lg font-semibold shadow-lg inline-flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Send Message
                </a>
                <a href="tel:+1-555-1234" class="border border-white/30 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Call Now
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

            // Form submission
            const contactForm = document.getElementById('contactForm');
            const successMessage = document.getElementById('success-message');

            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // In a real application, you would send the form data to a server here
                    // For demonstration, we'll just show the success message

                    successMessage.style.display = 'block';
                    contactForm.reset();

                    // Scroll to success message
                    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    // Hide success message after 5 seconds
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                });
            }

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

