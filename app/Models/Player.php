<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

require_once base_path () . "/app/Http/Controllers/status.php";

class Player extends Model
{
  use HasFactory;

  public function savePlayer ($post)
  {
    $player = Player::where ('player', $post ['player'])->get ();

    if (! $player->count ())
    {
      $player = new Player ();

      if (! ($idplatea = self::fkIdPlaTea ($player, $post))) return teamNotXST;

      $player->idplatea = $idplatea;

      $player->player  = $post ['player'];
      $player->address = $post ['address'];
      $player->phone   = $post ['phone'];

      $player->save();

      return crudOK;
    }

    return playerXST;
  }

  public function updatePlayer ($post)
  {
    $player = Player::where ('player', $post ['player'])->get ();

    if ($player->count ())
    {
      foreach ($player as $p)
      {
        if (empty ($post ['team']))
          $idplatea = $p->idplatea;
        else
          if (! ($idplatea = self::fkIdPlaTea ($player, $post))) return teamNotXST;

        if (empty ($post ['address'])) $post ['address'] = $p->address;
        if (empty ($post ['phone']))   $post ['phone']   = $p->phone;
      }

      Player::where ('player', $post ['player'])
        ->update ([
          'idplatea' => $idplatea,
          'address'  => $post ['address'],
          'phone'    => $post ['phone'],
        ]);

      return crudOK;
    }

    return playerNotXST;
  }

  public function deletePlayer ($post)
  {
    $player = Player::where ('player', $post ['player'])->get ();

    if ($player->count ())
    {
      Player::where ('player', $post ['player'])->delete ();
      return crudOK;
    }

    return playerNotXST;
  }

  public function listPlayer ($post, & $lst)
  {
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
      return listOK;
    }

    return playerNotXST;
  }

  public function listAll (& $lst)
  {
    $lst  = array ();

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
