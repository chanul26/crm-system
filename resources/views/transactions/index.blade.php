@extends('layouts.app')

@section('title', 'Transactions')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">All Transactions</h2>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Invoice #</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Customer</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Amount</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Paid At</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $transaction->invoice->invoice_number }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaction->customer->name }}<br>
                        <span class="text-xs text-gray-400">{{ $transaction->customer->email }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">
                        ${{ number_format($transaction->amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            ✅ {{ ucfirst($transaction->payment_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaction->paid_at ? $transaction->paid_at->format('M d, Y h:i A') : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                        No transactions yet. Transactions appear here after customers pay invoices.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $transactions->links() }}
</div>

@endsection