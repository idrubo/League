<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  use HasFactory;

  public function saveGame ($post)
  {
    msgToConsole ("Into: Game::saveGame");

    if (! ($idLocal = self::fkIdGame ($post ['local'])))     return 1;

    if (! ($idVisitor = self::fkIdGame ($post ['visitor']))) return 2;

    $game = Game::where ('idLocal', $idLocal)
      ->where ('idVisitor', $idVisitor)
      ->get ();

    if ($idLocal === $idVisitor) return 3;

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

      return 0;
    }

    return 4;
  }

  public function updateGame ($post)
  {
    if (! ($idLocal = self::fkIdGame ($post ['local'])))     return 1;

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

      return 0;
    }

    return 5;
  }

  private function fkIdGame ($lv)
  {
    $team = Team::where ('team', $lv)->get ();

    if (! $team->count ()) return 0;

    foreach ($team as $t) $idTeam = $t->id;

    return $idTeam;
  }
}

