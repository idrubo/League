<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Game;

require_once base_path () . "/debug/toConsole.php";
require_once base_path () . "/app/Http/Controllers/status.php";

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
        $this->showAll ();
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

    $status = Game::deleteGame ($post);

    $this->checkStatus ($status);
  }

  private function showGame ($r)
  {
    $r->validate ([
      'local'    => 'required|max:50',
      'visitor'  => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Game::listGame ($post, $lst);

    if ($status === listOK)
      $this->render ['listing'] = array ($lst);
    else
      $this->checkStatus ($status);

  }

  private function showAll ()
  {
    Game::listAll ($lst);

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
    case localNotXST:
      $this->render ['local']   = 'Doesn\'t exist !!!';
      break;

    case visitNotXST:
      $this->render ['visitor'] = 'Doesn\'t exist !!!';
      break;

    case teamsEQU:
      $this->render ['local']   = 'Teams must be different !!!';
      $this->render ['visitor'] = 'Teams must be different !!!';
      break;

    case gameXST:
      $this->render ['local']   = 'Game already exist !!!';
      $this->render ['visitor'] = 'Game already exist !!!';
      break;

    case gameNotXST:
      $this->render ['local']   = 'Game doesn\'t exist !!!';
      $this->render ['visitor'] = 'Game doesn\'t exist !!!';
      break;
    }
  }
}
?>

