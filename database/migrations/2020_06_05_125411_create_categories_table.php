<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();    // code カラム追加
            $table->string('name1');    // name1 カラム追加
            $table->string('name2');    // name2 カラム追加
            $table->timestamps();
            
            // codeの重複を許さない
            $table->unique(['code']);
            // name1とname2の組み合わせの重複を許さない
            $table->unique(['name1', 'name2']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
