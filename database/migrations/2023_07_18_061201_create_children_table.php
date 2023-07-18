<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/<timestamp>_create_children_table.php

public function up()
{
    Schema::create('children', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('middle_name');
        $table->string('last_name');
        $table->integer('age');
        $table->string('gender');
        $table->boolean('different_address')->default(false);
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('country')->nullable();
        $table->string('zip_code')->nullable();
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
        Schema::dropIfExists('children');
    }
};
