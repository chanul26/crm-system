<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-blue-900 text-white flex flex-col flex-shrink-0">

            {{-- Logo --}}
            <div class="h-16 flex items-center justify-center border-b border-blue-700">
                <h1 class="text-xl font-bold tracking-wide"> CRM System</h1>
            </div>

            {{-- Navigation Links --}}
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                   {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-indigo-200 hover:bg-indigo-700' }}">
                    Dashboard
                </a>

                <a href="{{ route('customers.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                {{ request()->routeIs('customers.*') ? 'bg-indigo-600 text-white' : 'text-indigo-200 hover:bg-indigo-700' }}">
                    Customers
                </a>

                <a href="{{ route('proposals.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                {{ request()->routeIs('proposals.*') ? 'bg-indigo-600 text-white' : 'text-indigo-200 hover:bg-indigo-700' }}">
                    Proposals
                </a>

                <a href="{{ route('invoices.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                {{ request()->routeIs('invoices.*') ? 'bg-indigo-600 text-white' : 'text-indigo-200 hover:bg-indigo-700' }}">
                    Invoices
                </a>

                <a href="{{ route('transactions.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition
                {{ request()->routeIs('transactions.*') ? 'bg-indigo-600 text-white' : 'text-indigo-200 hover:bg-indigo-700' }}">
                    Transactions
                </a>

            </nav>
            </nav>

            {{-- User Profile at bottom --}}
            <div class="border-t border-blue-700 p-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-full bg-gray-500 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-indigo-300">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-30 text-left px-10 py-2 text-sm text-indigo-200  bg-red-700 hover:bg-blue-700 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Top Bar --}}
            <header class="h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
                <div class="text-l text-gray-500">
                    Welcome back, <span class="font-semibold text-indigo-600">{{ Auth::user()->name }}</span>!
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">

                {{-- Success / Error Messages --}}
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>