@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Create New Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Customer *</label>
            <select name="customer_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Select a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} ({{ $customer->email }})
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Amount ($) *</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('amount')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit"
                class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
                Create Invoice
            </button>
            <a href="{{ route('invoices.index') }}"
               class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection