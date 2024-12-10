<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->text('description')->nullable();  // Добавляем описание книги
            $table->integer('year')->nullable();      // Добавляем год выпуска
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('description');  // Удаляем поле описания
            $table->dropColumn('year');         // Удаляем поле года
        });
    }
}
