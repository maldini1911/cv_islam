<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class LoginController extends Controller
{
    public function get_login()
    {
      return view('admin.auth.login');
    }

    public function post_login(LoginRequest $request)
    {

      $remember = $request->has('remember_me') ? true : false;

      if(auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember))
      {

        return redirect('admin');

      }else{

        return redirect('admin/login');
      }
    }
}
