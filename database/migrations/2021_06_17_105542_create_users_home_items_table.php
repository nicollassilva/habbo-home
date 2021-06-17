<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHomeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_home_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("item_id");

            $table->integer("x")->default(0);
            $table->integer("y")->default(0);
            $table->integer("z")->default(0);

            $table->integer("widget_id")->nullable();
            
            $table->boolean('placed')->default(false);
            $table->boolean("editing")->default(false);
            $table->boolean("reverse")->default(false);
            $table->boolean("background")->default(false);

            $table->boolean("widget")->default(false);
            $table->string("theme")->nullable();

            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users");

            $table->foreign("item_id")
                ->references("id")
                ->on("home_items");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_home_items');
    }
}
