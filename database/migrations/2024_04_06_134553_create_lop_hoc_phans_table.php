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
        Schema::create('lop_hoc_phans', function (Blueprint $table) {
            $table->id();
            $table->string('Ma_hp', 50);
            $table->string('Ten_hp', 150);
            $table->string('Ten_viet_tat', 100)->nullable();
            $table->integer('hinh_thuc_hoc')->comment('1: lý thuyết; 2: thực hành');
            $table->integer('Thuc_tap');
            $table->string('So_tc', 11)->default(1);
            $table->string('Ma_khoa', 50)->nullable();
            $table->string('level');
            $table->tinyInteger('orderBy');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop_hoc_phans');
    }
};
