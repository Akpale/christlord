<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('groupes_id')->constrained();
            //$table->unsignedBigInteger('gpusers_id');
            //$table->foreignId('gpusers_id')->on('gp_users')->references('id')->constrained()->onDelete('cascade');
            //$table->unsignedBigInteger('groupe_id');
            //$table->foreignId('groupe_id')->on('groupes')->references('id')->constrained()->onDelete('cascade');
            $table->foreignId('departement_id')->constrained('departements')->onDelete('cascade');
            $table->foreignId('gpusers_id')->constrained('gpusers')->onDelete('cascade');
            $table->foreignId('statut_id')->constrained('statuts')->onDelete('cascade');
            $table->string('pseudo')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

          //Schema::table('users', function($table) {
       //$table->foreign('groupe_id')->references('id')->on('groupes')->constrained()->onDelete('cascade');
      //});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
