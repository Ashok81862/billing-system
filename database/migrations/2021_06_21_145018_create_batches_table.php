<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('sub_total')->default(0);
            $table->string('discount')->default(0)->nullable();
            $table->string('total')->default(0);
            $table->string('payment_method')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->foreignId('vendor_id')->nullable()->constrained('vendors');
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
        Schema::dropIfExists('batches');
    }
}
