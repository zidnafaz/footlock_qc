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
        Schema::create('audit_summary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_header_id')->constrained('audit_headers')->onDelete('cascade');
            $table->integer('total_defects');
            $table->decimal('defect_percentage', 5, 2);
            $table->enum('conclusion', ['Lulus', 'Tidak Lulus']);
            $table->text('corrective_action');
            $table->string('responsible_person', 100);
            $table->enum('followup_status', ['Belum', 'Proses', 'Selesai']);
            $table->date('followup_due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_summary');
    }
};
