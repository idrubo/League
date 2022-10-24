<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrtPlayers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create ('players', function (Blueprint $table) {
      $table->id ();
      $table->unsignedInteger ('idplatea');
      $table->string ('name', 50);
      $table->string ('address', 100);
      $table->string ('phone', 20);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
  }
}
