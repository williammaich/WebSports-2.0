<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelacionamentoTipoQuadraQuadraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadras', function (Blueprint $table) {
            $table->integer('tipoQuadra_id')->unsigned();

            $table->foreign('tipoQuadra_id')
                ->references('id')->on('tipo_quadras')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadras', function (Blueprint $table) {
            //
        });
    }
}
