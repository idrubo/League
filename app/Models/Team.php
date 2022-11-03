<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

require_once base_path () . "/app/Http/Controllers/status.php";

class Team extends Model
{
  use HasFactory;

  public function saveTeam ($post)
  {
    $team = Team::where ('team', $post ['team'])->get ();

    if (! $team->count ())
    {
      $row = new Team ();

      $row->team    = $post ['team'];
      $row->address = $post ['address'];
      $row->phone   = $post ['phone'];

      $row->save();

      return crudOK;
    }
    return teamXST;
  }

  public function updateTeam ($post)
  {
    $row = Team::where ('team', $post ['team'])->get ();

    if ($row->count ())
    {
      foreach ($row as $r)
      {
        if (empty ($post ['address'])) $post ['address'] = $r->address;
        if (empty ($post ['phone']))   $post ['phone']   = $r->phone;
      }

      Team::where ('team', $post ['team'])
        ->update ([
          'address' => $post ['address'],
          'phone'   => $post ['phone']]);

      return crudOK;
    }

    return teamNotXST;
  }

  public function deleteTeam ($post)
  {
    $row = Team::where ('team', $post ['team'])->get ();

    if ($row->count ())
    {
      Team::where ('team', $post ['team'])->delete ();
      return crudOK;
    }

    return teamNotXST;
  }

  public function listTeam ($post, & $lst)
  {
    $rows = Team::where ('team', $post ['team'])->get ();

    if ($rows->count ())
    {
      foreach ($rows as $r)
      {
        $lst = array (
          'team'    => $r->team,
          'address' => $r->address,
          'phone'   => $r->phone);
      }
      return listOK;
    }

    return teamNotXST;
  }

  public function listAll () { return Team::all (); }
}

?>
