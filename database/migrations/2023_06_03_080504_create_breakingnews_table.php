<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakingnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breakingnews', function (Blueprint $table) {
            $table->id();
            $table->string('breakingnews_bn');
            $table->string('breakingnews_en');
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(1);
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
        Schema::dropIfExists('breakingnews');
    }
}
