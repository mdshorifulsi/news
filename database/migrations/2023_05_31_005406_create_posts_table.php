<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('title_bn');
            $table->string('title_en');
            $table->string('slug_bn')->nullable();
            $table->string('slug_en')->nullable();
            $table->text('body_bn');
            $table->text('body_en');
            $table->string('images_one')->nullable();
            $table->string('images_two')->nullable();
            $table->string('imagesone_title_bn')->nullable();
            $table->string('imagesone_title_en')->nullable();
            $table->string('imagestwo_title_bn')->nullable();
            $table->string('imagestwo_title_en')->nullable();
            
            $table->integer('view_count')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->boolean('big_thumbnail')->default(0);
            $table->boolean('first_section')->default(0);

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('posts');
    }
}