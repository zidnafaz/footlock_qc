<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_headers', function (Blueprint $table) {
            $table->id();
            $table->string('audit_code', 50);
            $table->date('audit_date');
            $table->string('auditor_name', 100);
            $table->enum('department', ['Cutting', 'Stitching', 'Assembling', 'Finishing']);
            $table->enum('shift', ['Shift 1', 'Shift 2', 'Shift 3']);
            $table->string('product_name', 100);
            $table->string('product_code', 50);
            $table->string('supplier_name', 100);
            $table->enum('category', ['Rutin', 'Pre-shipment', 'Penerimaan Supplier']);
            $table->integer('total_sample');
            $table->enum('method', ['Visual', 'Dimensional', 'Fungsi', 'Sampling']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_headers');
    }
};
