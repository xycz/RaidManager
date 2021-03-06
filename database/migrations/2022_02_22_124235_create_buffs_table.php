<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('effect');
            $table->foreignId('req_specc')->nullable()->references('id')->on('specs');
            $table->foreignId('req_class')->nullable()->references('id')->on('wowclasses');
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
        Schema::dropIfExists('buffs');
    }
}
