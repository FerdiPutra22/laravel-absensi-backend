<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('location_histories', function (Blueprint $table) {
            $table->boolean('is_out_of_range')->default(false);
        });
    }
    
};
