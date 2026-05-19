<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //disini untuk membuat tabel todolist_1 sesuai dengan nama file migration.
    public function up(): void
    {
        Schema::create('todolist_1', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    //untuk melakukan rollback atau menghapus tabel todlist_1
    public function down(): void
    {
        Schema::dropIfExists('todolist_1');
    }
};
