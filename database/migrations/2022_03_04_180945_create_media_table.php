<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('serie_id')->default(0)->index('media_fk1_idx');
            //Dans le cas où on supprime une série, on supprime aussi tous les médias associés (vérifier le sens)
            $table->foreign('serie_id')->references('id')->on('series')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->string('url');
            $table->string('filename');
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
        Schema::dropIfExists('media');
    }
}
