<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libs\Constants;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getLogin() {
        $this->data['title'] = __('common.login');
        return view('admin.auth.login')->with($this->data);
    }

    public function postLogin (LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->is_visible == Constants::$is_visible['active']){
                notify()->success(trans('auth.login_successfully'));
                return redirect(route('admin-home'));
            }else{
                Session::flush();
                notify()->error(trans('auth.account_dont_active'));
                return redirect(route('admin.login'));
            }
        }
        notify()->error(trans('auth.invalid_credentials'));
        return redirect(route('admin.login'));
    }

    public function logout() {
        Session::flush();
        return redirect(route('admin.login'));
    }
}   
