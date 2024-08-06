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
        Schema::create('facebook_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->string('title')->nullable();
            $table->string('description');
            $table->string('file')->nullable();
            $table->string('likes')->nullable();
            $table->string('comments')->nullable();
            $table->string('shares')->nullable();
            $table->string('original_link')->nullable();
            $table->foreignId('facebook_page_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('facebook_posts');
    }
};
