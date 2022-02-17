<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id')->default(0)->index('series_fk1_idx'); #On créé la colonne de la clé étrangère
            $table->foreign('author_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION'); #On déclare que c'est la clé étrangère
            $table->mediumText('title');
            $table->longText('content');
            $table->longText('acteurs');
            $table->char('url', 200)->unique('URL_UNIQUE');
            $table->text('tags');
            $table->dateTime('date');
            $table->char('status', 45);
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
        Schema::dropIfExists('series');
    }
}
