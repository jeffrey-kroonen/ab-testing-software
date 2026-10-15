<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table): void {
            $table->id();

            $table->string('name');
            $table->string('url');
            $table->integer('weight')->nullable();
            $table->boolean('is_control');

            $table->timestamps();

            // Relations

            $table->foreignId('experiment_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
};
