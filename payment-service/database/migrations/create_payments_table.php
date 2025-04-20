<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('reservation_id');
        $table->decimal('amount', 10, 2);
        $table->string('method'); // tarjeta, paypal, etc.
        $table->string('status')->default('pending'); // paid, refunded, failed
        $table->timestamps();
    });
}
};
