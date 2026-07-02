<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $payload = json_decode($request->getContent(), true);

            Log::info('Webhook received: ' . json_encode($payload['type'] ?? 'unknown'));

            if (!$payload || !isset($payload['type'])) {
                Log::error('Invalid payload received');
                return response()->json(['error' => 'Invalid payload'], 400);
            }

            if ($payload['type'] === 'checkout.session.completed') {

                $session = $payload['data']['object'];
                $sessionId = $session['id'];

                Log::info('Checkout completed for session: ' . $sessionId);

                $invoice = Invoice::where('stripe_session_id', $sessionId)->first();

                if ($invoice && $invoice->status !== 'paid') {

                    $invoice->update([
                        'status'  => 'paid',
                        'paid_at' => now(),
                    ]);

                    Transaction::create([
                        'invoice_id'        => $invoice->id,
                        'customer_id'       => $invoice->customer_id,
                        'amount'            => $invoice->amount,
                        'stripe_session_id' => $sessionId,
                        'payment_status'    => 'success',
                        'paid_at'           => now(),
                    ]);

                    Log::info('Invoice ' . $invoice->invoice_number . ' marked as paid!');

                } else {
                    Log::warning('Invoice not found for session: ' . $sessionId);
                }
            }

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            Log::error('Webhook exception: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}