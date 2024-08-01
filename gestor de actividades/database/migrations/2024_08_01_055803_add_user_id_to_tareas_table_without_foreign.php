<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTareasTableWithoutForeign extends Migration
{
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(); // Permitir nulos temporalmente
        });
    }

    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

