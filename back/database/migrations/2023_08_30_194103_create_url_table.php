<?php

use App\Enums\UrlStates;
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
        Schema::create('url', function (Blueprint $table) {
            $table->id();
            $table->text('destination');
            $table->string('slug', 5)->unique()->nullable();
            $table->integer('views')->default(0);
            $table->text('description')->nullable();
            $table->enum('state', UrlStates::states())->default(UrlStates::ACTIVE->value);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url');
    }
};
