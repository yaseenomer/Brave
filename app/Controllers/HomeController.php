<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/13/2017
 * Time: 11:45 AM
 */

namespace App\Controllers;


use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request , Response $response)
    {

        $user = $this->user->all();

      foreach ($user as $us)
      {
          echo $us->fix_name.'<br>';
      }

    }




}