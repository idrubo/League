<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;

require_once base_path () . "/debug/toConsole.php";

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

    if (! Player::where ('player', $post ['player'])->get ()->count ())
    {
      $player = new Player ();

      if (! ($idplatea = $this->fkIdPlaTea ($player, $post)))
      {
        $this->render ['team'] = 'Doesn\'t exist !!!';
        return;
      }

      $player->idplatea = $idplatea;

      $player->player  = $post ['player'];
      $player->address = $post ['address'];
      $player->phone   = $post ['phone'];

      $player->save();

      return;
    }

    $this->render ['player'] = 'Already exists !!!';
  }

  private function updtPlayer ($r)
  {
    $r->validate ([
      'player'  => 'required|max:50',
    ]);

    $post = $r->all ();

    $player = Player::where ('player', $post ['player'])->get ();

    if ($player->count ())
    {
      foreach ($player as $p)
      {
        if (empty ($post ['team']))
        {
          $idplatea = $p->idplatea;
        }
        else
        {
          if (! ($idplatea = $this->fkIdPlaTea ($player, $post)))
          {
            $this->render ['team'] = 'Doesn\'t exist !!!';
            return;
          }
        }
        if (empty ($post ['address'])) $post ['address'] = $p->address;
        if (empty ($post ['phone']))   $post ['phone']   = $p->phone;
      }

      $player = Player::where ('player', $post ['player'])
        ->update ([
          'idplatea' => $idplatea,
          'address'  => $post ['address'],
          'phone'    => $post ['phone'],
        ]);

      return;
    }

    $this->render ['player'] = 'Doesn\'t exist !!!';
  }

  private function delPlayer ($r)
  {
    $r->validate ([
      'player'    => 'required|max:50',
    ]);

    $post = $r->all ();

    if (Player::where ('player', $post ['player'])->get ()->count ())
    {
      $row = Player::where ('player', $post ['player'])->delete ();
      return;
    }

    $this->render ['player'] = 'Doesn\'t exist !!!';
  }

  private function showPlayer ($r)
  {
    $r->validate ([
      'player'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $player = Player::where ('player', $post ['player'])->get ();

    if ($player->count ())
    {
      foreach ($player as $p)
      {
        $row = Team::where ('id', $p->idplatea)->get ();
        foreach ($row as $r) $team = $r->team;

        $lst = array (
          'team'    => $team,
          'player'  => $p->player,
          'address' => $p->address,
          'phone'   => $p->phone,
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

    $player = Player::all ();

    foreach ($player as $p)
    {
      $row = Team::where ('id', $p->idplatea)->get ();
      foreach ($row as $r) $team = $r->team;

      $item ['team']    = $team;
      $item ['player']  = $p->player;
      $item ['address'] = $p->address;
      $item ['phone']   = $p->phone;

      array_push ($lst, $item);
    }

    $this->render ['listing'] = $lst;
  }

  private function fkIdPlaTea ($player, $post)
  {
    $team = Team::where ('team', $post ['team'])->get ();

    if (! ($n = $team->count ())) return $n;

    foreach ($team as $t)
      if (strtolower ($t->team) == strtolower ($post ['team']))
        $idplatea = $t ['id'];

    return $idplatea;
  }
}

?>

