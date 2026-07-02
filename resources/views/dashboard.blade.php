@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Customers Card --}}
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-2xl">👥</div>
        <div>
            <p class="text-lg font-bold:text-gray-500">Total Customers</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</p>
        </div>
    </div>

    {{-- Proposals Card --}}
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-2xl">📄</div>
        <div>
            <p class="text-lg font-bold:text-gray-500">Total Proposals</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalProposals }}</p>
        </div>
    </div>

    {{-- Invoices Card --}}
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl">🧾</div>
        <div>
            <p class="text-lg font-bold:text-gray-500">Total Invoices</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalInvoices }}</p>
        </div>
    </div>

    {{-- Transactions Card --}}
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-2xl">💳</div>
        <div>
            <p class="text-lg font-bold:text-gray-500">Total Transactions</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalTransactions }}</p>
        </div>
    </div>

</div>

{{-- Welcome Message --}}
<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">👋 Welcome to your CRM Dashboard</h3>
    <p class="text-gray-500">Use those functions</p>
</div>

@endsection