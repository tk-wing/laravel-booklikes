<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table){
            $table->dropColumn('evaluate');
            $table->float('evaluation_average')->default(0)->unsigned()->after('body');
            $table->integer('evaluation_count')->default(0)->unsigned()->after('evaluation_average');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('evaluate')->nullable();
            $table->dropColumn(['evaluation_count', 'evaluation_average']);
        });
    }
}
