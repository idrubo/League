<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teamsDB;

/* DEBUG */
/* DEBUG */
/* DEBUG */
/* Should be moved to the validate module. */
$GLOBALS ['teaErr'] = "";
$GLOBALS ['addErr'] = "";
$GLOBALS ['phoErr'] = "";
/* DEBUG */
/* DEBUG */
/* DEBUG */

class teamsC extends Controller
{
  public function show ()
  {
    return view ('teamsV');
  }
}

?>

