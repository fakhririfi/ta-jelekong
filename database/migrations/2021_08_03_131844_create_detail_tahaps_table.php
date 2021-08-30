<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTahapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tahaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->datetime('time')->nullable();
            $table->datetime('end')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('attachment')->nullable();
            $table->foreignId('tahap_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_tahaps');
    }
}
