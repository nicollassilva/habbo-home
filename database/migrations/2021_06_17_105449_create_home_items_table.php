<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("subcategory_id")->nullable();

            $table->string("title")->default("Sticker by Nicollas Silva");
            $table->string("image");
            $table->integer("value")->default(5);
            $table->integer("width");
            $table->integer("height");
            $table->boolean("available")->default(true);
            $table->integer("purchase_limit")->nullable();

            $table->timestamps();

            $table->foreign("category_id")
                ->references("id")
                ->on("home_categories");

            $table->foreign("subcategory_id")
                ->references("id")
                ->on("home_subcategories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_items');
    }
}
