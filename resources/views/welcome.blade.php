<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- Navigation --}}
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-blue-900">CRM System</span>
            </div>
            <div class="flex gap-3">
                @auth
                    {{-- If already logged in, show dashboard button --}}
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-medium">
                        Go to Dashboard
                    </a>
                @else
                    {{-- If not logged in, show login and register --}}
                    <a href="{{ route('login') }}"
                       class="text-blue-900 border border-indigo-600 px-5 py-2 rounded-lg hover:bg-indigo-50 transition font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-medium">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="max-w-7xl mx-auto px-6 py-20 text-center">

        <h1 class="text-5xl font-bold text-gray-800 mb-6 leading-tight">
            Manage Your Business<br>
        </h1>
        <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto">
            A complete CRM solution to manage your customers, proposals,
            invoices and payments — all in one place.
        </p>
        <div class="flex gap-4 justify-center">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="bg-indigo-600 text-white px-8 py-3 rounded-xl hover:bg-indigo-700 transition font-semibold text-lg">
                    Go to Dashboard →
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="bg-blue-900  text-white px-8 py-3 rounded-xl hover:bg-blue-800 transition font-semibold text-lg">
                    Get Started Free →
                </a>
                <a href="{{ route('login') }}"
                   class="bg-white text-blue-900 border border-indigo-200 px-8 py-3 rounded-xl hover:bg-indigo-50 transition font-semibold text-lg">
                    Login
                </a>
            @endauth
        </div>
    </section>

    {{-- Features Section --}}
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
            Everything You Need
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl mb-4 mx-auto">
                    👥
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-center">Customers</h3>
                <p class="text-gray-500 text-sm text-center">
                    Manage all your customers in one place. Track status, contact info and history.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center text-2xl mb-4 mx-auto">
                    📄
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-center">Proposals</h3>
                <p class="text-gray-500 text-sm text-center">
                    Create and send professional proposals to your customers and track their status.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-2xl mb-4 mx-auto">
                    🧾
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-center">Invoices</h3>
                <p class="text-gray-500 text-sm text-center">
                    Generate invoices, send them via email and let customers pay online instantly.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-2xl mb-4 mx-auto">
                    💳
                </div>
                <h3 class="font-bold text-gray-800 mb-2 text-center">Payments</h3>
                <p class="text-gray-500 text-sm text-center">
                    Secure Stripe payment integration. Track all transactions in real time.
                </p>
            </div>

        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="bg-indigo-50 py-16 mt-8">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                How It Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Add Your Customers</h3>
                    
                </div>

                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Send Invoices</h3>
                    
                </div>

                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-900  text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Get Paid Online</h3>
                    
                </div>

            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white border-t py-8 mt-8">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-400 text-sm">
            <p>-CRM System-</p>
            <p class="mt-1">© {{ date('Y') }} All rights reserved.</p>
        </div>
    </footer>

</body>
</html>