<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('airports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable()->default(null);
            $table->string('latitude')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('woeid')->nullable()->default(null);
            $table->string('timezone')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('runway_length')->nullable()->default(null);
            $table->string('elev')->nullable()->default(null);
            $table->string('icao')->nullable()->default(null);
            $table->string('direct_flights')->nullable()->default(null);
            $table->string('carriers')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('airports');
    }
}
