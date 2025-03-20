<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign("category_id")
                ->references("id")
                ->on("category")
                ->onDelete("set null"); //if its not null, this will be restricted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign("category_id"); //first delete the relation, then delete the column
            $table->dropColumn("category_id");
        });
    }
};
