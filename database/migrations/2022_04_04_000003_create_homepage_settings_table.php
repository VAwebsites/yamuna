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
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_title');
            $table->string('project_location');
            $table->longText('rera_number');
            $table->text('youtube_link')->nullable();
            $table->longText('brochure');
            $table->longText('project_overview');
            $table->string('project_type');
            $table->string('project_status');
            $table->mediumText('address_line_1')->nullable();
            $table->mediumText('address_line_2')->nullable();
            $table->string('contact_number')->nullable();
            $table->longText('logo')->nullable();
            $table->string('email')->nullable();
            $table->longText('footer_description')->nullable();

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
        Schema::dropIfExists('homepage_settings');
    }
};
