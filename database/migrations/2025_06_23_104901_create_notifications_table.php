<?php

use App\Migrations\BaseMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $this->setTableEngine($table);
            $table->id();
            $table->string('title');
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade');
            $table->enum('type', ['received', 'on_progress', 'done', 'returned', 'broken']);
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
