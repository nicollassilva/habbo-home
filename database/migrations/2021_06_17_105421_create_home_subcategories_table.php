<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->unsignedBigInteger("category_id");
            $table->string("icon")->nullable();
            $table->timestamps();

            $table->foreign("category_id")
                ->references("id")
                ->on("home_categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_subcategories');
    }
}
