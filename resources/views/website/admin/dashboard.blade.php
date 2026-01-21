<x-layout>
<x-slot:title>Admin Dashboard</x-slot:title>

<div class="min-h-screen bg-gray-100 dark:bg-zinc-900 px-3 sm:px-6 py-6 sm:py-10">

    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800 dark:text-zinc-100 text-center mb-8">
        Admin Dashboard
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow p-4 sm:p-6 overflow-x-auto">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-zinc-100">
                    Users
                </h2>

                <a href="/admin/users"
                class="px-4 py-2 bg-red-600 text-white rounded-xl text-sm font-medium hover:bg-red-700 transition">
                    Create User
                </a>
            </div>


            <table class="w-full text-sm min-w-[500px] sm:min-w-[600px]">
                <thead>
                    <tr class="text-left text-gray-600 dark:text-zinc-300 border-b border-gray-200 dark:border-zinc-700">
                        <th class="py-2">Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-100 dark:border-zinc-700">
                            <td class="py-2 text-gray-800 dark:text-zinc-100 whitespace-nowrap">
                                {{ $user->username }}
                            </td>
                            <td class="text-gray-600 dark:text-zinc-300 break-words max-w-[150px] sm:max-w-none">
                                {{ $user->email }}
                            </td>
                            <td class="text-gray-600 dark:text-zinc-300 capitalize whitespace-nowrap">
                                {{ $user->role }}
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <a href="/admin/user/{{ $user->id }}"
                                   class="px-3 py-1 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow p-4 sm:p-6">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-zinc-100 mb-4">
                Logs
            </h2>

            <div class="space-y-3 max-h-[260px] sm:max-h-[420px] overflow-y-auto">
                @foreach($logs as $log)
                    <div class="p-3 rounded-xl bg-gray-100 dark:bg-zinc-900">
                        <p class="text-sm text-gray-800 dark:text-zinc-100 break-words">
                            {{ $log->action }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-zinc-400 break-words">
                            User #{{ $log->user_id }} · {{ $log->ip }} · {{ $log->created_at }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

</x-layout>
