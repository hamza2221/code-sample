<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('u_l_number')->nullable();

            $table->string('person_name')->nullable();
            $table->string('name')->required();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('n_t_n_number')->nullable();
            $table->string('g_s_t_number')->nullable();
            $table->string('remarks')->nullable();
            
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('SET NULL');
            
            $table->double('purchase_amount', 12, 2)->nullable();

            $table->string('landline_number')->nullable();
            $table->string('srs_code')->nullable();
            $table->string('subscription_type')->required();
            $table->string('courier')->required();
            $table->string('status')->required();

            $table->string('postal_name')->required();
            $table->string('postal_address1')->nullable();
            $table->string('postal_address2')->nullable();
            $table->string('postal_address3')->nullable();

            $table->string('nick_name')->required();
            $table->string('nick_address1')->nullable();
            $table->string('nick_address2')->nullable();
            $table->string('nick_address3')->nullable();

            $table->string('generator_type')->required();
            $table->bigInteger('generator_id')->unsigned()->required();

            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');

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
        Schema::dropIfExists('companies');
    }
}
