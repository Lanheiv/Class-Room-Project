<div class="w-full bg-gray-100 dark:bg-zinc-900 shadow-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex space-x-3">
                @if(auth()->user()->role == "user")
                <a href="{{ url('/join-class') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Join Class</a>
                @endif
                <a href="{{ url('/') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Classes</a>
                @if(auth()->user()->role == "user")
                    <a href="{{ url('/tasks') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Tasks</a>
                @endif
                @if(auth()->user()->role == "teacher")
                    <a href="{{ url('/create-class') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Make class</a>
                @endif
                @if(auth()->user()->role == "admin")
                    <a href="/admin" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Admin panel</a>
                @endif
                <a href="{{ url('/profile') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">Profile</a>
            </div>
            <div class="flex items-center space-x-3">
                <button id="theme-toggle" class="px-3 py-2 bg-gray-200 dark:bg-zinc-700 text-gray-800 dark:text-gray-200 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-zinc-600 transition shadow-sm">🌙 / ☀️</button>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-white dark:bg-zinc-800 text-red-600 border border-red-600 rounded-lg font-medium hover:bg-red-50 dark:hover:bg-zinc-700 transition shadow-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const themeToggle = document.getElementById('theme-toggle');
    const htmlEl = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') htmlEl.classList.add('dark');

    themeToggle.addEventListener('click', () => {
        htmlEl.classList.toggle('dark');
        localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
    });
</script>
