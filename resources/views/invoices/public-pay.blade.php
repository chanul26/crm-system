<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md w-full">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">⚡ CRM System</h1>
            <p class="text-gray-500 text-sm mt-1">Invoice Payment</p>
        </div>

        <div class="border rounded-xl p-5 mb-6 space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Invoice Number</span>
                <span class="font-semibold text-gray-800">{{ $invoice->invoice_number }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Customer</span>
                <span class="font-semibold text-gray-800">{{ $invoice->customer->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Description</span>
                <span class="font-semibold text-gray-800">{{ $invoice->description ?? '-' }}</span>
            </div>
            @if($invoice->due_date)
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Due Date</span>
                <span class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                </span>
            </div>
            @endif
            <div class="flex justify-between border-t pt-3">
                <span class="text-gray-700 font-semibold">Total Amount</span>
                <span class="text-2xl font-bold text-indigo-600">${{ number_format($invoice->amount, 2) }}</span>
            </div>
        </div>

        @if($invoice->status === 'paid')
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                <p class="text-green-700 font-semibold text-lg">✅ This invoice has been paid!</p>
                @if($invoice->paid_at)
                    <p class="text-green-600 text-sm mt-1">Paid on {{ $invoice->paid_at->format('M d, Y') }}</p>
                @endif
            </div>
        @else
            <a href="{{ route('invoice.checkout', $invoice->access_token) }}"
               class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition text-lg">
                💳 Pay Now — ${{ number_format($invoice->amount, 2) }}
            </a>
            <p class="text-center text-gray-400 text-xs mt-3">
                Secured by Stripe. Your payment info is never stored on our servers.
            </p>
        @endif

    </div>

</body>
</html>