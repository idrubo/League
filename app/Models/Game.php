<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  use HasFactory;


  public function teamsL ()
  {
    return $this->belongsTo (Team::class, 'idLocal', 'id');
  }

  public function teamsV ()
  {
    return $this->belongsTo (Team::class, 'idVisitor', 'id');
  }

  public function saveGame ($post)
  {
    msgToConsole ("Into: Game::saveGame");

    if (! ($idLocal   = self::fkIdGame ($post ['local'])))   return localNotXST;
    if (! ($idVisitor = self::fkIdGame ($post ['visitor']))) return visitNotXST;

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    if ($idLocal === $idVisitor) return teamsEQU;

    if (! $game->count ())
    {
      $games = new Game ();

      $games->idlocal   = $idLocal;
      $games->idvisitor = $idVisitor;
      $games->location  = $post ['location'];
      $games->dGame     = $post ['dGame'];
      $games->L         = $post ['L'];
      $games->V         = $post ['V'];

      $games->save();

      return crudOK;
    }

    return gameXST;
  }

  public function updateGame ($post)
  {
    if (! ($idLocal   = self::fkIdGame ($post ['local'])))   return 1;
    if (! ($idVisitor = self::fkIdGame ($post ['visitor']))) return 2;

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    if ($game->count ())
    {
      foreach ($game as $g)
      {
        if (empty ($post ['location'])) $post ['location'] = $g->location;
        if (empty ($post ['dGame']))    $post ['dGame']    = $g->dGame;
        if (empty ($post ['L']))        $post ['L']        = $g->L;
        if (empty ($post ['V']))        $post ['V']        = $g->V;
      }

      $game = Game::where ('idLocal', $idLocal)
        ->where ('idVisitor', $idVisitor)
        ->update ([
          'location' => $post ['location'],
          'dGame'    => $post ['dGame'],
          'L'        => $post ['L'],
          'V'        => $post ['V'],
        ]);

      return crudOK;
    }

    return gameNotXST;
  }

  public function deleteGame ($post)
  {
    if (! $idLocal   = self::fkIdGame ($post ['local']))   return 1;
    if (! $idVisitor = self::fkIdGame ($post ['visitor'])) return 2;

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    if ($game->count ())
    {
      Game::where ('idLocal', $idLocal)
        ->where ('idVisitor', $idVisitor)
        ->delete ();

      return crudOK;
    }
    return gameNotXST;
  }

  public function listGame ($post, & $lst)
  {
    if (! $idLocal   = self::fkIdGame ($post ['local']))   return 1;
    if (! $idVisitor = self::fkIdGame ($post ['visitor'])) return 2;

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    if ($game->count ())
    {
      foreach ($game as $g)
      {
        $lst = array (
          'local'    => $g->teamsL->team,
          'visitor'  => $g->teamsV->team,
          'location' => $g->location,
          'dGame'    => $g->dGame,
          'L'        => $g->L,
          'V'        => $g->V,
        );
      }
      return listOK;
    }
    return gameNotXST;
  }

  public function listAll ($post, & $lst)
  {
    $lst = array ();

    $game = Game::all ();

    foreach ($game as $g)
    {
      $item ['local']    = $g->teamsL->team;
      $item ['visitor']  = $g->teamsV->team;
      $item ['location'] = $g->location;
      $item ['dGame']    = $g->dGame;
      $item ['L']        = $g->L;
      $item ['V']        = $g->V;

      array_push ($lst, $item);
    }
    return listOK;
  }

  private function fkIdGame ($lv)
  {
    $team = Team::where ('team', $lv)->get ();

    if (! $team->count ()) return 0;

    foreach ($team as $t) $idTeam = $t->id;

    return $idTeam;
  }
}

?>
