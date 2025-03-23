<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCandidaturasTable extends Migration
{
    public function up()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->string('status')->nullable(); // Defina aqui o tipo correto para o campo status
        });
    }

    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
