@extends('layouts.app')

@section('title', 'Proposal Details')

@section('content')

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">

    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $proposal->title }}</h2>
            <p class="text-gray-500 mt-1">For {{ $proposal->customer->name }}</p>
        </div>
        <span class="px-3 py-1 rounded-full text-xs font-semibold
            @if($proposal->status === 'accepted') bg-green-100 text-green-700
            @elseif($proposal->status === 'rejected') bg-red-100 text-red-700
            @elseif($proposal->status === 'sent') bg-blue-100 text-blue-700
            @else bg-gray-100 text-gray-700
            @endif">
            {{ ucfirst($proposal->status) }}
        </span>
    </div>

    <div class="space-y-4">
        <div>
            <p class="text-sm text-gray-500">Customer Email</p>
            <p class="text-gray-800">{{ $proposal->customer->email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Amount</p>
            <p class="text-gray-800 text-lg font-semibold">${{ number_format($proposal->amount, 2) }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Description</p>
            <p class="text-gray-800">{{ $proposal->description ?? 'No description provided.' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Valid Until</p>
            <p class="text-gray-800">{{ $proposal->valid_until ? \Carbon\Carbon::parse($proposal->valid_until)->format('M d, Y') : '-' }}</p>
        </div>
    </div>

    <div class="mt-6 pt-6 border-t flex gap-3">
        <a href="{{ route('proposals.edit', $proposal) }}"
           class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
            Edit Proposal
        </a>
        <a href="{{ route('proposals.index') }}"
           class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition">
            Back to List
        </a>
    </div>

</div>

@endsection