<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();

            $table->string('visitor_id');

            $table->timestamps();

            // Relations

            $table->foreignId('variant_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('experiment_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // Key

            $table->index('visitor_id');
        });
    }
};
