<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

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
        $this->crtTeam ($request);
        return view ('teamsV');
      }
    }

    msgToConsole ("Leaving teamsC->manage");
    return view ('teamsV');
  }

  private function crtTeam ($r)
  {
    $t = new Team ();
    varToConsole ('$r', $r);

    $post = $r->all();
    varToConsole ('$post', $post);

    $t->team    = $post ['team'];
    $t->address = $post ['address'];
    $t->phone   = $post ['phone'];

    $t->save();
  }
}

?>

