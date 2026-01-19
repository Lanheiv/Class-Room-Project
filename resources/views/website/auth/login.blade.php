<x-layout>
<x-slot:title>Login</x-slot:title>

<div class="w-full bg-gray-100 dark:bg-zinc-900 shadow-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Nav links -->
            <div class="flex space-x-3">
                <a href="{{ url('/join-class') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium 
                          hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">
                   Join Class
                </a>
                <a href="{{ url('/classes') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium 
                          hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">
                   Classes
                </a>
                <a href="{{ url('/tasks') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium 
                          hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">
                   Tasks
                </a>
                <a href="{{ url('/profile') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium 
                          hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition shadow-sm">
                   Profile
                </a>
            </div>

            <!-- Logout button -->
            <div>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-white dark:bg-zinc-800 text-red-600 border border-red-600 
                               rounded-lg font-medium hover:bg-red-50 dark:hover:bg-zinc-700 transition shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</x-layout>
