<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('title', 60);
            $table->string('slug');
            $table->integer('rooms')->default(1);
            $table->integer('beds')->default(1);
            $table->integer('bathrooms')->default(1);
            $table->integer('square_meters');
            $table->string('address', 255);
            $table->float('longitude', 20, 15)->nullable();
            $table->float('latitude', 20, 15)->nullable();
            $table->boolean('visible')->default(false);
            $table->string('image', 255)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('apartments');
    }
};
