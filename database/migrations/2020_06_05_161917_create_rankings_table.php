<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index();
            $table->string('name');    // name カラム追加
            $table->integer('rank1')->unsigned();    // rank1 カラム追加
            $table->integer('rank2')->unsigned();    // rank2 カラム追加
            $table->integer('rank3')->unsigned();    // rank3 カラム追加
            $table->integer('rank4')->unsigned();    // rank4 カラム追加
            $table->integer('rank5')->unsigned();    // rank5 カラム追加
            $table->timestamps();

            // 外部キー設定
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('rank1')->references('id')->on('items')->onDelete('no action');


            // category_idの重複を許さない
            $table->unique(['category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
