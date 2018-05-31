<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 控制器构造器
     *
     * 未登录认证用户仅可使用登录功能
     */
    public function __construct()
    {
        $this->middleware('guest')->only('login');
        $this->middleware('auth')->except('login');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->can('index', $user)) {
            return view('home');
        } else {
            Auth::logout();
            session()->flash('danger', '您没有访问权限！');
            return redirect()->back();
        }
    }

    /**
     * 登录请求
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'account' => 'required|max:20',
            'password' => 'required|between:6,20',
        ]);

        if (Auth::attempt($validatedData, $request->has('remember'))) {
            // $user = Auth::user();
            // if ($user->is_admin == false) {
            //     Auth::logout();
            //     session()->flash('danger', '您没有权限！');
            //     return redirect()->back();
            // }
            session()->flash('success', '祝您使用愉快！');
            return redirect()->intended(route('home'));
        } else {
            session()->flash('danger', '账号或密码错误！');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', '谢谢使用！');
        return redirect()->route('login');
    }
}
