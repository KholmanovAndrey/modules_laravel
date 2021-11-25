<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('gallery_id');
            $table->string('name')->nullable()->comment('Название для поля alt');
            $table->string('title')->nullable()->comment('Наименование');
            $table->string('description')->nullable()->comment('Описание');
            $table->string('image')->comment('Url картинки');
            $table->boolean('isPublished')->default(1)->comment('Опубликован(1)/Скрыт(0)');
            $table->boolean('isDeleted')->default(0)->comment('Удален(1)/Рабочий(0)');

            $table->timestamps();

            $table->foreign('gallery_id')
                ->references('id')
                ->on('galleries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_images');
    }
}
