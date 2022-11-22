<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsposts', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Foreign key implementation
            $table->foreignId('user_id')->constrained('users')->nullable();

            $table->tinyText('title')->nullable();
            $table->text('details')->nullable();
            $table->string('category')->nullable();
            $table->string('custom_url')->nullable();
            $table->text('tags')->nullable();
            $table->string('story_external_source_name')->nullable();
            $table->string('story_external_source_url')->nullable();
            $table->string('image_external_source_credit')->nullable();
            $table->string('image_external_source_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsposts');
    }
};
