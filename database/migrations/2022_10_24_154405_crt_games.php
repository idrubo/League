<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrtGames extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create ('games', function (Blueprint $table) {
      $table->id ();
      $table->unsignedInteger ('idLocal');
      $table->unsignedInteger ('idVisitor');
      $table->string ('location', 100);
      $table->unsignedInteger ('L');
      $table->unsignedInteger ('V');
      $table->dateTime ('dGame');
      $table->timestamps ();
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
