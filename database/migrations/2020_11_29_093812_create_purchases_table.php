<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_id');
            $table->string('category_id');
            $table->string('product_id');
            $table->string('purchase_no');
            $table->date('date');
            $table->string('description')->nullable();
            $table->double('buying_qty');
            $table->double('unit_qty');
            $table->double('buyingt_price');
            $table->tinyInteger('status')->default()->comment('0=Pendding','1=Approval');
            $table->Integer('create_by')->nullable();
            $table->Integer('update_by')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
