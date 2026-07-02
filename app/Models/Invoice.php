<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'access_token',
        'amount',
        'description',
        'due_date',
        'status',
        'stripe_session_id',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    /**
     * An invoice belongs to one customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * An invoice can have many transactions (e.g. failed + successful attempts)
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}