<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('destination',191);
            $table->foreignId('currency_id')->references('id')->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('price');
            $table->string('person_num');
            $table->integer('days');
            $table->integer('rate')->nullable();
            $table->text('package_desc')->nullable();
            $table->text('package_contain')->nullable();
            $table->text('conditions')->nullable();
            $table->text('cancel_conditions')->nullable();
            $table->enum('status',['active','notactive'])->default('active');
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
        Schema::dropIfExists('packages');
    }
}