<nav id="navbar" class="fixed w-full bg-white/80 backdrop-blur-md z-50 border-b border-gray-100 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900 serif flex items-center">
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-2 rounded-lg mr-2">
                        <i class="fas fa-crown"></i>
                    </span>
                    Eventé
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8">
                @php
                    $navItems = [
                        ['name' => 'Home', 'url' => '/'],
                        ['name' => 'Services', 'url' => '/services'],
                        ['name' => 'Portfolio', 'url' => '/portfolio'],
                        ['name' => 'About', 'url' => '/about-us'],
                        ['name' => 'Contact', 'url' => '/contact-us'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    @php
                        $isActive = Request::is(ltrim($item['url'], '/')) ? 'text-gray-900' : 'text-gray-600';
                        $underlineClass = Request::is(ltrim($item['url'], '/')) ? 'w-full' : 'w-0 group-hover:w-full';
                    @endphp
                    <a href="{{ url($item['url']) }}" class="font-medium transition-all duration-300 relative group {{ $isActive }}">
                        {{ $item['name'] }}
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 {{ $underlineClass }}"></span>
                    </a>
                @endforeach
            </div>

            <!-- Buttons -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium hidden sm:block transition-colors duration-300 hover-lift px-3 py-1 rounded-lg">
                    Sign In
                </a>
                <a href="contact.html" class="btn-primary text-white px-5 py-2.5 rounded-lg font-medium shadow-lg">
                    Plan Your Event
                </a>
            </div>
        </div>
    </div>
</nav>
