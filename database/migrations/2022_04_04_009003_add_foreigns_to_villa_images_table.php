<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villa_images', function (Blueprint $table) {
            $table
                ->foreign('villa_id')
                ->references('id')
                ->on('villas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villa_images', function (Blueprint $table) {
            $table->dropForeign(['villa_id']);
        });
    }
};
