<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryExpensePivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_expense', function (Blueprint $table) {
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id', 'expense_id_fk_7738363')->references('id')->on('expenses')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_7738363')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
