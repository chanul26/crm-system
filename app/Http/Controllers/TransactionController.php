<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Show all transactions
     */
    public function index()
    {
        $transactions = Transaction::with(['customer', 'invoice'])
                                   ->latest()
                                   ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
}