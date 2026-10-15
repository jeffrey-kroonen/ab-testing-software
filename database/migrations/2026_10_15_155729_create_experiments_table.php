<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('experiments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('key');
            $table->string('status');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();

            $table->timestamps();

            // Relations

            $table->foreignId('site_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // Keys

            $table->index('key');
        });
    }
};
