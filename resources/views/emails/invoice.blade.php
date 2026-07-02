<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #4f46e5;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            opacity: 0.85;
            font-size: 14px;
        }
        .body {
            padding: 30px;
        }
        .invoice-box {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .invoice-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }
        .invoice-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 16px;
            color: #4f46e5;
        }
        .invoice-row .label {
            color: #6b7280;
        }
        .pay-button {
            display: block;
            background: #4f46e5;
            color: white;
            text-align: center;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            margin: 25px 0;
        }
        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
            padding: 20px 30px;
            border-top: 1px solid #f3f4f6;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>⚡ CRM System</h1>
            <p>You have a new invoice</p>
        </div>

        <div class="body">

            <p>Hello, <strong>{{ $invoice->customer->name }}</strong>!</p>
            <p>Please find your invoice details below. Click the button to proceed with payment.</p>

            <div class="invoice-box">
                <div class="invoice-row">
                    <span class="label">Invoice Number</span>
                    <span>{{ $invoice->invoice_number }}</span>
                </div>
                <div class="invoice-row">
                    <span class="label">Description</span>
                    <span>{{ $invoice->description ?? 'Payment for services' }}</span>
                </div>
                @if($invoice->due_date)
                <div class="invoice-row">
                    <span class="label">Due Date</span>
                    <span>{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</span>
                </div>
                @endif
                <div class="invoice-row">
                    <span class="label">Total Amount</span>
                    <span>${{ number_format($invoice->amount, 2) }}</span>
                </div>
            </div>

            {{-- This is the PAY NOW button --}}
            {{-- route('invoice.pay', $invoice->access_token) builds the public URL --}}
            {{-- e.g. http://127.0.0.1:8000/invoice/abc123.../pay --}}
            <a href="{{ route('invoice.pay', $invoice->access_token) }}" class="pay-button">
                💳 Pay Now — ${{ number_format($invoice->amount, 2) }}
            </a>

            <p style="color: #6b7280; font-size: 13px;">
                If you have any questions about this invoice, please contact us.
            </p>

        </div>

        <div class="footer">
            <p>This email was sent by CRM System. Please do not reply to this email.</p>
            <p>If you did not expect this invoice, please ignore this email.</p>
        </div>

    </div>
</body>
</html>