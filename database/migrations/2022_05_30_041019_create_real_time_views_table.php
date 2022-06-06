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
        Schema::create('real_time_views', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->default(1);
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['ip', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_time_views');
    }
};
