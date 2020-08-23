<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('channel_id')->unsigned()->index();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->integer('duration')->unsigned();
            $table->text('description');
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('thumbnail');
            $table->index(['channel_id', 'start']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['channel_id']);
        });

        Schema::dropIfExists('programmes');
    }
}
