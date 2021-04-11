<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionAndDateToFichiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            //
            $table->date('date_activite')->nullable()->unique()->after('groupe_id');
            $table->text('description')->nullable()->after('date_activite');
            $table->dropColumn('thumb_url');
            $table->dropColumn('thumb_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichiers', function (Blueprint $table) {
            //
        $table->dropColumn('description');
        $table->dropColumn('date_activite');

        });
    }
}
