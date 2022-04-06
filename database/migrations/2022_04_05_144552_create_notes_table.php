<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('serie_id')->default(0)->index('notes_fk1_idx'); #On créé la colonne de la clé étrangère
            $table->foreign('serie_id')->references('id')->on('series')->onUpdate('CASCADE')->onDelete('CASCADE'); #On déclare que c'est la clé étrangère

            $table->unsignedBigInteger('user_id')->default(0)->index('notes_fk2_idx'); #On créé la colonne de la clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE'); #On déclare que c'est la clé étrangère

            $table->integer('valeurNote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
