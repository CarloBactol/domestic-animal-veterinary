<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('vet_id');
            $table->unsignedInteger('animal_id');
            $table->string('diagnosis');
            $table->string('treatment');
            $table->string('notes');
            $table->date('date');
            $table->timestamps();

            $table->foreign('vet_id')->references('id')->on('veterinaries')->onDelete('cascade');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
