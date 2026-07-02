<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->string('access_token')->unique();
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue'])->default('draft');
            $table->string('stripe_session_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
