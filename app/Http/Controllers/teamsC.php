<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

require_once base_path () . "/debug/toConsole.php";

class teamsC extends Controller
{
  public function manage (Request $request)
  {
    $render = array ('listing' => false, 'exists'  => false);

    $method = $request->method ();

    if ($request->isMethod ("post"))
    {
      if ($request->has ('create'))
        $render ['exists'] = $this->crtTeam ($request);

      if ($request->has ('update'))
        $render ['exists'] = $this->updtTeam ($request);

      if ($request->has ('delete'))
        $render ['exists'] = $this->delTeam ($request);

      if ($request->has ('show'))
      {
        $render ['listing'] = $this->showTeam ($request);
        if ($render ['listing'] === false)
          $render ['exists'] = 'Doesn\'t exist';
      }

      if ($request->has ('all'))
        $render ['listing'] = $this->showAll ($request);
    }
    return view ('/teams/teams', $render);
  }

  private function crtTeam ($r)
  {
    $exists = false;

    $r->validate ([
      'team'    => 'required|max:50',
      'address' => 'required|max:100',
      'phone'   => 'required|max:20',
    ]);

    $post = $r->all();

    if (! Team::where ('team', $post ['team'])->get ()->count ())
    {
      $row = new Team ();

      $row->team    = $post ['team'];
      $row->address = $post ['address'];
      $row->phone   = $post ['phone'];

      $row->save();

      return $exists;
    }

    return $exists = 'Already exists !!!';
  }

  private function updtTeam ($r)
  {
    $exists = false;

    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $row = Team::where ('team', $post ['team'])->get ();

    if ($row->count ())
    {

      foreach ($row as $r)
      {
        if (empty ($post ['address'])) $post ['address'] = $r->address;
        if (empty ($post ['phone']))   $post ['phone']   = $r->phone;
      }

      $row = Team::where ('team', $post ['team'])
        ->update ([
          'address' => $post ['address'],
          'phone'   => $post ['phone']]);

      return $exists;
    }

    return $exists = 'Doesn\'t exist !!!';
  }

  private function delTeam ($r)
  {
    $exists = false;

    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

    if (Team::where ('team', $post ['team'])->get ()->count ())
    {
      $row = Team::where ('team', $post ['team'])->delete ();
      return $exists;
    }

    return $exists = 'Doesn\'t exist !!!';
  }

  private function showTeam ($r)
  {
    $listing = false;

    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

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
      return $listing = array ($lst);
    }

    return $listing;
  }

  private function showAll ($r)
  {
    $post = $r->all ();

    return $listing = Team::all ();
  }
}

?>

