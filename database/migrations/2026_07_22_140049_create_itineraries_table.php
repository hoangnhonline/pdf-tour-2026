<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerariesTable extends Migration
{
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name');
            $table->string('travel_dates');
            $table->string('duration');
            $table->string('destination');
            $table->integer('adults_count');
            $table->decimal('total_price', 12, 2);
            $table->string('hotel_name');
            $table->string('hotel_image')->nullable(); // Đường dẫn ảnh trong storage/public
            $table->text('day_details'); // Luu dạng JSON các ngày
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itineraries');
    }
}