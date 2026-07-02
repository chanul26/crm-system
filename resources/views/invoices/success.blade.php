<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md w-full text-center">

        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl">✅</span>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h1>
        <p class="text-gray-500 mb-6">
            Thank you, {{ $invoice->customer->name }}! Your payment for
            <strong>{{ $invoice->invoice_number }}</strong> has been received.
        </p>

        <div class="bg-gray-50 rounded-xl p-4 text-left space-y-2 mb-6">
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Amount Paid</span>
                <span class="font-bold text-gray-800">${{ number_format($invoice->amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Invoice</span>
                <span class="font-semibold text-gray-800">{{ $invoice->invoice_number }}</span>
            </div>
        </div>

        <p class="text-gray-400 text-sm">You can close this window now.</p>

    </div>

</body>
</html>