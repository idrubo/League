<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teamsDB;

require base_path () . "/debug/toConsole.php";

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

/* DEBUG */
/* DEBUG */
/* DEBUG */
/*
 * Create a "manage" function to select between post selected actions (create, 
 * update, show or all).
 * Develop a model for the action called.
 */
/* DEBUG */
/* DEBUG */
/* DEBUG */

class teamsC extends Controller
{
  public function manage (Request $request)
  {
    msgToConsole ("Into teamsC->manage");

    $method = $request->method ();
    varToConsole ('$method', $method);

    if ($request->isMethod ("post"))
    {
      msgToConsole ("teamsC->manage: It is a post.");

      if ($request->has ('create'))
      {
        msgToConsole ("teamsC->manage: It is a create action.");
        $post = $request->all();
        varToConsole ('$post', $post);
      }
    }

    msgToConsole ("Leaving teamsC->manage");
    return view ('teamsV');
  }

}

?>

