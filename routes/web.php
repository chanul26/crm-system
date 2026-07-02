<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('customers', CustomerController::class);
    Route::patch('/customers/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])
        ->name('customers.toggle-status');

    Route::resource('proposals', ProposalController::class);
    Route::patch('/proposals/{proposal}/status', [ProposalController::class, 'updateStatus'])
        ->name('proposals.update-status');

    Route::resource('invoices', InvoiceController::class);
    Route::patch('/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])
        ->name('invoices.update-status');
    Route::post('/invoices/{invoice}/send', [InvoiceController::class, 'send'])
        ->name('invoices.send');

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes — no login required (for customers paying invoices)
Route::get('/invoice/{token}/pay', [InvoiceController::class, 'publicPay'])
    ->name('invoice.pay');
Route::get('/invoice/{token}/checkout', [InvoiceController::class, 'checkout'])
    ->name('invoice.checkout');
Route::get('/invoice/{token}/success', [InvoiceController::class, 'success'])
    ->name('invoice.success');

// Stripe webhook — must be outside auth middleware
Route::post('/stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');

require __DIR__.'/auth.php';