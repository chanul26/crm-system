@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">

    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $invoice->invoice_number }}</h2>
            <p class="text-gray-500 mt-1">For {{ $invoice->customer->name }}</p>
        </div>
        <span class="px-3 py-1 rounded-full text-xs font-semibold
            @if($invoice->status === 'paid') bg-green-100 text-green-700
            @elseif($invoice->status === 'overdue') bg-red-100 text-red-700
            @elseif($invoice->status === 'sent') bg-blue-100 text-blue-700
            @else bg-gray-100 text-gray-700
            @endif">
            {{ ucfirst($invoice->status) }}
        </span>
    </div>

    <div class="space-y-4 border-t pt-4">

        <div>
            <p class="text-sm text-gray-500">Customer Email</p>
            <p class="text-gray-800">{{ $invoice->customer->email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Amount</p>
            <p class="text-2xl font-bold text-gray-800">${{ number_format($invoice->amount, 2) }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Description</p>
            <p class="text-gray-800">{{ $invoice->description ?? 'No description provided.' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Due Date</p>
            <p class="text-gray-800">
                {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') : '-' }}
            </p>
        </div>

        @if($invoice->paid_at)
        <div>
            <p class="text-sm text-gray-500">Paid At</p>
            <p class="text-gray-800">{{ $invoice->paid_at->format('M d, Y h:i A') }}</p>
        </div>
        @endif

        <div>
            <p class="text-sm text-gray-500">Payment Link (share with customer)</p>
            <p class="text-indigo-600 text-sm break-all">
                {{ route('invoice.pay', $invoice->access_token) }}
            </p>
        </div>

    </div>

    <div class="mt-6 pt-6 border-t flex gap-3 flex-wrap">

        @if($invoice->status !== 'paid')
            <form action="{{ route('invoices.send', $invoice) }}" method="POST">
                @csrf
                <button type="submit"
                    onclick="return confirm('Send invoice to {{ $invoice->customer->email }}?')"
                    class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition">
                    📧 Send Invoice Email
                </button>
            </form>
        @endif

        <a href="{{ route('invoices.edit', $invoice) }}"
           class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
            Edit
        </a>

        <a href="{{ route('invoices.index') }}"
           class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition">
            Back to List
        </a>

    </div>

</div>

@endsection