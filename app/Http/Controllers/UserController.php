<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
  private $salt;

  public function __construct()
  {
    $this->salt = "aspire";
  }

  public function login(Request $request)
  {
    if ($request->has('username') && $request->has('password')) {
      $user = User:: where("username", "=", $request->input('username'))
      ->where("password", "=", sha1($this->salt . $request->input('password')))
      ->first();
      if ($user) {
        $token = str_random(60);
        $user->api_token = $token;
        $user->save();
        return $user->api_token;
      } else {
        return "UserName or passsword incorrect！";
      }
    } else {
      return "Please enter your username and password to login.！";
    }
  }

  public function register(Request $request)
  {
    if ($request->has('username') && $request->has('password') && $request->has('email')) {
      $user = new User;
      $user->username = $request->input('username');
      $user->password = sha1($this->salt . $request->input('password'));
      $user->email = $request->input('email');
      $user->api_token = str_random(60);
      if ($user->save()) {
        return "Users registration is successful！";
      } else {
        return "Users registration failed！";
      }
    } else {
      return "Please enter your username and password to login！";
    }
  }

  public function info()
  {
    return Auth::user();
  }
}