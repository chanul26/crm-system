@extends('layouts.app')

@section('title', 'Edit Proposal')

@section('content')

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Proposal</h2>

    <form action="{{ route('proposals.update', $proposal) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Customer *</label>
            <select name="customer_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id', $proposal->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} ({{ $customer->email }})
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
            <input type="text" name="title" value="{{ old('title', $proposal->title) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $proposal->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Amount ($) *</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $proposal->amount) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('amount')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Valid Until</label>
            <input type="date" name="valid_until" value="{{ old('valid_until', $proposal->valid_until) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('valid_until')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
                Update Proposal
            </button>
            <a href="{{ route('proposals.index') }}"
               class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection