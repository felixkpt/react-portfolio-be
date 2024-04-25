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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1100);
            $table->uuid('uuid')->unique();
            $table->string("title");
            $table->string("slug");
            $table->longText("description");
            $table->text("achievements");
            $table->string("source_uri")->nullable();
            $table->string("project_url")->nullable();
            $table->string("github_url")->nullable();
            $table->unsignedBigInteger("company_id");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("image")->nullable();

            $table->unsignedInteger('priority_number')->default(9999);
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
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
        Schema::dropIfExists('projects');
    }
};
