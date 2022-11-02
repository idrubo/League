<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Game;

require_once base_path () . "/debug/toConsole.php";

class gamesC extends Controller
{
  private $render;

  public function __construct ()
  {
    $this->render = array ('listing' => false, 'local'  => false, 'visitor' => false);
  }

  public function manage (Request $request)
  {
    $method = $request->method ();

    if ($request->isMethod ("post"))
    {
      if ($request->has ('create'))
        $this->crtGame ($request);

      if ($request->has ('update'))
        $this->updtGame ($request);

      if ($request->has ('delete'))
        $this->delGame ($request);

      if ($request->has ('show'))
        $this->showGame ($request);

      if ($request->has ('all'))
        $this->showAll ($request);
    }
    return view ('/games/games', $this->render);
  }

  private function crtGame ($r)
  {
    $r->validate ([
      'local'    => 'required|max:50',
      'visitor'  => 'required|max:50',
      'location' => 'required|max:100',
      'dGame'    => 'required|date_format:Y-m-d H:i:s',
      'L'        => 'required|integer',
      'V'        => 'required|integer',
    ]);

    $post = $r->all();

    $status = Game::saveGame ($post);

    $this->checkStatus ($status);
  }

  private function updtGame ($r)
  {
    $r->validate ([
      'local'    => 'required|max:50',
      'visitor'  => 'required|max:50',
      'location' => 'nullable|max:100',
      'dGame'    => 'nullable|date_format:Y-m-d H:i:s',
      'L'        => 'nullable|integer',
      'V'        => 'nullable|integer',
    ]);

    $post = $r->all ();

    $status = Game::updateGame ($post);

    $this->checkStatus ($status);
  }

  private function delGame ($r)
  {
    $r->validate ([
      'local'    => 'required|max:50',
      'visitor'  => 'required|max:50',
    ]);

    $post = $r->all ();

    /* DEBUG */
    /* DEBUG */
    /* DEBUG */
    /* The following code is repeated four times. */

    $idLocal = $this->fkIdGame ($post ['local']);
    if (! $idLocal)
    {
      $this->render ['local'] = 'Doesn\'t exist !!!';
      return;
    }

    $idVisitor = $this->fkIdGame ($post ['visitor']);
    if (! $idVisitor)
    {
      $this->render ['visitor'] = 'Doesn\'t exist !!!';
      return;
    }

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    /* DEBUG */
    /* DEBUG */
    /* DEBUG */

    if ($game->count ())
    {
      Game::where ('idLocal', $idLocal)
        ->where ('idVisitor', $idVisitor)
        ->delete ();

      return;
    }

    $this->render ['local']   = 'Doesn\'t exist !!!';
    $this->render ['visitor'] = 'Doesn\'t exist !!!';
  }

  private function showGame ($r)
  {
    $r->validate ([
      'local'    => 'required|max:50',
      'visitor'  => 'required|max:50',
    ]);

    $post = $r->all ();

    /* DEBUG */
    /* DEBUG */
    /* DEBUG */
    /* The following code is repeated four times. */

    $idLocal = $this->fkIdGame ($post ['local']);
    if (! $idLocal)
    {
      $this->render ['local'] = 'Doesn\'t exist !!!';
      return;
    }

    $idVisitor = $this->fkIdGame ($post ['visitor']);
    if (! $idVisitor)
    {
      $this->render ['visitor'] = 'Doesn\'t exist !!!';
      return;
    }

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    /* DEBUG */
    /* DEBUG */
    /* DEBUG */

    if ($game->count ())
    {
      foreach ($game as $g)
      {
        $local   = Team::where ('id', $idLocal)->get ();
        $visitor = Team::where ('id', $idVisitor)->get ();

        foreach ($local as $l) $lV = $l->team;
        foreach ($visitor as $v) $vV = $v->team;

        $lst = array (
          'local'    => $lV,
          'visitor'  => $vV,
          'location' => $g->location,
          'dGame'    => $g->dGame,
          'L'        => $g->L,
          'V'        => $g->V,
        );
      }
      $this->render ['listing'] = array ($lst);
      return;
    }

    $this->render ['player'] = 'Doesn\'t exist !!!';
  }

  private function showAll ($r)
  {
    $item = array ();
    $lst  = array ();

    $post = $r->all ();

    $game = Game::all ();

    foreach ($game as $g)
    {
      $local   = Team::where ('id', $g->idLocal)->get ();
      $visitor = Team::where ('id', $g->idVisitor)->get ();

      foreach ($local as $l) $lV = $l->team;
      foreach ($visitor as $v) $vV = $v->team;

      $item ['local']    = $lV;
      $item ['visitor']  = $vV;
      $item ['location'] = $g->location;
      $item ['dGame']    = $g->dGame;
      $item ['L']        = $g->L;
      $item ['V']        = $g->V;

      array_push ($lst, $item);
    }

    $this->render ['listing'] = $lst;
  }

  private function fkIdGame ($lv)
  {
    $team = Team::where ('team', $lv)->get ();

    if (! $team->count ()) return 0;

    foreach ($team as $t) $idTeam = $t->id;

    return $idTeam;
  }

  private function checkStatus ($status)
  {
    switch ($status)
    {
    case 1:
      $this->render ['local'] = 'Doesn\'t exist !!!';
      break;

    case 2:
      $this->render ['visitor'] = 'Doesn\'t exist !!!';
      break;

    case 3:
      $this->render ['local']   = 'Teams must be different !!!';
      $this->render ['visitor'] = 'Teams must be different !!!';
      break;

    case 4:
      $this->render ['local']   = 'Game already exist !!!';
      $this->render ['visitor'] = 'Game already exist !!!';
      break;

    case 5:
      $this->render ['local']   = 'Game doesn\'t exist !!!';
      $this->render ['visitor'] = 'Game doesn\'t exist !!!';
      break;
    }
  }
}
?>

