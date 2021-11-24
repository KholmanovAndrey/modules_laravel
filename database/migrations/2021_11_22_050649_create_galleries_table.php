<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->unique()->comment('Транслит на английский для url');
            $table->string('title')->unique()->comment('Наименование');
            $table->text('description')->nullable()->comment('Описание');
            $table->boolean('isPublished')->default(1)->comment('Опубликован(1)/Скрыт(0)');
            $table->boolean('isDeleted')->default(0)->comment('Удален(1)/Рабочий(0)');

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
        Schema::dropIfExists('galleries');
    }
}
