<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventé | Premium Event Planning & Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('event-schedule.png') }}">
    @vite(['resources/js/app.js','resources/css/app.css'])
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

        /* Image carousel */
        .carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .carousel-track {
            display: flex;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .carousel-slide {
            min-width: 100%;
            height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .carousel-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            padding: 40px;
            color: white;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.5s ease;
        }
        .carousel-slide:hover .carousel-overlay {
            transform: translateY(0);
            opacity: 1;
        }
        .carousel-nav {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .carousel-dot.active {
            background: white;
            transform: scale(1.2);
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
        .service-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(to bottom, white, #f8fafc);
        }
        .service-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* Testimonial card */
        .testimonial-card {
            position: relative;
            overflow: hidden;
        }
        .testimonial-card::before {
            content: """;
            position: absolute;
            top: -20px;
            left: 20px;
            font-size: 100px;
            color: rgba(99, 102, 241, 0.1);
            font-family: serif;
            line-height: 1;
        }

        /* Parallax effect */
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Loading animation */
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        .pulse {
            animation: pulse 3s infinite;
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    <!-- Navigation -->
    @include('include.header')

    @yield('content')

    <!-- Footer -->
    @include('include.footer')

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

            // Image carousel
            const carouselTrack = document.getElementById('carouselTrack');
            const dots = document.querySelectorAll('.carousel-dot');
            let currentIndex = 0;
            let autoSlideInterval;

            function updateCarousel() {
                carouselTrack.style.transform = `translateX(-${currentIndex * 100}%)`;

                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % dots.length;
                    updateCarousel();
                }, 5000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                    stopAutoSlide();
                    startAutoSlide();
                });
            });

            // Start auto slide
            startAutoSlide();

            // Pause auto slide on hover
            carouselTrack.addEventListener('mouseenter', stopAutoSlide);
            carouselTrack.addEventListener('mouseleave', startAutoSlide);

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
</body>
</html>
