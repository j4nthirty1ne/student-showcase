<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Student Showcase</a>
        <div class="flex gap-4 items-center">
            @auth
                <a href="{{ route('student.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600 transition bg-none border-none cursor-pointer">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Register</a>
            @endauth
        </div>
    </div>
</nav>
