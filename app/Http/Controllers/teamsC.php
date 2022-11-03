<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

require_once base_path () . "/debug/toConsole.php";
require_once base_path () . "/app/Http/Controllers/status.php";

class teamsC extends Controller
{
  private $render;

  public function __construct ()
  {
    $this->render = array ('listing' => false, 'team'  => false);
  }

  public function manage (Request $request)
  {
    $method = $request->method ();

    if ($request->isMethod ("post"))
    {
      if ($request->has ('create'))
        $this->crtTeam ($request);

      if ($request->has ('update'))
        $this->updtTeam ($request);

      if ($request->has ('delete'))
        $this->delTeam ($request);

      if ($request->has ('show'))
        $this->showTeam ($request);

      if ($request->has ('all'))
        $this->showAll ($request);
    }
    return view ('/teams/teams', $this->render);
  }

  private function crtTeam ($r)
  {
    $r->validate ([
      'team'    => 'required|max:50',
      'address' => 'required|max:100',
      'phone'   => 'required|max:20',
    ]);

    $post = $r->all();

    $status = Team::saveTeam ($post);

    $this->checkStatus ($status);
  }

  private function updtTeam ($r)
  {
    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Team::updateTeam ($post);

    $this->checkStatus ($status);
  }

  private function delTeam ($r)
  {
    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Team::deleteTeam ($post);

    $this->checkStatus ($status);
  }

  private function showTeam ($r)
  {
    $r->validate ([
      'team'    => 'required|max:50',
    ]);

    $post = $r->all ();

    $status = Team::listTeam ($post, $lst);

    if ($status === listOK)
      $this->render ['listing'] = array ($lst);
    else
      $this->checkStatus ($status);
  }

  private function showAll () { $this->render ['listing'] = Team::listAll (); }

  private function checkStatus ($status)
  {
    switch ($status)
    {
    case teamXST:
      $this->render ['team'] = 'Already exists !!!';
      break;

    case teamNotXST:
      $this->render ['team'] = 'Doesn\'t exist !!!';
      break;
    }
  }

}
?>

