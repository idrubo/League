<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;

require_once base_path () . "/debug/toConsole.php";
require_once base_path () . "/app/Http/Controllers/status.php";

class playersC extends Controller
{
  private $render;

  public function __construct ()
  {
    $this->render = array ('listing' => false, 'player'  => false, 'team' => false);
  }

  public function manage (Request $request)
  {
    $method = $request->method ();

    if ($request->isMethod ("post"))
    {
      if ($request->has ('create'))
        $this->crtPlayer ($request);

      if ($request->has ('update'))
        $this->updtPlayer ($request);

      if ($request->has ('delete'))
        $this->delPlayer ($request);

      if ($request->has ('show'))
        $this->showPlayer ($request);

      if ($request->has ('all'))
        $this->showAll ($request);
    }
    return view ('/players/players', $this->render);
  }

  private function crtPlayer ($r)
  {
    $r->validate ([
      'team'    => 'required|max:50',
      'player'  => 'required|max:50',
      'address' => 'required|max:100',
      'phone'   => 'required|max:20',
    ]);

    $post = $r->all();

    $status = Player::savePlayer ($post);

    $this->checkStatus ($status);
  }

  private function updtPlayer ($r)
  {
    $r->validate ([
      'player'  => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Player::updatePlayer ($post);

    $this->checkStatus ($status);
  }

  private function delPlayer ($r)
  {
    $r->validate ([
      'player'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Player::deletePlayer ($post);

    $this->checkStatus ($status);
  }

  private function showPlayer ($r)
  {
    $r->validate ([
      'player'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Player::listPlayer ($post, $lst);

    if ($status === listOK)
      $this->render ['listing'] = array ($lst);
    else
      $this->checkStatus ($status);
  }

  private function showAll ()
  {
    Player::listAll ($lst);

    $this->render ['listing'] = $lst;
  }

  private function checkStatus ($status)
  {
    switch ($status)
    {
    case teamNotXST:
      $this->render ['team']   = 'Team doesn\'t exist !!!';
      break;

    case playerXST:
      $this->render ['player'] = 'Player already exist !!!';
      break;

    case playerNotXST:
      $this->render ['player'] = 'Player doesn\'t exist !!!';
      break;
    }
  }
}
?>

