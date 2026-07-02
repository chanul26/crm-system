<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Show list of all invoices
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form to create a new invoice
     */
    public function create()
    {
        $customers = Customer::where('status', 'active')->get();

        return view('invoices.create', compact('customers'));
    }

    /**
     * Save the new invoice to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'description' => 'nullable|string',
            'amount'      => 'required|numeric|min:0',
            'due_date'    => 'nullable|date',
        ]);

        // Auto-generate invoice number e.g. INV-0001
        $lastInvoice = Invoice::latest()->first();
        $nextNumber  = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Generate a unique secret token for public payment link
        $accessToken = Str::random(40);

        Invoice::create(array_merge($validated, [
            'invoice_number' => $invoiceNumber,
            'access_token'   => $accessToken,
        ]));

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Show a single invoice detail (admin view)
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('customer');

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form to edit an invoice
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::where('status', 'active')->get();

        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the invoice in the database
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'description' => 'nullable|string',
            'amount'      => 'required|numeric|min:0',
            'due_date'    => 'nullable|date',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Update invoice status manually
     */
    public function updateStatus(Request $request, Invoice $invoice)
    {
        $request->validate([
            'status' => 'required|in:draft,sent,paid,overdue',
        ]);

        $invoice->update(['status' => $request->status]);

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice status updated.');
    }

    /**
     * Send the invoice to the customer via email
     */
    public function send(Invoice $invoice)
    {
        // Send the invoice email to the customer
        Mail::to($invoice->customer->email)
            ->send(new InvoiceMail($invoice));

        // Update status from draft to sent
        $invoice->update(['status' => 'sent']);

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice sent to ' . $invoice->customer->email);
    }

    /**
     * Delete the invoice
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Public page — customer sees this when they click the link in their email
     * No auth required (customer doesn't have a login)
     */
    public function publicPay(string $token)
    {
        // Find the invoice by its secret token
        // If token is wrong/fake, abort with 404
        $invoice = Invoice::where('access_token', $token)
                          ->with('customer')
                          ->firstOrFail();

        return view('invoices.public-pay', compact('invoice'));
    }

    /**
     * Redirect customer to Stripe Checkout payment page
     */
    public function checkout(string $token)
    {
        $invoice = Invoice::where('access_token', $token)->firstOrFail();

        // Set the Stripe secret key
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Create a Stripe Checkout Session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'unit_amount'  => (int)($invoice->amount * 100), // Stripe uses cents not dollars
                    'product_data' => [
                        'name' => 'Invoice ' . $invoice->invoice_number,
                        'description' => $invoice->description ?? 'Payment for services',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // Where to redirect after successful payment
            'success_url' => route('invoice.success', $invoice->access_token),
            // Where to redirect if customer cancels
            'cancel_url'  => route('invoice.pay', $invoice->access_token),
            'metadata'    => [
                'invoice_id' => $invoice->id,
            ],
        ]);

        // Save the Stripe session ID so we can match the webhook later
        $invoice->update(['stripe_session_id' => $session->id]);

        // Redirect customer to Stripe's hosted payment page
        return redirect($session->url);
    }

    /**
     * Success page after payment — shown after Stripe redirects back
     */
    public function success(string $token)
    {
        $invoice = Invoice::where('access_token', $token)
                          ->with('customer')
                          ->firstOrFail();

        return view('invoices.success', compact('invoice'));
    }
}