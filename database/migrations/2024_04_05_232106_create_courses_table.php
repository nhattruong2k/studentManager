<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khoa_hoc');
            $table->string('ten_khoa_hoc', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->unsigned()->nullable()->default(1); // 0: Ngừng kích hoạt, 1: Kích Hoạt, 2: Tạm dừng
            $table->tinyInteger('orderby');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('create_by')->unsigned();
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('update_by')->unsigned();
            $table->foreign('update_by')->references('id')->on('users')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE courses ADD CONSTRAINT status_check CHECK (Status >= 0 AND Status <= 2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
