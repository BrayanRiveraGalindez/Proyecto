<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lends', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('customer_user_id')->unsigned();
			$table->bigInteger('product_id')->unsigned();
			// $table->enum('status', ['PRESTADO','REVISION','EN SALA'])->default('EN SALA');
			$table->timestamps();
			$table->softDeletes();

			// $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('lends');
    }
};
