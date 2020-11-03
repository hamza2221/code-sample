<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('category_id')->required()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->string('model_number')->nullable();
            $table->string('name')->required();
            $table->string('slug')->unique()->nullable();
            $table->string('stock_keeping_unit')->nullable()->unique();

            $table->string('state')->required()->default('draft');

            $table->string('description')->nullable();
            $table->longText('product_page')->nullable();

            $table->decimal('price',12,2)->required()->default(0.0);
            $table->integer('discounted_percentage')->nullable()->default(0);
            $table->decimal('discounted_price',12,2)->nullable();

            $table->bigInteger('quantity')->nullable()->default(0);

            $table->bigInteger('total_views')->nullable()->default(0);
            $table->bigInteger('total_wishes')->nullable()->default(0);
            $table->bigInteger('total_sells')->nullable()->default(0);
            $table->bigInteger('total_carteds')->nullable()->default(0);

            $table->double('length', 8, 2)->required()->default(0.0);
            $table->double('width', 8, 2)->required()->default(0.0);
            $table->double('height', 8, 2)->required()->default(0.0);
            
            $table->double('weight', 8, 2)->required()->default(0.0);
            
            $table->bigInteger('currency_id')->unsigned()->required();
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->ondelete('set null');

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
        Schema::dropIfExists('products');
    }
}
