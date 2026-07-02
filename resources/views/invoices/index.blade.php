@extends('layouts.app')

@section('title', 'Invoices')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">All Invoices</h2>
    <a href="{{ route('invoices.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        + Create Invoice
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Invoice #</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Customer</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Amount</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Due Date</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($invoices as $invoice)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $invoice->invoice_number }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $invoice->customer->name }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        ${{ number_format($invoice->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('invoices.update-status', $invoice) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                class="text-xs font-semibold rounded-full px-3 py-1 border-0 cursor-pointer
                                @if($invoice->status === 'paid') bg-green-100 text-green-700
                                @elseif($invoice->status === 'overdue') bg-red-100 text-red-700
                                @elseif($invoice->status === 'sent') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                <option value="draft"   {{ $invoice->status === 'draft'   ? 'selected' : '' }}>Draft</option>
                                <option value="sent"    {{ $invoice->status === 'sent'    ? 'selected' : '' }}>Sent</option>
                                <option value="paid"    {{ $invoice->status === 'paid'    ? 'selected' : '' }}>Paid</option>
                                <option value="overdue" {{ $invoice->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">

                        {{-- Send Invoice button (only show if not paid) --}}
                        @if($invoice->status !== 'paid')
                            <form action="{{ route('invoices.send', $invoice) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Send invoice to {{ $invoice->customer->email }}?')"
                                    class="text-green-600 hover:underline text-sm">
                                    Send
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('invoices.show', $invoice) }}"
                           class="text-gray-600 hover:underline text-sm">View</a>

                        <a href="{{ route('invoices.edit', $invoice) }}"
                           class="text-indigo-600 hover:underline text-sm">Edit</a>

                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        No invoices found. Click "Create Invoice" to make one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $invoices->links() }}
</div>

@endsection