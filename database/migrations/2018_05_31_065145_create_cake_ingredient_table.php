<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCakeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cake_ingredient', function (Blueprint $table) {
            $table->integer('cake_id')->unsigned()->index();
            $table->integer('ingredient_id')->unsigned()->index();
            $table->decimal('quantity', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cake_ingredient');
    }
}
